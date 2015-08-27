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
                throw new Exception('No Areas');
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

}
