<?php
namespace Entity;

/**
 * Description of Event
 *
 * @author eloir
 */
class Event {
    
    private $id;
    
    private $equipmentId;
    
    private $userId;
    
    private $timestamp;
    
    private $description;
    
    private $type;
    
    private $time;
    
    
    /**
     *
     * @var User 
     */
    private $user;
    
    public function getId() {
        return $this->id;
    }

    public function getEquipmentId() {
        return $this->equipmentId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getType() {
        return $this->type;
    }

    public function getTime() {
        return $this->time;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEquipmentId($equipmentId) {
        $this->equipmentId = $equipmentId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setTime($time) {
        $this->time = $time;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }
    
}