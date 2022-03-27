<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Test</title>
</head>

<body>
    <?php

    require_once "./classes/db.php";
    require_once "./classes/animal.php";
    require_once "./classes/pevent.php";
    require_once "./classes/parcour.php";
    require_once "./classes/score.php";
    require_once "./classes/user.php";
    require_once "./classes/utils.php";

    $db = new Database();
    $utils = new Utils();


    $animal = new Animal();
    $event = new PEvent();
    $parcour = new Parcour();
    $score = new Score();

    // todo: define id? or let auto_increment auto select it but lose access to id
    $user = new User($db::nextId("user"), "Lena", "Wurmsdobler", "Leni", "1234", 0);

    try {
        $user->insert();
    } catch (PDOException $e) {
        echo $utils->getPdoErr($e) . "<hr>";
    }

    echo "<hr>";
    listUsers($user->getUsers());
    echo "<hr>";

    function listUsers($users)
    {
        foreach ($users as $userrow) {
            echo $userrow['userId'] . " " . $userrow['firstName'] . " " . $userrow['lastName'] . " " . $userrow['nickName'] . " " . $userrow['password'] . " " . $userrow['guest'] . "<br>";
        }
    }
    ?>
</body>

</html>