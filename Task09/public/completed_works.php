<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Выполненные работы</title>
</head>
<body>

<H1 align="center"><U><B>Выполненные работы</B></U></H1>
<H1></H1>

<?php
$pdo = new PDO('sqlite:../data/car_wash.db');
$master_id = $_GET['master_id'];
$query = "SELECT master.id, master.surname, master.name, master.patronymic, box.day, box.start_time, box.end_time, services.title st, car_category.title cct, services.price FROM ((((master JOIN work ON master.id = work.master_id) JOIN services ON work.services_id = services.id) JOIN box ON work.box_id = box.id) JOIN car_category ON services.car_category_id = car_category.id) WHERE master.id = {$master_id} ORDER BY master.surname, box.day, box.start_time";
$statement = $pdo->query($query);
$rows = $statement->fetchAll();
$statement->closeCursor();
?>

<table class="masters-table" cellpadding="10" cellspacing="0" width="100% "border="2">
    <tr class="table-header">
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата</th>
        <th>Время начала оказания услуги</th>
        <th>Время окончания оказания услуги</th>
        <th>Название услуги</th>
        <th>Категория транспортного средства</th>
        <th>Цена</th>
    </tr>
    <?php for($i = 0; $i < count($rows); $i++) { ?>

        <tr>
            <td><?= $rows[$i]['surname'] ?></td>
            <td><?= $rows[$i]['name'] ?></td>
            <td><?= $rows[$i]['patronymic'] ?></td>
            <td><?= $rows[$i]['day'] ?></td>
            <td><?= $rows[$i]['start_time'] ?></td>
            <td><?= $rows[$i]['end_time'] ?></td>
            <td><?= $rows[$i]['st'] ?></td>
            <td><?= $rows[$i]['cct'] ?></td>
            <td><?= $rows[$i]['price'] ?></td>
        </tr>
    <?php }; ?>

</table>


<H1></H1>
<form method="post" action="index.php">
    <button><B><U>На главную</U></B></button>

</form>
</body>
</html>