<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of IndexController
 *
 * @author eloir
 */
class IndexController extends Controller{
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        return $this->renderHtml('ocorrencias.php');
        
    }
}
