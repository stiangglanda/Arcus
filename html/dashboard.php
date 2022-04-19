<?php
session_start();
require_once "../classes/utils.php";
require_once "../classes/parcour.php";
require_once "../classes/user.php";

// TODO: get current players and save to array
// TODO: try if the array works after addPlayer is finished

// if current players are not set, set them
if(!isset($_SESSION['players']) || empty($_SESSION['players']))
{
    $_SESSION['players'] = array($_SESSION['loggedUser']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Arcus</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="../assets/img/arrows.png" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard.php" class="logo d-flex align-items-center">
                <img src="../assets/img/arrows.png" alt="">
                <span class="d-none d-lg-block">Arcus</span>
            </a>
        </div>
        <!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <i class="bi-list toggle-sidebar-btn"></i>
                    </a>
                    <!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="user-select: none">
                        <li class="dropdown-header">
                            <php? session_start(); ?>
                                <h6><?= $_SESSION['loggedUser']['firstName'] ?>
                                    <?= $_SESSION['loggedUser']['lastName'] ?></h6>
                                <span><?= $_SESSION['loggedUser']['nickName'] ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="settings.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="./signout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Dashboard</h5>
                            <!-- General Form Elements -->
                            <form action="./dashboard.php" method="post">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Parcour</label>
                                    <div class="col-9">
                                        <select name="currparcour" class="form-select" aria-label="Default select example" required>
                                            <option selected hidden disabled value="">Open this select menu</option>
                                            <!-- get parcours from db -->
                                            <?php
                                            $parcours = Parcour::getAll();
                                            foreach ($parcours as $curr_parcour) {
                                                echo '<option value="' . $curr_parcour->parcourId . '">' . $curr_parcour->name . " ($curr_parcour->place / $curr_parcour->animalCount animals)" . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <a href="./addParcour.php" class="btn btn btn-success" role="button">Add</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= count($_SESSION['players']) . "/10 Players" ?></h5>
                                        <!-- List group with badges -->
                                        <ul class="list-group">
                                            <?php
                                            foreach ($_SESSION['players'] as $curr_player)
                                            {
                                                if(array_search($_SESSION['loggedUser']['nickName'], $curr_player))
                                                {
                                            ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= $curr_player['nickName'] ?>
                                                </li>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center" onclick="remove(this)" id="remove">
                                                    <?= $curr_player['nickName'] ?>
                                                    <span><button type="button" class="btn btn-danger rounded-pill">Remove</button></span>
                                                </li>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </ul>
                                        <!-- End List with badges -->

                                        <div class="d-grid gap-2 mt-3">
                                            <a href="./addPlayer.php" type="button" class="btn btn btn-success">Add Player</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Counting System</label>
                                    <div>
                                        <select name="countSys" class="form-select" aria-label="Default select example" required>
                                            <option selected hidden disabled value="">Open this select menu</option>
                                            <option value="2">Two Arrows</option>
                                            <option value="3">Three Arrows</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-primary" type="submit" name="submit">Start</button>
                                </div>
                            </form><!-- End General Form Elements -->
                            <?php
                            if (isset($_POST['submit']))
                            {
                                $parcour = $_POST['currparcour'];
                                $_SESSION['countSys'] = $_POST['countSys'];
                                $eventId = Utils::nextId("event");

                                try
                                {
                                    Utils::executeAnything("insert into event(eventId, countingMode) values(?,?)", [$eventId, $_SESSION['countSys']]);
                                    Utils::executeAnything("insert into event_has_parcour(eventId, parcourId) values(?,?)", [$eventId, $parcour]);

                                    foreach ($players as $player)
                                    {
                                        Utils::executeAnything("INSERT INTO event_has_user(eventId, userId) VALUES(?,?)", [$eventId, $player->playerId]);
                                    }

                                    echo '<script>window.location.href = "./game.php";</script>';
                                } 
                                catch (PDOException $e)
                                {
                                    echo $e->getMessage();
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
</body>

</html>