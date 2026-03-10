<?php
require(__DIR__ . '/autoload.php');
error_log('я хотя бы здесь')
?>

<form name="add" action="/add.php" method="POST">
    <h3>Фамилия </h3>
    <input type="text" name="surname">
    <h3>Имя </h3>
    <input type="text" name="name">

    <h3>Отчество </h3>
    <input type="text" name="patronymic">

    <h3>Серия паспорта </h3>
    <input type="text" name="passport_serial_number">

    <h3>Номер паспорта </h3>
    <input type="text" name="passport_number">

    <h3>Электронная почта </h3>
    <input type="text" name="email">

    <h3>Адрес </h3>
    <input type="text" name="address">

    <h3>Отдел </h3>
    <input type="text" name="department">

    <h3>Должность </h3>
    <input type="text" name="position">

    <h3>Зарплата </h3>
    <input type="text" name="salary">

    <h3>Дата принятия на работу </h3>
    <input type="text" name="hired_date">

    <button type="submit">Добавить сотрудника</button>
</form>