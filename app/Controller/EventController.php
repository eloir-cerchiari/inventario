<?php

namespace Controller;

/**
 * 
 * @author eloir
 */
class EventController extends \Controller\Controller {

    public function __construct() {
        parent::__construct();
    }
    const USER_ID = 1;

    private function addUserToEvents($events) {

        $usersId = array();

        foreach ($events as $event) {
            $usersId[] = $event->getUserId();
        }

        if (count($usersId) < 1) {
            return $events;
        }

        $userRep = new \Repository\UserRepository();
        $usersRet = $userRep->listUsersBylistId($usersId);

        $users = array();

        foreach ($usersRet as $user) {

            $users[$user->getUserId()] = $user;
        }
        foreach ($events as $event) {
            $event->setUser($users[$event->getUserId()]);
        }
    }

    public function getEventAction($eventId){
        
        $eventRep = new \Repository\EventRepository();
        $events = $eventRep->getEvent($eventId);

        $this->addUserToEvents($events);

        $resource = new \League\Fractal\Resource\Collection($events, new \Transformer\EventTransformer());
        echo $this->writeJson($resource);
    
    }
    
    public function listEventByEquipmentIdAction($equipmentId) {

        $eventRep = new \Repository\EventRepository();
        $events = $eventRep->listEvents($equipmentId);


        $this->addUserToEvents($events);

        $resource = new \League\Fractal\Resource\Collection($events, new \Transformer\EventTransformer());
        echo $this->writeJson($resource);
    
    }
    
    private function jsonToEvent($json){
        
        $event = new \Entity\Event();
        
        if (!isset($json->event)) {
            throw new \Exception('Ocorrência em Branco');
        }
        if (!isset($json->type)) {
            throw new \Exception('Tipo em Branco');
        }
        if (!isset($json->time)) {
            throw new \Exception('Tekpo em Branco');
        }

        if (isset($json->id)) {
            $event->setId($json->id);
        }
        $event->setDescription($json->event);
        $event->setType($json->type);
        $event->setTime($json->time);
        $event->setEquipmentId($json->equipment_id);
        $event->setUserId(self:: USER_ID);
        $event->setTimestamp(time());
        
        return $event;
    }
    /**
     * 
     * @param \Entity\Event $event
     * @throws \Exception
     */
    private function validateEvent($event){
         if (get_class($event) != 'Entity\Event') {
            throw new \Exception('Usuário inválido');
        }

        if (strlen($event->getDescription()) < 2) {
            throw new \Exception('Ocorrencia muito curta');
        }

        if (is_null($event->getType())) {
            throw new \Exception('Tipo deve ser informado');
        }

        if (is_null($event->getTime()) ) {
            throw new \Exception('Tempo deve ser informado');
        }
    }
    public function postEventAction(){
        
        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $jsonPost = json_decode($data);

            $event = $this->jsonToEvent($jsonPost);
            $this->validateEvent($event);

            $eventRep = new \Repository\EventRepository();

            $eventRep->insert($event);


            $returnEvent = $eventRep->findByEvent($event);

            if (count($returnEvent) > 1) {
                throw new Exception('Many events');
            }

            
            $this->addUserToEvents($events);
            $resource = new \League\Fractal\Resource\Item($returnEvent[0], new \Transformer\EventTransformer());

            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {
            
            return $this->error($exc->getMessage());
        }
    }
    
    public function putEventAction() {
        
    }
    
    public function deleteEventAction(){
        
    }

}
