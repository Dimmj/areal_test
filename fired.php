<?php
require(__DIR__ . '/autoload.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp = new EmployeeModel($_POST['employee_id']);
    $rep = new EmployeeRepository();
    $emp->is_fired = 'true';
    
    $emp->id_to_text();

    $rep->edit($emp);
}

header('Location: /index.php');