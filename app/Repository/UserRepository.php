<?php

namespace Repository;

/**
 * Description of UserRepository
 *
 * @author eloir
 */
class UserRepository extends Repository {

    public function __construct() {
        parent::__construct();
    }

    private function userFactory($result) {

        $users = array();

        if (is_array($result)) {

            if (count($result) > 0) {

                foreach ($result as $value) {

                    $user = new \Entity\User();

                    $user->setUserId($value['user_id']);
                    $user->setName($value['name']);
                    $user->setEmail($value['email']);
                    $user->setPassword($value['password']);
                    $user->setGroup($value['group']);
                    $user->setActive($value['active']);

                    $users[] = $user;
                }
            }
        }

        return $users;
    }

    /**
     * 
     * @return \Entity\User
     */
    public function listUsers() {
        $sql = 'SELECT * FROM user order by name';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->userFactory($result);
    }

    /**
     * 
     * @param int $idUser
     * @return \Entity\User
     */
    public function getUser($idUser) {

        $sql = 'SELECT * FROM user WHERE user_id = :id';
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam('id', $idUser);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = $this->userFactory($result);

        if (count($users) == 1) {
            return $users[0];
        } else {
            return $users;
        }
    }

    public function finByName($name) {

        $sql = 'SELECT * FROM user WHERE name = :name';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $name);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->userFactory($result);
    }

    /**
     * 
     * @param \Entity\User $user
     * @return boolean
     */
    public function exists($user) {

        $users = $this->finByName($user->getName());

        if (count($users) > 0) {
            return true;
        }

        return false;
    }

    /**
     * 
     * @param \Entity\User $user
     * @return boolean
     */
    public function existsOther($user) {

        $users = $this->finByName($user->getName());

        if (count($users) > 0) {

            foreach ($users as $userI) {

                if ($userI->getUserId() != $user->getUserId()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 
     * @param \Entity\User $user
     * @return boolean
     */
    public function insert($user) {
        if ($this->exists($user)) {

            throw new \Exception('Usuário já existe.');
        }

        $sql = 'INSERT INTO user (name, password, email, active, `group`) values (:name, :password, :email, :active, :group); ';

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('name', $user->getName());
        $stmt->bindParam('password', $user->getPassword());
        $stmt->bindParam('email', $user->getEmail());
        $stmt->bindParam('active', $user->getActive());
        $stmt->bindParam('group', $user->getGroup());


        return $stmt->execute();
    }

    /**
     * 
     * @param \Entity\User $user
     */
    public function update($user) {
        //password
        if (strlen($user->getPassword()) > 0) {
            $sql = 'UPDATE user SET name=:name, email=:email, password=:password, active=:active, `group`=:group WHERE user_id=:id';
        }
        // no password

        if (strlen($user->getPassword()) < 1) {
            $sql = 'UPDATE user SET name=:name, email=:email, active=:active, `group`=:group WHERE user_id=:id';
        }
        $stmt = $this->db->getConnection()->prepare($sql);

        // password
        if (strlen($user->getPassword()) > 0) {
            $stmt->bindParam('password', $user->getPassword());
        }

        $stmt->bindParam('name', $user->getName());
        $stmt->bindParam('email', $user->getEmail());
        $stmt->bindParam('active', $user->getActive());
        $stmt->bindParam('group', $user->getGroup());
        $stmt->bindParam('id', $user->getUserId());

        return $stmt->execute();
    }

    /**
     * 
     * @param \Entity\User $user
     */
    public function delete($user) {

        $sql = 'delete from  user  WHERE user_id=:id';
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindParam('id', $user->getUserId());

        return $stmt->execute();
    }

    /**
     * 
     * @param array $listId
     */
    public function listUsersBylistId($listId) {
        /* Create a string for the parameter placeholders filled to the number of params */
        $place_holders = implode(',', array_fill(0, count($listId), '?'));


        $sql = 'select * from user where user_id in (' . $place_holders . ')';

        $stmt = $this->db->getConnection()->prepare($sql);

        //$stmt->bindParam('userIds', $listId);
        $stmt->execute($listId);

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->userFactory($result);
    }

}
