<?php
class Database {
    protected $dbh;

    public function __construct() {
        $this->dbh = new PDO('pgsql:host=localhost;port=5432;dbname=employees', 'postgres', '0000');
    }

    public function getConnection() {
        return this->$dbh;
    }
}