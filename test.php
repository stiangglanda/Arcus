<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Test</title>
    <link rel="stylesheet" href="./test.css">
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
    $user = new User();
    $event = new PEvent();
    $parcour = new Parcour();
    $score = new Score();

    echo "<hr>Objects can exists without necessarily existing in the database.<br><br>";
    $jan = new User($utils::nextId("user"), "Jan", "Hofmann", "jan", "1234", 1);
    $tim = $user->getUserByNickName("ThisTim");

    echo $tim ? "Tim Object exists<br>" : "Tim Object does not exist<br>";
    echo $jan ? "Jan Object exists<br><br>" : "Jan Object does not exist<br><br>";
    echo $tim->exists() ? "Tim exists in the db.<br>" : "Tim does not exist in the db.<br>";
    echo $jan->exists() ? "Jan exists in the db.<br>" : " Jan does not exist in the db.<br>";

    echo "<br><hr>If an object only has null values then only static methods can be used.<br><br>";
    listUsers($user::getUsers());
    echo '<br>Insert new user with \'$user->insert();\' (only actually inserts if possible without errors)<br>';

    function listUsers($users)
    {
    ?>
        <table>
            <thead>
                <tr>
                    <th>userId</th>
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>nickName</th>
                    <th>password</th>
                    <th>guest</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $userObj) {
                ?>
                    <tr>
                        <td><?= $userObj->userId ?></td>
                        <td><?= $userObj->firstName ?></td>
                        <td><?= $userObj->lastName ?></td>
                        <td><?= $userObj->nickName ?></td>
                        <td><?= $userObj->password ?></td>
                        <td><?= $userObj->guest ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }

    echo "<br><hr>Utils class for small utlities that don't fit another class.<br><br>";
    echo "Next userId: " . $utils::nextId("user") . "<br>";
    ?>
</body>

</html>