<?php

namespace Entity;

/**
 * Description of Brand
 *
 * @author eloir
 */
class Brand {
    private $brandId;
    private $name;
    private $logoImage;
    
    public function getBrandId() {
        return $this->brandId;
    }

    public function getName() {
        return $this->name;
    }

    public function setBrandId($brandId) {
        $this->brandId = $brandId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLogoImage() {
        return $this->logoImage;
    }

    public function setLogoImage($logoImage) {
        $this->logoImage = $logoImage;
    }



}
