<?php
class EmployeeModel {
    private $con;
    private $db;
    private $table = 'employees';

    public function __construct() {
        $this->$db = new Database();
        $this->$con = $this->$db->getConnection();
    }

    public function fired($id) {
        $sql = 'update ';
        $sth = $this->con->prepare($sql);
        $sth->execute();
    }
}