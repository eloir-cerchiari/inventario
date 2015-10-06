<?php

namespace Controller;

/**
 * Description of UserController
 *
 * @author eloir
 */
class UserController extends Controller {

    public function getAction($id) {
        try {
            $userRep = new \Repository\UserRepository();

            $user = $userRep->getUser($id);

            $resource = new \League\Fractal\Resource\Item($user, new \Transformer\UserTransformer());

            $this->writeJson($resource);
        } catch (\Exception $err) {
            $this->error('User no Exists');
        }
    }

    public function listAction() {

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

    /**
     * 
     * @param \Entity\User $user
     */
    private function validateUser($user) {

        if (get_class($user) != 'Entity\User') {
            throw new \Exception('Usuário inválido');
        }

        if (strlen($user->getName()) < 2) {
            throw new \Exception('Nome muito curto');
        }

        if (strlen($user->getName()) > 50) {
            throw new \Exception('Nome muito longo, máximo é 60 caracteres');
        }

        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email Incorreto');
        }

        if (strlen($user->getPassword()) > 0 && strlen($user->getPassword()) < 3) {
            throw new \Exception('Senha muito curta');
        }

        return true;
    }

    public function putAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $user = $this->jsonToUser(json_decode($data));


            $this->validateUser($user);

            $userRep = new \Repository\UserRepository();

            $userRep->update($user);

            $resource = new \League\Fractal\Resource\Item($user, new \Transformer\UserTransformer());
            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {
            return $this->error($exc->getMessage());
        }
    }

    /**
     * 
     * @param String $json
     * @return \Entity\User 
     */
    private function jsonToUser($json) {

        $user = new \Entity\User();
        
        if (!isset($json->name)) {
            throw new \Exception('Nome em Branco');
        }
        if (!isset($json->email)) {
            throw new \Exception('Email em Branco');
        }
        if (!isset($json->group)) {
            throw new \Exception('Grupo em Branco');
        }

        if (isset($json->id)) {
            $user->setUserId($json->id);
        }
        $user->setName($json->name);
        $user->setActive(true);
        $user->setEmail($json->email);
        $user->setGroup($json->group);
        if (isset($json->password)) {
            $user->setPassword($json->password);
        }

        return $user;
    }

    public function postAction() {

        try {

            $app = \Slim\Slim::getInstance();
            $data = $app->request->getBody();

            $user = $this->jsonToUser(json_decode($data));


            $this->validateUser($user);

            $userRep = new \Repository\UserRepository();

            $userRep->insert($user);

            $returnUsers = $userRep->finByName($user->getName());
            if (count($returnUsers) > 1) {
                throw new Exception('Many users');
            }

            $resource = new \League\Fractal\Resource\Item($returnUsers[0], new \Transformer\UserTransformer());
            return $this->writeJson($resource, 200);
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

    public function deleteAction($id) {
         try {

            $app = \Slim\Slim::getInstance();
            $app->add(new \Slim\Middleware\ContentTypes());
            $data = $app->request()->getBody();

            
            $userRep = new \Repository\UserRepository();
            $user = $userRep->getUser($id);

            
            $userRep->delete($user);

            $resource = new \League\Fractal\Resource\Item($user, new \Transformer\UserTransformer());

            return $this->writeJson($resource, 200);
            
        } catch (\Exception $exc) {

            return $this->error($exc->getMessage());
        }
    }

}
