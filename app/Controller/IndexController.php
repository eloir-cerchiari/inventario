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

    public function indexAction(){
        return $this->renderHtml('ocorrencias.php');
    }
    
    public function cadastroAreaAction(){
        return $this->renderHtml('cadastroarea.php');
    }
    
    public function cadastroEquipamentoAction(){
        return $this->renderHtml('cadastroequipamento.php');
    }
    
    public function cadastroUsuarioAction(){
        return $this->renderHtml('cadastrousuario.php');
    }
    
}