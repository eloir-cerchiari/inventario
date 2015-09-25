<?php

namespace Controller;

/**
 * Description of EquipmentController
 *
 * @author eloir
 */
class EquipmentController extends \Controller\Controller {
    
       public function __construct() {
        parent::__construct();
    }

    public function listEquipmentsAction() {

        try {
            $equipmentRep = new \Repository\EquipmentRepository();
            $equipments = $equipmentRep->listEquipments();
            
            if (is_null($equipments) || count($equipments) < 1) {
                throw new \Exception('No Equipments');
            }
            $resource = new \League\Fractal\Resource\Collection($equipments, new \Transformer\EquipmentTransformer());
            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }
    }
    
    public function listEquipmentsByAreaIdAction($areaId){
        
        try {
            $equipmentRep = new \Repository\EquipmentRepository();
            $equipments = $equipmentRep->listEquipmentsByAreaId($areaId);
            
            if (is_null($equipments) || count($equipments) < 1) {
                throw new \Exception('No Equipments');
            }
            $resource = new \League\Fractal\Resource\Collection($equipments, new \Transformer\EquipmentTransformer());
            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }
    }
    
    public function getEquipmentAction($equipmentId){
        
        try {
            $equipmentRep = new \Repository\EquipmentRepository();
            $equipment = $equipmentRep->get($equipmentId);
            
            $resource = new \League\Fractal\Resource\Item($equipments, new \Transformer\EquipmentTransformer());
            
            $this->writeJson($resource);
            
        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }
    }
    
    
    /**
     * 
     * @param \Entity\Equipment $equipment
     */
    private function validateEquipment($equipment) {

        if (get_class($equipment) != 'Entity\Equipment') {
            throw new \Exception('Equipamento inválido');
        }

        if (strlen($equipment->getName()) < 1) {
            throw new \Exception('Tamanho mínimo é 1 caracter');
        }

        if (strlen($equipment->getName()) > 50) {
            throw new \Exception('Tamanho máximo é 80 caracteres');
        }
        $areaRep = new \Repository\AreaRepository();
        
        $area = $areaRep->getArea($equipment->getAreaId());
        
        if (get_class($area) != 'Entity\Area') {
            throw new \Exception('Equipamento inválido');
        }
        
        if($area->getAreaId() != $equipment->getAreaId()){
            throw new \Exception('Equipamento inválido');
        }

        return true;
    }
    
    
    
    public function postEquipmentAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $equipmentPos = json_decode($data);

            $equipment = new \Entity\Equipment();
            $equipment->setName($equipmentPos->name);
            $equipment->setAreaId($equipmentPos->area_id);

            $this->validateEquipment($equipment);

            $equipmentRep = new \Repository\EquipmentRepository();

            $equipmentRep->insert($equipment);


            $returnEquipments = $equipmentRep->findEquipmentInserted($equipment);

            if (count($returnEquipments) > 1) {
                throw new Exception('Many equipments');
            }

            $resource = new \League\Fractal\Resource\Item($returnEquipments[0], new \Transformer\EquipmentTransformer());

            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {
            
            return $this->error($exc->getMessage());
        }
        
    }
    
    
    
    public function putEquipmentAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $app->add(new \Slim\Middleware\ContentTypes());
            $data = $app->request()->getBody();

            $equipmentPut = json_decode($data);

            $equipmentRep = new \Repository\EquipmentRepository();
            
            $equipment = $equipmentRep->getEquipment($equipmentPut->equipment_id);

            $equipment->setName($equipmentPut->name);
//            $equipment->setAreaId($equipmentPut->area_id);

            $this->validateEquipment($equipment);
            if($equipmentRep->existsOther($equipment)){
                throw new \Exception('Equipamento já cadastrado');
            }

            $equipmentRep->update($equipment);

            $resource = new \League\Fractal\Resource\Item($equipment, new \Transformer\EquipmentTransformer());

            return $this->writeJson($resource, 200);
            
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

    
    
    public function deleteAreaAction($id) {

        try {

            $app = \Slim\Slim::getInstance();
            $app->add(new \Slim\Middleware\ContentTypes());
            $data = $app->request()->getBody();

            $equipmentDelete = json_decode($data);

            $equipmentRep = new \Repository\EquipmentRepository();
            $equipment = $equipmentRep->getEquipment($id);

            
            $equipmentRep->delete($equipment);

            $resource = new \League\Fractal\Resource\Item($equipment, new \Transformer\EquipmentTransformer());

            return $this->writeJson($resource, 200);
            
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

}
