<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Автомойка</title>
</head>
<body>


<?php
$pdo = new PDO('sqlite:../data/car_wash.db');
?>

<h1><u>Новый мастер</u></h1>
<body>
<form action="" method="post" action="index.php">
    <p><label>Фамилия: <input name="surname" required></label></p>
    <p><label>Имя: <input name="name" required></label></p>
    <p><label>Отчество: <input name="patronymic"></label></p>
    <p><label>Дата рождения: </label></p>
    <input type="date" name="birthdate" required>
    <p><label>Процент от выручки: <input type="number" size="5" name="revenue_percent" required min="1" max="100" value="1" style="width: 40px;"></label></p>
    <p><button type="submit" name="submb">Добавить мастера</button></p>
</form>
</body>

<?php
if(isset($_POST['submb'], $_POST['surname'], $_POST['name'], $_POST['patronymic'], $_POST['birthdate'], $_POST['revenue_percent']))
{
    $request = $pdo->prepare("INSERT INTO 'master' ('surname', 'name', 'patronymic', 'birthdate', 'revenue_percent' ) VALUES (:surname, :name, :patronymic, :birthdate, :revenue_percent)");
    $request->bindValue(':surname', $_POST['surname']);
    $request->bindValue(':name', $_POST['name']);
    $request->bindValue(':patronymic', $_POST['patronymic']);
    $request->bindValue(':birthdate', $_POST['birthdate']);
    $request->bindValue(':revenue_percent', $_POST['revenue_percent']);
    $request->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>
-------------------------------------------------
<?php

$request = "SELECT master.id, master.surname, master.name, master.patronymic FROM master";
$statement = $pdo->query($request);
$rows_master = $statement->fetchAll();
?>
<h1><u>Добавить информацию о графике мастеров</u></h1>
<form method="post" action="index.php">
    <p>Выберите мастера:
        <select name="id">
            <?php foreach ($rows_master as $row) { ?>
                <option value= <?= $row['id']?>>
                    <?=$row['surname'] . '  ' . $row['name']. '  ' . $row['patronymic'] ?>
                </option>
                <?php
            }
            $statement->closeCursor();
            ?>
        </select>
    </p>
<p><label>День недели: </label>
<select name="day_title" input type="text">
    <option>Понедельник</option>
    <option>Вторник</option>
    <option>Среда</option>
    <option>Четверг</option>
    <option>Пятница</option>
    <option>Суббота</option>
    <option>Воскресенье</option>
</select></p>
<p><label>Время начала работы: <input type=time step="1" name="start_time"></label></p>
<p><label>Время окончания работы: <input type=time step="1" name="end_time"></label></p>
<p><button type="submit" name="subm">Сохранить</button></p>
</form>
<?php
if(isset($_POST['subm'], $_POST['id'], $_POST['day_title'], $_POST['start_time'], $_POST['end_time']))
{
    $request = $pdo->prepare("INSERT INTO 'schedule' ('master_id', 'day_title', 'start_time', 'end_time' ) VALUES (:master_id, :day_title, :start_time, :end_time)");
    $request->bindValue(':master_id', $_POST['id']);
    $request->bindValue(':day_title', $_POST['day_title']);
    $request->bindValue(':start_time', $_POST['start_time']);
    $request->bindValue(':end_time', $_POST['end_time']);
    $request->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);////////

}
?>
-----------------------------------------------------------------
<h1><u>Предварительная запись</u></h1>
<?php
$request = "SELECT services.id as si, services.title as st, duration as d, price as p, car_category.title as cct FROM services JOIN car_category ON services.car_category_id = car_category.id ORDER BY services.id";
$statement = $pdo->query($request);
$rows_services = $statement->fetchAll();
?>
<form method="post" action="index.php">
    <p>Услуга:
        <select name="service" value="<?= isset($_POST['service']) ? $_POST['service'] : "" ?>">
            <?php foreach ($rows_services as $row) { ?>
                <option value= <?= $row['si']?>>
                    <?=$row['st'] . " (". $row['cct'] . ")"?>
                </option>
                <?php
            }
            $statement->closeCursor();
            ?>
        </select>
    </p>
<label>День недели: </label>
<select name="day" input type="text" value="<?= isset($_POST['day']) ? $_POST['day'] : "" ?>">
    <option>Понедельник</option>
    <option>Вторник</option>
    <option>Среда</option>
    <option>Четверг</option>
    <option>Пятница</option>
    <option>Суббота</option>
    <option>Воскресенье</option>
</select></p>

<!--    <p><label>Время: <input type=time step="1" name="TimeRecord" value="12:00:00"></label></p>-->
<!--    <p><button type="submit" name="submit1">Найти свободные боксы</button></p>-->
<!--    --><?php
//    $TimeRecord=null?"12:00:00":$_POST['TimeRecord'];
//    ?>
    <p><label>Время: <input type=time step="1" name="TimeRecord" value="<?= isset($_POST['TimeRecord']) ? $_POST['TimeRecord'] : "" ?>"></label></p>
<!--    --><?php
//    $TimeRecord=$_POST['TimeRecord'];
//    ?>
<p><button type="submit" name="submit1">Найти свободные боксы</button></p>


<?php
if(isset($_POST['submit1'], $_POST['TimeRecord'], $_POST['day']))
{
    $TimeRecord=$_POST['TimeRecord'];
    $day=$_POST['day'];
    $query = "select id, day, start_time, end_time from box where (day!='{$day}' or (day='{$day}' and (start_time>'{$TimeRecord}' or end_time<'{$TimeRecord}')))";
    $statement = $pdo->query($query);
    $sth = $statement->fetchAll();
    print_r("Выберите услугу и день недели повторно");
}
?>
    <p>Свободные боксы: </p>
    <p><select name="boxid">
            <?php foreach ($sth as $row) { ?>
                <option value= <?= $row['id']?>>
                    <?=$row['id']?>
                </option>
                <?php
            }
            $statement->closeCursor();
            ?>
        </select>
    </p>
    <p><button type="submit" name="submit2">Назначить мастера</button></p>
    <?php
    if(isset($_POST['submit2'], $_POST['boxid'], $_POST['TimeRecord'], $_POST['day'], $_POST['service']))
    {
        $boxid=$_POST['boxid'];
        $TimeRecord=$_POST['TimeRecord'];
        $day=$_POST['day'];
        $query1 = "select master.id, master.surname, master.name, master.patronymic from (master join schedule on master.id=schedule.master_id) where (day_title='{$day}' and schedule.start_time<'{$TimeRecord}' and schedule.end_time>'{$TimeRecord}') ORDER BY RANDOM() LIMIT 1";
        $statement1 = $pdo->query($query1);
        $sth1 = $statement1->fetchAll();
        //print_r($tmp1[0]['id']);
        $request = $pdo->prepare("INSERT INTO 'work' ('master_id', 'services_id', 'box_id') VALUES (:master_id, :services_id, :box_id)");//Ноль.
        $request->bindValue(':master_id', $sth1[0]['id']);
        $request->bindValue(':services_id', $_POST['service']);
        $request->bindValue(':box_id', $_POST['boxid']);
        $request->execute();
        //print_r("Назначен мастер с номером {$sth1[0]['id']}");
        print_r("Мастер назначен. Это {$sth1[0]['surname']} {$sth1[0]['name']} {$sth1[0]['patronymic']}.");

    }
    ?>
</form>

</body>
</html>
