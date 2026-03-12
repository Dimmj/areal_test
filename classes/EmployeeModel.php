<?php
require(__DIR__ . '/../autoload.php');

class EmployeeModel {
    private $con;
    private $db;
    public $id_employee;
    public $surname;
    public $name_emp;
    public $patronymic;
    public $passport_serial_number;
    public $passport_number;
    public $email;
    public $address;
    public $department;
    public $position_emp;
    public $salary;
    public $hired;
    public $is_fired;

    public function __construct($id){
        $this->db = new Database();
        $this->con = $this->db->getConnection();
        $sql = 'select * from employees where id_employee = ' . $id;
        $sth = $this->con->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        $this->id_employee = $res[0]['id_employee'];
        $this->surname = $res[0]['surname'];
        $this->name_emp = $res[0]['name_emp'];
        $this->patronymic = $res[0]['patronymic'];
        $this->passport_serial_number = $res[0]['passport_serial_number'];
        $this->passport_number = $res[0]['passport_number'];
        $this->email = $res[0]['email'];
        $this->address = $res[0]['address'];
        $this->department = $res[0]['department'];
        $this->position_emp = $res[0]['position_emp'];
        $this->salary = $res[0]['salary'];
        $this->hired = $res[0]['hired'];
        $this->is_fired = $res[0]['is_fired'];
    }

    public function id_to_text(){
        try {
            $sql = "select department from departments where id_department = " . $this->department;
            $sth = $this->con->prepare($sql);
            $sth->execute();
            $this->department = $sth->fetchAll()[0]['department'];
        } catch (PDOException $e) {
        error_log("Ошибка в filter: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        }

        try {
            $sql = "select position_name from positions where id_position = " . $this->position_emp;
            $sth = $this->con->prepare($sql);
            $sth->execute();

            $this->position_emp = $sth->fetchAll()[0]['position_name'];
        } catch (PDOException $e) {
        error_log("Ошибка в filter: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        }
    }
}