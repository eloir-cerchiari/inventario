<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Repository;

/**
 * Description of EquipmentRepository
 *
 * @author eloir
 */
class EquipmentRepository extends Repository {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return array(\Entity\Equipment)
     */
    public function listEquipments() {
        $sql = 'SELECT * FROM equipment order by name';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->equipmentFactory($result);
    }

    /**
     * 
     * @return \Entity\Area
     */
    public function listEquipmentsByAreaId($areaId) {
        $sql = 'SELECT * FROM equipment WHERE area_id = :area_id order by name';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('area_id', $areaId);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->equipmentFactory($result);
    }

    private function equipmentFactory($result) {

        $equipments = array();

        if (is_array($result)) {

            if (count($result) > 0) {

                foreach ($result as $value) {
                    $equipment = new \Entity\Equipment();
                    $equipment->setEquipmentId($value['equipment_id']);
                    $equipment->setAreaId($value['area_id']);
                    $equipment->setName($value['name']);
                    $equipments[] = $equipment;
                }
            }
        }

        return $equipments;
    }

    /**
     * 
     * @param \Entity\Equipment $equipment
     * @return boolean
     */
    public function exists($equipment) {


        $sql = 'SELECT * FROM equipment WHERE name = :name and area_id = :area_id';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $equipment->getName());
        $stmt->bindParam('area_id', $equipment->getAreaId());
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $equipments = $this->equipmentFactory($result);
        
        if (count($equipments) > 0) {
            return true;
        }

        return false;
    }

    /**
     * 
     * @param \Entity\Equipment $equipment
     * @return boolean
     */
    public function insert($equipment) {
        
        if ($this->exists($equipment)) {

            throw new \Exception('Equipamento já existe.');
        
            
        }

        $sql = 'INSERT INTO equipment (name, area_id) values (:name,:area_id); ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $equipment->getName());
        $stmt->bindParam('area_id', $equipment->getAreaId());


        return $stmt->execute();
    }
    
    
        /**
     * 
     * @param \Entity\Equipment $equipment
     * @return boolean
     */
    public function existsOther($equipment) {


        $sql = 'SELECT * FROM equipment WHERE name = :name and area_id = :area_id and equipment_id <> :equipment_id';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $equipment->getName());
        $stmt->bindParam('area_id', $equipment->getAreaId());
        $stmt->bindParam('equipment_id', $equipment->getEquipmentId());
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $equipments = $this->equipmentFactory($result);
        
        if (count($equipments) > 0) {
            return true;
        }

        return false;
    }

    
    
    
    /**
     * 
     * @param \Entity\Equipment $equipment
     */
    public function update($equipment) {

        if ($this->existsOther($equipment)) {
            return false;
        }
        
        $sql = 'UPDATE equipment SET name=:name WHERE equipment_id = :equipment_id';
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $equipment->getName());
        $stmt->bindParam('equipment_id', $equipment->getEquipmentId());

        return $stmt->execute();

   }
   
   
   /**
     * 
     * @param \Entity\Equipment $equipment
     */
    public function delete($equipment) {

        $sql = 'delete from  equipment  WHERE equipment_id=:id';
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('id', $equipment->getEquipmentId());

        return $stmt->execute();
    }

    /**
     * 
     * @param \Entity\Equipment $equipment
     */
    public function findEquipmentInserted($equipment){
        $sql = 'SELECT * FROM equipment WHERE name = :name and area_id = :area_id ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $equipment->getName());
        $stmt->bindParam('area_id', $equipment->getAreaId());
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $equipments = $this->equipmentFactory($result);
        
        if (count($equipments) < 1) {
            return false;
        }

        return $equipments;
    }
    
    
    
    /**
     * 
     * @param int $equipmentId
     * @return \Entity\Equipment
     */
    public function getEquipment($equipmentId) {

        $sql = 'SELECT * FROM equipment WHERE equipment_id = :id';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('id', $equipmentId);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $equipments = $this->equipmentFactory($result);

        if (count($equipments) == 1) {
            return $equipments[0];
        } else {
            return $equipments;
        }
    }
    
}