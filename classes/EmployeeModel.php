<?php
require(__DIR__ . '/../autoload.php');

class EmployeeModel {
    private $con;
    private $db;
    public $id_emp;
    public $surname;
    public $name;
    public $patronymic;
    public $passport_serial_number;
    public $passport_number;
    public $email;
    public $address;
    public $department;
    public $position;
    public $salary;
    public $hired_date;
    public $is_fired;

    public function __construct($id){
        $this->db = new Database();
        $this->con = $this->$db->getConnection();
        $sql = 'select * from employees where id_employee = ' . $id;
        $sth = $this->con->prepare($sql);
        $sth->execute();
        $res = $sth->fetchAll();
        $this->id_emp = $res[0]['id_employee'];
        $this->surname = $res[0]['surname'];
        $this->name = $res[0]['name_emp'];
        $this->patronymic = $res[0]['patronymic'];
        $this->passport_serial_number = $res[0]['passport_serial_number'];
        $this->passport_number = $res[0]['passport_number'];
        $this->email = $res[0]['email'];
        $this->address = $res[0]['address'];
        $this->department = $res[0]['department'];
        $this->position = $res[0]['position'];
        $this->salary = $res[0]['salary'];
        $this->hired_date = $res[0]['hired_date'];
        $this->is_fired = $res[0]['is_fired'];
    }
}