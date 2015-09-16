<?php

namespace Repository;

/**
 * Description of AreaRepository
 *
 * @author eloir
 */
class AreaRepository extends Repository {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return \Entity\Area
     */
    public function listAreas() {
        $sql = 'SELECT * FROM area';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->areaFactory($result);
    }

    public function getArea($idArea) {

        $sql = 'SELECT * FROM area WHERE idarea = :id';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('id', $idArea);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $areas = $this->areaFactory($result);

        if (count($areas) == 1) {
            return $areas[0];
        } else {
            return $areas;
        }
    }

    public function finByName($name) {

        $sql = 'SELECT * FROM area WHERE name = :name';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $name);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->areaFactory($result);
    }

    private function areaFactory($result) {

        $areas = array();

        if (is_array($result)) {

            if (count($result) > 0) {

                foreach ($result as $value) {
                    $area = new \Entity\Area();
                    $area->setAreaId($value['idarea']);
                    $area->setName($value['name']);
                    $areas[] = $area;
                }
            }
        }

        return $areas;
    }

    /**
     * 
     * @param \Entity\Area $area
     * @return boolean
     */
    public function exists($area) {

        $areas = $this->finByName($area->getName());

        if (count($areas) > 0) {

            foreach ($areas as $areaI) {

                if ($areaI->getAreaId() != $area->getAreaId()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 
     * @param \Entity\Area $area
     * @return boolean
     */
    public function insert($area) {
        if ($this->exists($area)) {
           
            throw new \Exception('Área já existe.');
        }

        $sql = 'INSERT INTO area (name) values (:name); ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $area->getName());


        return $stmt->execute();
    }

    /**
     * 
     * @param \Entity\Area $area
     */
    public function update($area) {

        $sql = 'UPDATE area SET name=:name WHERE idarea=:id';
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $area->getName());
        $stmt->bindParam('id', $area->getAreaId());

        return $stmt->execute();
    }

}
