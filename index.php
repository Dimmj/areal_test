<?php
require(__DIR__ . '/autoload.php');
$rep = new EmployeeRepository();
$employees = $rep->filter('', '');
echo '<link rel="stylesheet" type="text/css" href="style/style.css">';
?>
<h3>Фильтр</h3>
<form name="filter" action="/filter.php" method="POST">
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
    <select name="position_emp">
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

    <button type="submit">Применить</button>
</form>
<hr>
<h3>Поиск сотрудников</h3>
<form name="search" action="/search.php" method="POST">
    <h3>Фамилия </h3>
    <input type="text" name="surname" required>
    <h3>Имя </h3>
    <input type="text" name="name" required>

    <h3>Отчество </h3>
    <input type="text" name="patronymic" required>

    <button type="submit">Поиск</button>
</form>
<hr>
<h3>Добавить сотрудника</h3>
<form name="add" action="/add.php" method="POST">
    <h3>Фамилия </h3>
    <input type="text" name="surname" required>
    <h3>Имя </h3>
    <input type="text" name="name" required>

    <h3>Отчество </h3>
    <input type="text" name="patronymic" required>

    <h3>Серия паспорта </h3>
    <input type="text" name="passport_serial_number" required>

    <h3>Номер паспорта </h3>
    <input type="text" name="passport_number" required>

    <h3>Электронная почта </h3>
    <input type="text" name="email" required>

    <h3>Адрес </h3>
    <input type="text" name="address" required>

    <h3>Отдел </h3>
    <select name="department" required>
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
    <select name="position" required>
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
    <input type="text" name="salary" required>

    <h3>Дата принятия на работу </h3>
    <input type="text" name="hired_date" required>

    <button type="submit">Добавить сотрудника</button>
</form>
<hr>
<?php if (empty($employees)): ?>
    <p>Нет сотрудников для отображения</p>
<?php else: ?>
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
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?php echo $emp['id_employee']; ?></td>
                    <td>
                        <?php 
                        echo $emp['surname'] . ' ' . 
                             $emp['name_emp'] . ' ' . 
                             $emp['patronymic']; 
                        ?>
                    </td>
                    <td>
                        <?php 
                        echo $emp['passport_serial_number'] . ' ' . $emp['passport_number'];
                        ?>
                    </td>
                    <td><?php echo $emp['email']; ?></td>
                    <td><?php echo $emp['address']; ?></td>
                    <td><?php echo $emp['department']; ?></td>
                    <td><?php echo $emp['position_name']; ?></td>
                    <td><?php echo $emp['salary']; ?> ₽</td>
                    <td><?php echo $emp['hired']; ?></td>
                    <td>
                        <?php if ($emp['is_fired']): ?>
                            <span>Уволен</span>
                        <?php else: ?>
                            <span>Работает</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- Форма для увольнения -->
                        <form method="POST" action="/fired.php">
                            <input type="hidden" name="employee_id" value="<?php echo $emp['id_employee']; ?>">
                            <button type="submit" onclick="return confirm('Вы уверены, что хотите уволить этого сотрудника?')">
                                Уволить
                            </button>
                        </form>
                    </td>
                    <td>
                        <!-- Форма для редактирования -->
                        <form method="POST" action="/edit.php">
                            <input type="hidden" name="employee_id" value="<?php echo $emp['id_employee']; ?>">
                            <button type="submit">Редактировать</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>