<?php
function passCheck($password)
{
    $database = connect();

    $unit = $database->prepare("select password,  from admin where password = '$password'");
    $unit->execute();
    $row = $unit->fetch();
    if ($password <> '') {
        if (isset($row['password']))
            if (($password === $row['password'])) {
                header("Location: admin.php", true, 301);
                exit();
            } else return null;
    } else return null;
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXAM 3SEM SAMSONOV</title>
</head>
<body>
<?php
require 'database.php';

$database = connect();

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_POST['password']))
    $_POST['password'] = '';

echo '<form action="' . passCheck($_POST['password']) . '" method="post">
    <h1>Вход</h1>
    <label for="password">Пароль: </label>
    <input type="text" name="password" id="password" required placeholder="Введите пароль">
    <input type="submit" value="Войти">
</form>'
?>
</body>
</html>