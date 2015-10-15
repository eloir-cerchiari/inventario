<?php

namespace Repository;

/**
 * Description of EventRepository
 *
 * @author eloir
 */
class EventRepository extends Repository {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return \Entity\Event[]
     */
    public function listEvents($equipmentId) {

        $sql = 'SELECT * FROM event WHERE equipment_id = :equipmentId ORDER BY create_timestamp DESC';


        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('equipmentId', $equipmentId);

        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->eventFactory($result);
    }

    /**
     * 
     * @return \Entity\Event
     */
    public function getEvent($eventId) {

        $sql = 'SELECT * FROM event WHERE event_id = :eventId ORDER BY create_timestamp DESC';


        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('eventId', $eventId);

        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->eventFactory($result);
    }

    /**
     * 
     * @param \Entity\Event $event
     * @return type
     */
    public function findByEvent($event) {
        $sql = 'SELECT description, equipment_id, time, create_timestamp, user_id, type FROM event '
                . 'WHERE description = :description and '
                . ' equipment_id = :equipment_id and '
                . ' time = :time and '
                . ' create_timestamp = :create_timestamp and '
                . ' user_id = :user_id and '
                . ' type = :type ';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('equipment_id', $event->getEquipmentId());
        $stmt->bindParam('create_timestamp', $event->getTimestamp());
        $stmt->bindParam('user_id', $event->getUserId());
        $stmt->bindParam('type', $event->getType());
        $stmt->bindParam('time', $event->getTime());
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->eventFactory($result);
    }

    /**
     * 
     * @param \Entity\Event $event
     * @return boolean
     */
    public function exists($event) {
        $events = $this->findByEvent($event);
        if (count($events) > 0) {
            return true;
        }
        return false;
    }
/**
 * 
 * @param \Entity\Event $event
 * @return boolean
 * @throws \Exception
 */
    public function insert($event) {
        if ($this->exists($event)) {

            throw new \Exception('Usuário já existe.');
        }

        $sql = 'INSERT INTO '
                . 'event (description, equipment_id, time, create_timestamp, `user_id`,`type`) '
                . 'VALUES (:description, :equipment_id, :time, :create_timestamp, :user_id,:type); ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('description', $event->getDescription());
        $stmt->bindParam('equipment_id', $event->getEquipmentId());
        $stmt->bindParam('time', $event->getTime());
        $stmt->bindParam('create_timestamp', $event->getTimestamp());
        $stmt->bindParam('user_id', $event->getUserId());
        $stmt->bindParam('type', $event->getType());

        return $stmt->execute();
    }

    private function eventFactory($result) {

        $events = array();

        if (is_array($result)) {

            if (count($result) > 0) {

                foreach ($result as $value) {
                    $event = new \Entity\Event();
                    $event->setId($value['event_id']);
                    $event->setDescription($value['description']);
                    $event->setEquipmentId($value['equipment_id']);
                    $event->setTime($value['time']);
                    $event->setTimestamp($value['create_timestamp']);
                    $event->setUserId($value['user_id']);
                    $event->setType($value['type']);
                    $events[] = $event;
                }
            }
        }

        return $events;
    }

//put your code here
}
