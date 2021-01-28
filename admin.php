<?php
    function ChangeSession($session_id, $type){
        $database = connect();

        if($type <> ''){
            if ($type == 'false'){
                $unit = $database->prepare("update `sessions` set `type`= false where `id`='$session_id'");
                $unit->execute();
                header("Location: admin.php", true, 301);
                exit();
            } else{
                $unit = $database->prepare("update `sessions` set `type`= true where `id`='$session_id'");
                $unit->execute();
                header("Location: admin.php", true, 301);
                exit();
            }
        }
    }

    function EditSession($session_id){
        $string = "Location: session-admin.php?_ijt=4ntf88992aa2ii5ohlrhososqg&session_id=" . $session_id;
        header($string, true, 301);
    }

    function DeleteSession($session_id){
        $database = connect();
        $unit = $database->prepare("delete from `sessions` where `id`='$session_id'");
        $unit->execute();
        header("Location: admin.php", true, 301);
        exit();
    }

    function CreateSession($session_id){
        $database = connect();

        $unit = $database->prepare("insert into sessions(id, type) values ('$session_id', false)");
        $unit->execute();
        header("Location: admin.php", true, 301);
        exit();

    }

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EXAM 3SEM SAMSONOV Админ панель</title>
</head>
<body>
    <?php
        require 'database.php';
        $database = connect();

        if ((isset($_GET['session_id']) && (isset($_GET['change']))))
            if ($_GET['change'] == 'false')
            ChangeSession($_GET['session_id'], 'false');

        if ((isset($_GET['session_id']) && (isset($_GET['change']))))
            if ($_GET['change'] == 'true')
                ChangeSession($_GET['session_id'], 'true');

        if ((isset($_GET['session_id']) && (isset($_GET['delete']))))
            if ($_GET['delete'] == 'true')
                DeleteSession($_GET['session_id']);

        if ((isset($_GET['session_id']) && (isset($_GET['edit']))))
            if ($_GET['edit'] == 'true')
                EditSession($_GET['session_id']);

        if ((isset($_GET['session_id']) && (isset($_GET['create']))))
            if ($_GET['create'] == 'true')
                CreateSession($_GET['session_id']);


    $unit = $database->prepare("select `id`, `type` from sessions");
        $unit->execute();
        $next_id = 1;
        while ($row = $unit->fetch()) {
            echo
                '
                <h2>Сессия номер  '. $row["id"] .'</h2>
                <div class="ul ul-'. $row["id"] .'">
                    <div class="li">';
            if ($row["type"] == '0'){
                echo '
                    <span>Статус: Запись закрыта</span>
                    </div>
                    <div class="li">
                         <a href="admin.php?session_id='. $row["id"] . '&change=true">Закрыть запись</a>
                    </div>
                ';
            } else{
                echo '
                    <span>Статус: Запись открыта</span>
                    </div>
                    <div class="li">
                         <a href="admin.php?session_id='. $row["id"] . '&change=false">Открыть запись</a>
                    </div>
                ';
            }
                echo'
                    <div class="li">
                         <a href="admin.php?session_id='. $row["id"] . '&edit=true">Редактировать запись</a>
                    </div>
                    <div class="li">
                         <a href="admin.php?session_id='. $row["id"] . '&delete=true">Удалить запись</a>
                    </div>
                    
                </div>
                ';
            $next_id = $row["id"];
        }
        echo '
        <br>
        <a href="admin.php?session_id=' . ($next_id + 1) . '&create=true"><h3>Добавить сессию</h3></a>';
    ?>
</body>
</html>
