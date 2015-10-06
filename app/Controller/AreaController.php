<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of AreaController
 *
 * @author eloir
 */
class AreaController extends \Controller\Controller {

    public function __construct() {
        parent::__construct();
    }

    public function listAreasAction() {

        try {
            $areaRep = new \Repository\AreaRepository();
            $areas = $areaRep->listAreas();
            if (is_null($areas) || count($areas) < 1) {
                throw new \Exception('No Areas');
            }
            $resource = new \League\Fractal\Resource\Collection($areas, new \Transformer\AreaTransformer());
            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }
    }

    public function filterAreasAction() {

        try {
            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $areaPost = json_decode($data);
            
            $areaRep = new \Repository\AreaRepository();
            $areas = $areaRep->findByPattern($areaPost->name);
            
            if (is_null($areas) || count($areas) < 1) {
                throw new \Exception('No Areas');
            }
            $resource = new \League\Fractal\Resource\Collection($areas, new \Transformer\AreaTransformer());
            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error($err->getMessage(), $status);
        }
    }

    public function getAreaAction($id) {
        try {
            $areaRep = new \Repository\AreaRepository();

            $area = $areaRep->getArea($id);

            $resource = new \League\Fractal\Resource\Item($area, new \Transformer\AreaTransformer());

            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error('Area no Exists');
        }
    }

    /**
     * 
     * @param \Entity\Area $area
     */
    private function validateArea($area) {

        if (get_class($area) != 'Entity\Area') {
            throw new \Exception('Área inválida');
        }

        if (strlen($area->getName()) < 1) {
            throw new \Exception('Tamanho mínimo é 1 caracter');
        }

        if (strlen($area->getName()) > 50) {
            throw new \Exception('Tamanho máximo é 50 caracteres');
        }

        return true;
    }

    public function postAreaAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $areaPost = json_decode($data);

            $area = new \Entity\Area();
            $area->setName($areaPost->name);

            $this->validateArea($area);

            $areaRep = new \Repository\AreaRepository();

            $areaRep->insert($area);


            $returnAreas = $areaRep->finByName($area->getName());

            if (count($returnAreas) > 1) {
                throw new Exception('Many areas');
            }

            $resource = new \League\Fractal\Resource\Item($returnAreas[0], new \Transformer\AreaTransformer());

            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {
            
            return $this->error($exc->getMessage());
        }
    }

    public function putAreaAction($id) {

        try {

            $app = \Slim\Slim::getInstance();
            $app->add(new \Slim\Middleware\ContentTypes());
            $data = $app->request()->getBody();

            $areaPut = json_decode($data);

            $areaRep = new \Repository\AreaRepository();
            $area = $areaRep->getArea($id);

            $area->setName($areaPut->name);

            $this->validateArea($area);
            if($areaRep->exists($area)){
                throw new \Exception('Área já cadastrada');
            }

            $areaRep->update($area);

            $resource = new \League\Fractal\Resource\Item($area, new \Transformer\AreaTransformer());

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

         
            $areaRep = new \Repository\AreaRepository();
            $area = $areaRep->getArea($id);

            
            $areaRep->delete($area);

            $resource = new \League\Fractal\Resource\Item($area, new \Transformer\AreaTransformer());

            return $this->writeJson($resource, 200);
            
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

}
