<?php
class Database {
    protected $dbh;

    public function __construct() {
        $this->dbh = new PDO('pgsql:host=localhost;port=5432;dbname=areal_test', 'postgres', '0000'); //строка подключения к БД, для запуска нужно изменить на свою!!
    }

    public function getConnection() {
        return $this->dbh;
    }
}