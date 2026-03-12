<?php
require(__DIR__ . '/autoload.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rep = new EmployeeRepository();
    $emp = new EmployeeModel($_POST['employee_id']);
    if (isset($_POST['surname']) && !empty($_POST['surname'])) {
        $emp->surname = $_POST['surname'];
    }
    
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $emp->name_emp = $_POST['name'];
    }
    
    if (isset($_POST['patronymic']) && !empty($_POST['patronymic'])) {
        $emp->patronymic = $_POST['patronymic'];
    }
    
    if (isset($_POST['passport_serial_number']) && !empty($_POST['passport_serial_number'])) {
        $emp->passport_serial_number = $_POST['passport_serial_number'];
    }
    
    if (isset($_POST['passport_number']) && !empty($_POST['passport_number'])) {
        $emp->passport_number = $_POST['passport_number'];
    }
    
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $emp->email = $_POST['email'];
    }
    
    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $emp->address = $_POST['address'];
    }
    
    if (isset($_POST['department']) && !empty($_POST['department'])) {
        $emp->department = $_POST['department'];
    } else{
       $emp->id_to_text();
        }
    
    if (isset($_POST['position']) && !empty($_POST['position'])) {
        $emp->position_emp = $_POST['position'];
    } else{
        $emp->id_to_text();
        }
    
    if (isset($_POST['salary']) && !empty($_POST['salary'])) {
        $emp->salary = $_POST['salary'];
    }
    
    if (isset($_POST['hired_date']) && !empty($_POST['hired_date'])) {
        $emp->hired = $_POST['hired_date'];
    }
    $emp->is_fired = 'false';
    $rep->edit($emp);
}

header('Location: /index.php');