<?php
require(__DIR__ . '/autoload.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rep = new EmployeeRepository();
    $s_emp = $rep->filter($_POST['department'], $_POST['position_emp']);
}?>

<?php if (empty($s_emp)): ?>
    <a href="http://localhost:8000/">Вернуться на главную</a>
    <p>Нет сотрудников для отображения</p>
<?php else: ?>
    <a href="http://localhost:8000/">Вернуться на главную</a>
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
            <?php foreach ($s_emp as $emp): ?>
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

