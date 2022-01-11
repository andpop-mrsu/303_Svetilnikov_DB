<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Новый график</title>
</head>
<body>

<H1 align="center"><U><B>Добавление информации о графике мастеров</B></U></H1>

<?php
$pdo = new PDO('sqlite:../../data/car_wash.db');
$master_id = @$_GET['master_id'];
?>

<form method="post" action="add_record.php?master_id=<?=$master_id?>">
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
    <p><button type="submit" name="subm"><B>Сохранить</B></button></p>
</form>
<?php
if(isset($_POST['subm']))
{
    $request = $pdo->prepare("INSERT INTO 'schedule' ('master_id', 'day_title', 'start_time', 'end_time' ) VALUES (:master_id, :day_title, :start_time, :end_time)");
    $request->bindValue(':master_id', $master_id);
    $request->bindValue(':day_title', $_POST['day_title']);
    $request->bindValue(':start_time', $_POST['start_time']);
    $request->bindValue(':end_time', $_POST['end_time']);
    $request->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);

}
?>


<form method="post" action="../index.php?">
    <button><B><U>На главную</U></B></button>
</form>
</body>
</html>