<?php

namespace Util;

/**
 * Description of Database
 *
 * @author eloir
 */
class Database {

    /**
     *
     * @var \PDO
     */
    private $connection;
    private static $instance;
    private $host = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $database = 'ciclo_catalog';

    /**
     * 
     * @return Database
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __construct() {
        $this->connect();
    }

        private function connect() {

        $db = new \PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);  
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection = $db;
    }
    /**
     * 
     * @return \PDO
     */
    function getConnection() {
        return $this->connection;
    }

    public function __clone() {
        
    }

}
