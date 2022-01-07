<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>График</title>
</head>
<body>
<h1 align="center"><B><U>График работы мастера</U></B></h1>
<p title="В уже существующие графики можно вносить изменения прямо в таблице. После их внесения не забудьте нажать на кнопку ИЗМЕНИТЬ и перезайдите на данную страницу.">Наведите сюда для подсказки</p>
<?php
$pdo = new PDO('sqlite:../../data/car_wash.db');

$master_id = $_GET['master_id'];
$query = "SELECT master_id, day_title, start_time, end_time FROM schedule WHERE master_id='$master_id'";
$statement = $pdo->query($query);
$rows = $statement->fetchAll();
$statement->closeCursor();

?>
    <table class="masters-table" cellpadding="10" cellspacing="0" width="100% "border="2">
        <tr>
            <td>День</td>
            <td>Начало рабочего дня</td>
            <td>Конец рабочего дня</td>
            <td></td>
            <td></td>
        </tr>
        <?php
        for ($i = 0; $i < count($rows); $i++) {?>
            <form method="post" action="schedule.php?master_id=<?=$master_id?>">
                <tr>
                    <td>
                        <input type="text" style="border-color:white; border-width:0;" name="day_title" readonly value=<?= $rows[$i]['day_title'] ?>>
                    </td>
                    <td>
                        <input type=time step=1 name="start_time" value=<?= $rows[$i]['start_time'] ?>>
                    </td>
                    <td>
                        <input type=time step=1 name="end_time" value=<?= $rows[$i]['end_time'] ?>>
                    </td>
                    <td>
                        <button onclick="alert('Успешно изменено. Когда вы зайдёте на данную страницу в следующий раз, информация будет обновлена')" name="change" type="submit" value="change">Изменить</button>
                    </td>
                    <td>
                        <button onclick="alert('Успешно удалено. Когда вы зайдёте на данную страницу в следующий раз, информация будет обновлена')" name="delete" type="submit" value="delete">Удалить</button>
                        <input type="hidden" name="index" value = <?=$i?>>
                    </td>
                </tr>
            </form>
        <?php } ?>

    </table>


<?php
    if (isset($_POST['change'])) {
        $update = $pdo->prepare("UPDATE schedule SET start_time = :start_time, end_time = :end_time WHERE master_id = :master_id AND day_title = :day0");
        $update->bindValue(':master_id', $master_id);
        $update->bindValue(':start_time', $_POST['start_time']);
        $update->bindValue(':end_time', $_POST['end_time']);
        $update->bindValue(':day0', $rows[$_POST['index']]['day_title']);
        $update->execute();
    }
    if (isset($_POST['delete'])) {
        $del = $pdo->prepare("DELETE FROM schedule WHERE master_id=:master_id AND day_title=:day_title");
        $del->bindValue(':master_id', $master_id);
        $del->bindValue(':day_title', $rows[$_POST['index']]['day_title']);
        $del->execute();
    }

?>
<H1></H1>
<form method="post" action="add_record.php?master_id=<?=$master_id?>">
        <button><B>Добавить</B></button>
</form>
<H1></H1>
<H1></H1>
<form method="post" action="../index.php">
        <button><B><U>На главную</U></B></button>
</form>
</body>
</html>