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
    $user = new User();

    $events = $event->getEvents();
    echo "test";

    foreach ($events as $event) {
        echo $event['userId'];
    }

    echo "test2";

    ?>
</body>

</html>