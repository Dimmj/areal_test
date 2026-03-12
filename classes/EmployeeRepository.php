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

    public function get_positions() {
        $sql = "select position_name from positions";
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function get_departments() {
        $sql = "select department from departments";
        $sth = $this->con->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public function edit($emp) {
        try{
            error_log($emp->is_fired);
            $sql = "update employees set 
            surname = '" . $emp->surname .
            "', name_emp = '" . $emp->name_emp . 
            "', patronymic = '" . $emp->patronymic .
            "',passport_serial_number = " . $emp->passport_serial_number . 
            ",passport_number = " . $emp->passport_number .
            ",email = '" . $emp->email . 
            "', address = '" . $emp->address .
            "', department = " . $this->foreign_department($emp->department) .
            ",position_emp = " . $this->foreign_position($emp->position_emp) .
            ",salary = " . $emp->salary .
            ",hired = '" . $emp->hired .
            "', is_fired = " . $emp->is_fired . 
            " where id_employee = " . $emp->id_employee;
            $sth = $this->con->prepare($sql);
            $sth->execute();
        } catch (PDOException $e) {
        error_log("Ошибка в edit: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        return false;
        }
    }

    public function create($params) {
        try{
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
        } catch (PDOException $e) {
        error_log("Ошибка в create: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        return false;
        }
    }

    public function filter($department, $position){
        try {
            if ($department && $position){
                $sql = "select id_employee, surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, departments.department, positions.position_name, salary, hired, is_fired from employees  
                    join departments on employees.department = departments.id_department
                    join positions on employees.position_emp = positions.id_position 
                    where departments.department = '" . $department . "' and positions.position_name = '" . $position . "' and is_fired = false";

            }
            else if ($department && !$position) {
                $sql = "select id_employee, surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, departments.department, positions.position_name, salary, hired, is_fired from employees  
                    join departments on employees.department = departments.id_department
                    join positions on employees.position_emp = positions.id_position 
                    where departments.department = '" . $department . "' and is_fired = false";
            }
            else if (!$department && $position) {
                $sql = "select id_employee, surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, departments.department, positions.position_name, salary, hired, is_fired from employees  
                    join departments on employees.department = departments.id_department
                    join positions on employees.position_emp = positions.id_position 
                    where positions.position_name = '" . $position . "' and is_fired = false";
            } else {
                // Если оба параметра пустые, возвращаем всех сотрудников
                $sql = "select id_employee, surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, departments.department, positions.position_name, salary, hired, is_fired from employees  
                    join departments on employees.department = departments.id_department
                    join positions on employees.position_emp = positions.id_position";
            }
            $sth = $this->con->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        } catch (PDOException $e) {
        error_log("Ошибка в filter: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        return false;
        }
    }

    public function search($surname, $name, $patronymic){
        try{
            $sql = "select id_employee, surname, name_emp, patronymic, passport_serial_number, passport_number, email, address, departments.department, positions.position_name, salary, hired, is_fired from employees  
                    join departments on employees.department = departments.id_department
                    join positions on employees.position_emp = positions.id_position 
                    where surname = '" . $surname . "' and name_emp = '" . $name . "' and patronymic = '" . $patronymic . "'";
            $sth = $this->con->prepare($sql);
            $sth->execute();
            return $sth->fetchAll();
        } catch (PDOException $e) {
        error_log("Ошибка в search: " . $e->getMessage());
        error_log("SQL запрос: " . $sql);
        return false;
        }
    }
}