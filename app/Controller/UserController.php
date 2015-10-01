<?php

namespace Controller;

/**
 * Description of UserController
 *
 * @author eloir
 */
class UserController extends Controller{

    public function getAction($id){
        try {
            $userRep = new \Repository\UserRepository();

            $user = $userRep->getUser($id);

            $resource = new \League\Fractal\Resource\Item($user, new \Transformer\UserTransformer());

            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error('User no Exists');
        }
    }
    
    public function listAction(){
        
        try {
            $userRep = new \Repository\UserRepository();
            $users = $userRep->listUsers();
            if (is_null($users) || count($users) < 1) {
                throw new \Exception('No Users');
            }
            $resource = new \League\Fractal\Resource\Collection($users, new \Transformer\UserTransformer());
            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error($err->getMessage());
        }

        
    }
    
    public function putAction(){
        
        
    }
    
    public function postAction(){
        
        
    }
    
    public function deleteAction(){
        
    }
    
}
