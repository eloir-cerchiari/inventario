<?php


namespace Entity;

/**
 * Description of Equipment
 *
 * @author eloir
 */
class Equipment {

    private $equipmentId;
    private $areaId;
    private $name;
    
    public function getEquipmentId() {
        return $this->equipmentId;
    }

    public function getAreaId() {
        return $this->areaId;
    }

    public function getName() {
        return $this->name;
    }

    public function setEquipmentId($equipmentId) {
        $this->equipmentId = $equipmentId;
    }

    public function setAreaId($areaId) {
        $this->areaId = $areaId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function __construct() {
        
    }

    
}
