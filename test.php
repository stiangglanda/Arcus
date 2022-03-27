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

    $jan = new User($utils::nextId("user"), "Jan", "Hofmann", "jan", "1234", 1);    // user; not in db
    $david = $user->getUserById(1);                                                 // user; in db
    $tim = $user->getUserByNickName("ThisTim");                                     // user; in db
    $leander = $user->getUserByNickName("stiangglanda");                            // user; in db
    $leon = $user->getUserByNickName("ENLoui");                                     // user; in db
    $lena = $user->getUserByNickName("Leni");                                       // user; in db
    $stephan = $user->getUserByNickName("Stifigamer");                              // user; in db
    $lukas = new User($utils::nextId("user"), "Lukas", "Natotea", "Teo", "", 1);    // user; in db

    echo "<hr>Objects can exists without necessarily existing in the database.<br><br>";
    echo $tim ? "Tim Object exists<br>" : "Tim Object does not exist<br>";
    echo $jan ? "Jan Object exists<br><br>" : "Jan Object does not exist<br><br>";
    echo $tim->exists() ? "Tim exists in the db.<br>" : "Tim does not exist in the db.<br>";
    echo $jan->exists() ? "Jan exists in the db.<br>" : " Jan does not exist in the db.<br>";

    echo "<br><hr>Insert (Lukas)<br><br>";
    $lukas->insert();
    listUsers($user::getUsers());

    echo "<br><hr>Delete (Lukas)<br><br>";
    $lukas->delete();

    // reset auto increment to before insert for testing - potentially make utils method? (would break if deleting user in middle of table!)
    $stmt = $db->pdo->prepare("ALTER TABLE user AUTO_INCREMENT = 7");
    $stmt->execute();

    listUsers($user::getUsers());


    echo "<br><hr>Utils class for small utlities that don't fit another class.<br><br>";
    echo "Next userId: " . $utils::nextId("user") . "<br>";
    echo "Next eventId: " . $utils::nextId("event") . "<br>";
    echo "Next parcourId: " . $utils::nextId("parcour") . "<br>";
    echo "Next animalId: " . $utils::nextId("animal") . "<br>";

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
    ?>
</body>

</html>