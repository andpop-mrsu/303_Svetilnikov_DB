<?php

$pdo = new PDO('sqlite:car_wash.db');
$request = "SELECT id, surname, name, patronymic FROM master ORDER BY id";
$statement = $pdo->query($request);
$rows = $statement->fetchAll();

echo 'Все мастера:' . "\n";
for($i = 0; $i < count($rows); $i++) {
    echo $rows[$i]['id'] . ' ' . $rows[$i]['surname'] . ' ' . $rows[$i]['name'] . ' ' . $rows[$i]['patronymic']. "\n";
}

$masters = $rows;
$statement->closeCursor();

$number = readline("Введите номер мастера: ");
$existedNumber = False;
if ($number == "") {
    $request ="SELECT master.id, master.surname, master.name, master.patronymic, box.date, box.start_time, box.end_time, services.title st, car_category.title cct, services.price FROM ((((master JOIN work ON master.id = work.master_id) JOIN services ON work.services_id = services.id) JOIN box ON master.box_id = box.id) JOIN car_category ON services.car_category_id = car_category.id) ORDER BY master.surname, box.date, box.start_time";
    $statement = $pdo->query($request);
    $rows = $statement->fetchAll();
	for($i = 0; $i < count($rows); $i++) {
    echo $rows[$i]['id'] . ' ' . $rows[$i]['surname'] . ' ' . $rows[$i]['name'] . ' ' . $rows[$i]['patronymic']  . ' ' . $rows[$i]['date'] . ' ' . $rows[$i]['start_time'] . ' ' . $rows[$i]['end_time'] . ' ' . $rows[$i]['st'] . ' ' . $rows[$i]['cct'] . ' ' . $rows[$i]['price'] . "\n";
    }
}
else{
for($i = 0; $i < count($masters); $i++) {
    if ($masters[$i]['id'] == $number) $existedNumber = True;
}

if ($existedNumber == True){
    $request ="SELECT master.id, master.surname, master.name, master.patronymic, box.date, box.start_time, box.end_time, services.title st, car_category.title cct, services.price FROM ((((master JOIN work ON master.id = work.master_id) JOIN services ON work.services_id = services.id) JOIN box ON master.box_id = box.id) JOIN car_category ON services.car_category_id = car_category.id) WHERE master.id = {$number} ORDER BY master.surname, box.date, box.start_time";
    $statement = $pdo->query($request);
    $rows = $statement->fetchAll();

    if (count($rows) == True) {
	   for($i = 0; $i < count($rows); $i++) {
            echo $rows[$i]['id'] . ' ' . $rows[$i]['surname'] . ' ' . $rows[$i]['name'] . ' ' . $rows[$i]['patronymic']  . ' ' . $rows[$i]['date'] . ' ' . $rows[$i]['start_time'] . ' ' . $rows[$i]['end_time'] . ' ' . $rows[$i]['st'] . ' ' . $rows[$i]['cct'] . ' ' . $rows[$i]['price'] . "\n";
        }
    } else {
        echo 'Данный мастер не оказал ни одной услуги.';
    }

}
else echo "Такого номера мастера не существует.";
}
?>