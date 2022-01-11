<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Удаление мастера</title>
</head>
<body>


<H1>Вы уверены?</H1>
<?php
$master_id = $_GET['master_id'];
?>

<form method="post">
    <input type="hidden" name="master_id" value=<?= $master_id ?>>
    <button name='yes' onclick="alert('Успешно удалено.')"><B>Да</B></button>
</form>


<?php
$pdo = new PDO('sqlite:../../data/car_wash.db');

$master_id = @$_GET['master_id'];
$request = "SELECT id, status FROM master WHERE id='$master_id'";
$statement = $pdo->query($request);
$rows = $statement->fetchAll();
$statement->closeCursor();
?>
<?php

if (isset($_POST['yes'])) {
    $request = "UPDATE master SET status ='off' WHERE master.id='$master_id' AND status ='on'";
    $statement = $pdo->prepare($request);
    $statement->execute();
}
?>

<H1></H1>
<H1></H1>
<form method="post" action="../index.php">
    <button><B><U>Вернуться на главную</B></U></button>
</form>

</body>
</html>
