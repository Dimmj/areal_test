<?php
require(__DIR__ . '/autoload.php');
error_log('я попал сюда');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log('метод пост');
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    if ($email) {
        error_log('почта норма');
        $rep = new EmployeeRepository();
        $params = $_POST;
        $params['passport_serial_number'] = (int)$params['passport_serial_number'];
        $params['passport_number'] = (int)$params['passport_number'];
        $params['salary'] = (float)$params['salary'];
        $params['is_fired'] = 'false';
        $rep->create($params);
    }
}

header('Location: /index.php');