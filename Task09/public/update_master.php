<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Изменение данных</title>
</head>
<body>

<h1 align="center"><B><U>Изменение персональных данных мастера</U></B></h1>
<?php
$pdo = new PDO('sqlite:../data/car_wash.db');
$master_id = @$_GET['master_id'];
$request = "SELECT surname, name, patronymic, birthdate, revenue_percent FROM master WHERE master.id='$master_id'";
$statement = $pdo->query($request);
$rows = $statement->fetchAll();
$statement->closeCursor();

?>

    <body>
    <form action="" method="post" action="index.php">
        <p><label>Фамилия: <input name="surname" required value=<?= @$rows[0][0] ?>></label></p>
        <p><label>Имя: <input name="name" required value=<?= @$rows[0][1] ?>></label></p>
        <p><label>Отчество: <input name="patronymic" value=<?= @$rows[0][2] ?>></label></p>
        <p><label>Дата рождения: </label></p>
        <input type="date" name="birthdate" required value=<?= @$rows[0][3] ?>>
        <p><label>Процент от выручки: <input type="number" size="5" name="revenue_percent" required min="1" max="100" value=<?= @$rows[0][4] ?>></label></p>
        <p><button type="submit" name="submb"><B>Сохранить изменения</B></button></p>
    </form>
    </body>


<?php
if(isset($_POST['submb'], $_POST['surname'], $_POST['name'], $_POST['patronymic'], $_POST['birthdate'], $_POST['revenue_percent']))
{
    $request = $pdo->prepare("UPDATE 'master' SET surname=:surname, name=:name, patronymic=:patronymic, birthdate=:birthdate, revenue_percent=:revenue_percent WHERE id = $master_id");
    $request->bindValue(':surname', $_POST['surname']);
    $request->bindValue(':name', $_POST['name']);
    $request->bindValue(':patronymic', $_POST['patronymic']);
    $request->bindValue(':birthdate', $_POST['birthdate']);
    $request->bindValue(':revenue_percent', $_POST['revenue_percent']);
    $request->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>


<form method="post" action="index.php">
        <button><B><U>На главную</U></B></button>
</form>