<?php
session_start();
session_destroy();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require 'database.php';
$database = connect();
if (!isset($session_id))
    $session_id = '';

if (isset($_GET['session_id'])){
    $session_id = $_GET['session_id'];
}



$unit = $database->prepare("select type from sessions where id='$session_id'");
$unit->execute();
$row = $unit->fetch();

if (($session_id) == ''){
    echo '
    <h2>Сессия не найдена</h2>
    ';
} else if ($row['type'] == '0'){
    echo'
    <h2>Сессия закрыта</h2>
    ';
} else{
    $unit = $database->prepare("select * from session where session_id='$session_id'");
    $unit->execute();
    $order = 1;
    echo '<form action="">';
    while ($row = $unit->fetch()) {
        echo '
        <h3>Вопрос №' . $order . '</h3>
        <span>
        Вопрос: ' . $row['answer'] . '
        </span> 
        <br>
        ';
        switch($row['session_int']){
            case 1:
                echo '
            <input required type="number" placeholder="Ответ" name="answer-"'. $order .'>
        ';
                break;
            case 2:
                echo '
            <input required type="number" min="0" placeholder="Ответ" name="answer-"'. $order .'>
        ';break;
            case 3:
                echo '
            <input required type="text" maxlength="30" placeholder="Ответ" name="answer-"'. $order .'>
        ';break;
            case 4:
                echo '
            <input required type="text" maxlength="255" placeholder="Ответ" name="answer-"'. $order .'>
        ';
                break;
            case 5:
                echo '
            <input required type="text" maxlength="255" placeholder="Ответ" name="answer-"'. $order .'>
        ';
                break;
            case 6:
                echo '
            <input required type="text" maxlength="255" placeholder="Ответ" name="answer-"'. $order .'>

        ';
                break;
        }
        $order = $order +1;
    }
    echo '
            <br><br><br>
            <input type="submit" value="отправить">
            </form>';
}
?>
</body>
</html>
