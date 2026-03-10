<?php
require(__DIR__ . '/../autoload.php');

class EmployeeRepository {
    private $con;
    private $db;
    private $table = 'employees';

    public function __construct() {
        $this->db = new Database();
        $this->con = $this->db->getConnection();
    }

    private function foreign_department($department){
        $sql = "select id_department from departments where department = '" . $department . "'";
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll()[0]['id_department'];
    }

    private function foreign_position($position){
        $sql = "select id_position from positions where position_name = '" . $position . "'";
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll()[0]['id_position'];
    }
    
    public function edit($id, $params) {
        $sql = "update employees set 
        surname = '" . $params['surname'] .
        "', name = '" . $params['name'] . 
        "', patronymic = '" . $params['patronymic'] .
        ",passport_serial_number = " . $params['passport_serial_number'] . 
        ",passport_number = " . $params['passport_number'] .
        ",email = '" . $params['email'] . 
        "', address = '" . $params['address'] .
        "', department = " . $this->foreign_department($params['department']) .
        ",position_emp = " . $this->foreign_position($params['position']) .
        ",salary = " . $params['salary'] .
        ",hired_date = '" . $params['hired_date'] .
        "', is_fired = " . $params['is_fired'] . 
        "where id_employee = " . $params['id'];
        $sth = $this->con->prepare($sql);
        $sth->execute();
    }

    public function create($params) {
        $sql = "insert into employees (surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, department, position_emp, salary, hired, is_fired) values ('" .
         $params['surname'] . "', '" .
         $params['name'] . "', '" .
         $params['patronymic'] . "', " .
         $params['passport_serial_number'] . ", " .
         $params['passport_number'] . ", '" .
         $params['email'] . "', '" .
         $params['address'] . "', " .
         $this->foreign_department($params['department']) . ", " .
         $this->foreign_position($params['position']) . ", " .
         $params['salary'] . ", '" .
         $params['hired_date'] . "', " .
         $params['is_fired'] . ")";
        $sth = $this->con->prepare($sql);
        $sth->execute();
    }

    public function get_all(){
        $sql = 'select * from employees where is_fired = false';
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function filter($department, $position){
        if ($department && $position){
            $sql = 'select * from employees where department = ' . this->foreign_department($department) . ' and position_emp = ' . this->foreign_position($position) . ')';
            $sth = $this->con->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        }
        else if ($department && !$position) {
            $sql = 'select * from employees where department = ' . this->foreign_department($department) . ')';
            $sth = $this->con->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        }
        else if (!$department && $position) {
            $sql = 'select * from employees where position_emp = ' . this->foreign_position($position) . ')';
            $sth = $this->con->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        }
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function search($surname, $name, $patronymic){
        $sql = "select * from employees where surname = '" . $surname . "' and name_emp = '" . $name . "' and patronymic = '" . $patronymic . "'";
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
}