<?php

namespace Repository;

/**
 * Description of BrandRepository
 *
 * @author eloir
 */
class BrandRepository {

    private $db;

    public function __construct() {
        $this->db = \Util\Database::getInstance();
    }

    /**
     * 
     * @return \Entity\Brand
     */
    public function listBrands() {
        $sql = 'SELECT * FROM brand';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->brandFactory($result);
    }

    /**
     * 
     * @param int $id
     * @return \Entity\Brand
     * @throws \Exception
     */
    public function getBrand($id) {
        $sql = 'SELECT * FROM brand WHERE brand_id = :id';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();


        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $brands = $this->brandFactory($result);

        if (count($brands) == 1)
            return $brands[0];
        else
            throw new \Exception('Error registry not exists');
    }

    /**
     * 
     * @param \Entity\Brand $brand
     * @return boolean
     */
    public function insert($brand) {

        $sql = 'INSERT INTO brand (name) values (:name); ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $brand->getName());


        if ($stmt->execute())
            return true;

        return false;
    }

    /**
     * 
     * @param \Entity\Brand $brand
     * @return boolean
     */
    public function delete($brand) {

        $sql = 'DELETE FROM brand WHERE brand_id = :id; ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('id', $brand->getBrandId());


        if ($stmt->execute())
            return true;

        return false;
    }
    
    /**
     * 
     * @param \Entity\Brand $brand
     */
    public function update($brand){
        $sql = 'UPDATE brand SET name=:name WHERE brand_id=:id';
         $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $brand->getName());
        $stmt->bindParam('id', $brand->getBrandId());


        if ($stmt->execute())
            return true;

        return false;
    
    }

    /**
     * 
     * @param \Entity\Brand $brand
     * @return boolean
     */
    public function exists($brand) {
        $brands = $this->finByName($brand->getName());
        return count($this->finByName($brand->getName())) > 0;
    }

    
    public function finByName($name) {

        $sql = 'SELECT * FROM brand WHERE name = :name';

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('name', $name);
        $stmt->execute();


        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $brands = $this->brandFactory($result);


        return $brands;
    }

    /**
     * 
     * @param array $result
     * @return \Entity\Brand[]
     */
    private function brandFactory($result) {
        $brands = array();
        foreach ($result as $brand) {
            $brandObj = new \Entity\Brand();
            $brandObj->setBrandId($brand['brand_id']);
            $brandObj->setName($brand['name']);
            $brands[] = $brandObj;
        }

        return $brands;
    }

}