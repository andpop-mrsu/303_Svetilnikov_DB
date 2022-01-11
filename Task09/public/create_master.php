<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавление мастера</title>
</head>
<body>

<?php
$pdo = new PDO('sqlite:../data/car_wash.db');
?>

<H1><B><U>Новый мастер</U></B></H1>
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
    $request = $pdo->prepare("INSERT INTO 'master' ('surname', 'name', 'patronymic', 'birthdate', 'revenue_percent') VALUES (:surname, :name, :patronymic, :birthdate, :revenue_percent)");
    $request->bindValue(':surname', $_POST['surname']);
    $request->bindValue(':name', $_POST['name']);
    $request->bindValue(':patronymic', $_POST['patronymic']);
    $request->bindValue(':birthdate', $_POST['birthdate']);
    $request->bindValue(':revenue_percent', $_POST['revenue_percent']);
    $request->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>

<H1></H1>
<form method="post" action="index.php">
    <button><U><B>На главную</B></U></button>

</form>
</body>
</html>
