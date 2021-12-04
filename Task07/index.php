<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Автомойка</title>
</head>
<body>

<?php
$pdo = new PDO('sqlite:car_wash.db');

$request = "SELECT id, surname, name, patronymic FROM master ORDER BY id";
$statement = $pdo->query($request);
$rows = $statement->fetchAll();
$statement->closeCursor();
?>

<h1>Выберите ID мастера</h1>
<form action="" method="POST">
    <label>
        <select style="width: 150px;" name="id">
            <option value=<?= null ?>>
                Все мастера
            </option>			
			<?php for($i = 0; $i < count($rows); $i++) { ?>
                <option value= <?= $rows[$i]['id'] ?>>
                    <?= $rows[$i]['id'] ?>
                </option>
            <?php } ?>
        </select>
    </label>
    <button type="submit">Поиск</button>
</form>

<?php
$id = 0;
if(isset($_POST['id'])){
    $id = (int)$_POST['id'];
}

if ($id == 0) {
    $request = "SELECT master.id, master.surname, master.name, master.patronymic, box.date, box.start_time, box.end_time, services.title st, car_category.title cct, services.price FROM ((((master JOIN work ON master.id = work.master_id) JOIN services ON work.services_id = services.id) JOIN box ON master.box_id = box.id) JOIN car_category ON services.car_category_id = car_category.id) ORDER BY master.surname, box.date, box.start_time";
}
else {
    $request = "SELECT master.id, master.surname, master.name, master.patronymic, box.date, box.start_time, box.end_time, services.title st, car_category.title cct, services.price FROM ((((master JOIN work ON master.id = work.master_id) JOIN services ON work.services_id = services.id) JOIN box ON master.box_id = box.id) JOIN car_category ON services.car_category_id = car_category.id) WHERE master.id = {$id} ORDER BY master.surname, box.date, box.start_time";
}
$statement = $pdo->query($request);
$rows = $statement->fetchAll();
?>
<H1></H1>
<table class="masters-table" cellpadding="10" cellspacing="0" width="100% "border="2">
    <tr class="table-header">
        <th>Id</th>
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
            <td><?= $rows[$i]['id'] ?></td>
            <td><?= $rows[$i]['surname'] ?></td>
            <td><?= $rows[$i]['name'] ?></td>
			<td><?= $rows[$i]['patronymic'] ?></td>
            <td><?= $rows[$i]['date'] ?></td>
            <td><?= $rows[$i]['start_time'] ?></td>
            <td><?= $rows[$i]['end_time'] ?></td>
			<td><?= $rows[$i]['st'] ?></td>
			<td><?= $rows[$i]['cct'] ?></td>
            <td><?= $rows[$i]['price'] ?></td>
        </tr>
    <?php }; ?>

</table>
</body>
</html>