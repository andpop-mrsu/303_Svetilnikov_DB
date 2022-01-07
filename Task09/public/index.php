<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Автомойка</title>
</head>
<body>

<H1 align="center"><U><B>Все мастера</B></U></H1>
<?php
$pdo = new PDO('sqlite:../data/car_wash.db');
$request = "SELECT id, surname, name, patronymic FROM master where status = 'on' ORDER BY surname";
$statement = $pdo->query($request);
$rows = $statement->fetchAll();
$statement->closeCursor();

?>

<table class="masters-table" cellpadding="10" cellspacing="0" width="100% "border="2">
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Редактирование</th>
        <th>Удаление</th>
        <th>График</th>
        <th>Выполненные работы</th>
    </tr>
    <?php for($i = 0; $i < count($rows); $i++) { ?>

    <tr>
        <td><?= $rows[$i]['surname'] ?></td>
        <td><?= $rows[$i]['name'] ?></td>
        <td><?= $rows[$i]['patronymic'] ?></td>
            <td>
                <a href="update_master.php?master_id=<?= $rows[$i]['id'] ?>">Редактировать</a>
            </td>
            <td>
                <a href="delete_master/delete_master.php?master_id=<?= $rows[$i]['id'] ?>">Удалить</a>
            </td>
            <td>
                <a href="schedule/schedule.php?master_id=<?= $rows[$i]['id'] ?>">График работы</a>
            </td>
            <td>
                <a href="completed_works.php?master_id=<?= $rows[$i]['id'] ?>">Выполненные работы</a>
            </td>
        </tr>
    <?php } ?>

</table>

<H1></H1>
<H1></H1>

<form method="post" action="create_master.php">
    <button><B>Добавить мастера</B></button>
</form>
</body>
</html>