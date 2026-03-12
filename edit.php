<?php
require(__DIR__ . '/autoload.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rep = new EmployeeRepository();
    $emp = new EmployeeModel($_POST['employee_id']);
    //если уволен
    if ($emp->is_fired) {
        header('Location: /index.php');
    }
    echo '<link rel="stylesheet" type="text/css" href="style/style.css">';
}?>
<a href="http://localhost:8000/">Вернуться на главную</a>
<br><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Паспорт</th>
            <th>Email</th>
            <th>Адрес</th>
            <th>Отдел</th>
            <th>Должность</th>
            <th>Зарплата</th>
            <th>Дата принятия</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $emp->id_employee; ?></td>
            <td>
                <?php 
                echo $emp->surname . ' ' . 
                        $emp->name_emp . ' ' . 
                        $emp->patronymic; 
                ?>
            </td>
            <td>
                <?php 
                echo $emp->passport_serial_number . ' ' . $emp->passport_number;
                ?>
            </td>
            <td><?php echo $emp->email; ?></td>
            <td><?php echo $emp->address; ?></td>
            <td><?php echo $rep->get_departments()[$emp->department - 1][0]; ?></td>
            <td><?php echo $rep->get_positions()[$emp->position_emp - 1][0]; ?></td>
            <td><?php echo $emp->salary ?> ₽</td>
            <td><?php echo $emp->hired; ?></td>
            <td>
                <?php if ($emp->is_fired == 'true'): ?>
                    <span>Уволен</span>
                <?php else: ?>
                    <span>Работает</span>
                <?php endif; ?>
            </td>
            <td>
                <!-- Форма для увольнения -->
                <form method="POST" action="/fired.php">
                    <input type="hidden" name="employee_id" value="<?php echo $emp->id_employee; ?>">
                    <button type="submit" onclick="return confirm('Вы уверены, что хотите уволить этого сотрудника?')">
                        Уволить
                    </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>

<form name="edit" action="/edit_handler.php" method="POST">
    <input type="hidden" name="employee_id" value="<?php echo $emp->id_employee; ?>">
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
    <select name="department">
        <option value="">Выберите отдел</option>
        <?php
        // Получаем данные из функции
        $departments = $rep->get_departments();
        // Выводим опции
        foreach ($departments as $department):
        ?>
        <option value="<?php echo $department['department']; ?>">
            <?php echo $department['department']; ?>
        </option>
        <?php endforeach; ?>
    </select>
    <h3>Должность </h3>
    <select name="position">
        <option value="">Выберите должность</option>
        <?php
        // Получаем данные из функции
        $positions = $rep->get_positions();
        // Выводим опции
        foreach ($positions as $position):
        ?>
        <option value="<?php echo $position['position_name']; ?>">
            <?php echo $position['position_name']; ?>
        </option>
        <?php endforeach; ?>
    </select>

    <h3>Зарплата </h3>
    <input type="text" name="salary">

    <h3>Дата принятия на работу </h3>
    <input type="text" name="hired_date">

    <button type="submit" onclick="return confirm('Вы уверены?')">
        Применить изменения
    </button>
</form>