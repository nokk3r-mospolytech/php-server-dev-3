<?php
    function DeleteAnswer($answer_id){
        $database = connect();
        $unit = $database->prepare("delete from `session` where `id`='$answer_id'");
        $unit->execute();
    }
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

if (!isset($session_id))
    $session_id = '';

    if (isset($_GET['session_id']))
        $session_id = $_GET['session_id'];

if ((isset($_GET['session_id']) && (isset($_GET['delete']))))
    if ($_GET['delete'] == 'true')
        DeleteAnswer($_GET['answer_id']);

    $database = connect();
if (($session_id) == ''){
    echo '
    <h2>Сессия не найдена</h2>
    ';
} else {
    $unit = $database->prepare("select * from session where session_id='$session_id'");
    $unit->execute();
    $order = 1;

    while ($row = $unit->fetch()) {
        echo '
        <h3>Вопрос №' . $order . '</h3>
        <span>
        Тип вопроса: ' . $row['session_int'] . '
        </span>
        <br>
        <span>
        Вопрос: ' . $row['answer'] . '
        </span> 
        <br>
        <span>
        Ответ на вопрос: '. $row['result'] .'
        </span>
        <br>
        <a href="session-admin.php?session_id='. $session_id .'&answer_id='. $row['id'] .'&delete=true">Удалить ответ</a>
        ';

        $order = $order + 1;
    }
}
?>
</body>
</html>