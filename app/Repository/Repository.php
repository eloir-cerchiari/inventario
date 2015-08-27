<?php

namespace Repository;

/**
 * Description of Repository
 *
 * @author eloir
 */
class Repository {
    protected $db;

    protected function __construct() {
        $this->db = \Util\Database::getInstance();
    }
}
