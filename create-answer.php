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

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["type"])){

}
echo $_POST["type"];
echo $_POST["q"];
echo $_POST["a"];

if (!isset($_POST["type"])){
    echo '
    <form action="" method="post">
        <h1>Выбирите тип вопроса</h1>
        <p><input name="type" type="radio" value="1">тип 1</p>
        <p><input name="type" type="radio" value="2">тип 2</p>
        <p><input name="type" type="radio" value="3">тип 3</p>
        <p><input name="type" type="radio" value="4">тип 4</p>
        <p><input name="type" type="radio" value="5">тип 5</p>
        <p><input name="type" type="radio" value="6">тип 6</p>
        <p><input type="submit" value="Выбрать"></p>
    </form>';
} else
switch ($_POST["type"]) {
    case 1:
        echo '
        <h2>Тип 1</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="number" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
    case 2:
        echo '
        <h2>Тип 2</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="number" min="0" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
    case 3:
        echo '
        <h2>Тип 3</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="text" maxlength="30" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
    case 4:
        echo '
        <h2>Тип 4</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="text" maxlength="255" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
    case 5:
        echo '
        <h2>Тип 1</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="number" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
    case 6:
        echo '
        <h2>Тип 1</h2>
        <form action="" method="post">
            <input required type="text" placeholder="Вопрос" name="q">
            <input required type="number" placeholder="Ответ" name="a">
            <input type="submit" value="отправить">
        </form>
        
        ';
        break;
}

?>
</body>
</html>