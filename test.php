<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Test</title>
</head>

<body>
    <?php

    require_once "./database/db.php";
    require_once "./database/animal.php";
    require_once "./database/pevent.php";
    require_once "./database/parcour.php";
    require_once "./database/score.php";
    require_once "./database/user.php";

    $db = new Database();
    $animal = new Animal();
    $event = new PEvent();
    $parcour = new Parcour();
    $score = new Score();
    

    // todo: define id? or let auto_increment auto select it but lose access to id
    $user = new User($db::nextId("user"), "Leon", "Oberndorfer", "ENLuoi", "1234", 0);
    
    $user->insert();

    if ($user->exists()) {
        echo "yes";
    }
    else {
        echo "no";
    }

    $users = $user->getUsers();
    foreach ($users as $userrow) {
        echo $userrow['userId'] . " " . $userrow['firstName'] . " " . $userrow['lastName'] . " " . $userrow['nickName'] . " " . $userrow['password'] . " " . $userrow['guest'] . "<br>";
    }

    ?>
</body>

</html>