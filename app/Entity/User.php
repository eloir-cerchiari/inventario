<?php

namespace Entity;

/**
 * Description of User
 *
 * @author eloir
 */
class User {

    private $userId;
    private $name;
    private $password;
    private $email;
    private $active;
    private $group;
    
    public function __construct() {
        
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getActive() {
        return $this->active;
    }

    public function getGroup() {
        return $this->group;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setGroup($group) {
        $this->group = $group;
    }


}
