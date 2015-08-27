<?php

namespace Entity;

/**
 * Description of Area
 *
 * @author eloir
 */
class Area {

    private $areaId;
    private $name;

    public function __construct() {
        
    }

    public function getAreaId() {
        return $this->areaId;
    }

    public function getName() {
        return $this->name;
    }

    public function setAreaId($areaId) {
        $this->areaId = $areaId;
    }

    public function setName($name) {
        $this->name = $name;
    }
    

}
