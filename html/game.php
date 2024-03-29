<?php
session_start();
require_once '../classes/hitzone.php';
require_once '../classes/utils.php';
require_once '../classes/score.php';
require_once '../classes/animal.php';
require_once '../classes/user.php';
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
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
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
            <!-- Start Logo -->
            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <img src="../assets/img/arrows.png" alt="">
                    <span class="d-none d-lg-block">Arcus</span>
                </a>
            </div>
            <!-- End Logo -->
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi-list toggle-sidebar-btn"></i>
                        </a><!-- End Profile Iamge Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="user-select: none">
                            <li class="dropdown-header">
                                    <h6><?=$_SESSION['loggedUser']['firstName']?>
                                        <?=$_SESSION['loggedUser']['lastName']?></h6>
                                    <span><?=$_SESSION['loggedUser']['nickName']?></span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center disabled" href="settings.php">
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
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>
            </nav><!-- End Icons Navigation -->
            <!-- End Icons Navigation -->
        </header>
        <!-- End Header -->
        
        <main id="main" class="main">
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Game: <?= $_SESSION['parcour']['name'] ?></h5>
                                <h5 class="card-title text-center">Animal <?= $_SESSION['players'][$_SESSION['count']%count($_SESSION['players'])]['currTarget'] . '/' . $_SESSION['parcour']['animalCount'] ?></h5>
                                <h6 class="card-title text-center"><?= User::showName($_SESSION['players'][$_SESSION['count']%count($_SESSION['players'])]['nickName']) ?></h6>
                                <!-- General Form Elements -->
                                <form method="post">
                                    <div class="col-12">
                                        <label for="Arrows" class="form-label">How many Arrows did you need until you hit?</label>
                                        <select class="form-select" aria-label="Default select example" id="shots" name="shots" required>
                                            <option selected hidden disabled value="">Open this select menu</option>
                                            <option value="1">1 Arrow</option>
                                            <option value="2">2 Arrows</option>
                                            <?php
                                                if ($_SESSION['countSys'] == "3") {
                                                    echo '<option value="3">3 Arrows</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="Points" class="form-label">Where did you hit the Animal?</label>
                                        <select class="form-select" aria-label="Default select example" id="hitzone" name="hitzone" required>
                                            <option selected hidden disabled value="">Open this select menu</option>
                                            <?php
                                                $hitzone = Hitzone::getAll();
                                                foreach ($hitzone as $curr_hitzone)
                                                {
                                                    echo '<option value="' . $curr_hitzone->hitzoneId . '">' . $curr_hitzone->hitzoneName . '</option>';
                                                }
                                            ?>
                                        </select>
                                        <script>
                                            let sel = document.getElementById('hitzone');
                                            sel.addEventListener ("change", function() {
                                                if (this.value == '4') {
                                                    document.getElementById('shots').disabled = true;
                                                } else {
                                                    document.getElementById('shots').disabled = false;
                                                }
                                            });
                                        </script>
                                        
                                    </div>
                                    <div class="container-fluid mt-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-grid gap-2 mt-3">
                                                    <button class="btn btn-primary btn-lg float-right"
                                                        type="submit" name="submit">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['submit']))
                                {
                                    try
                                    {
                                        if(isset($_POST['shots']))
                                        {
                                            $points = Utils::executeAnything('select * from points where hitzoneId = ? and arrowId = ?', [$_POST['hitzone'], $_POST['shots']])['pointsId'];
                                        }
                                        else
                                        {
                                            $points = Utils::executeAnything('select * from points where hitzoneId = ?', [$_POST['hitzone']])['pointsId'];
                                        }
                                        
                                        $score = new Score(
                                            $_SESSION['players'][$_SESSION['count']%count($_SESSION['players'])]['userId'],
                                            Animal::findShotAnimal($_SESSION['parcour']['parcourId'], $_SESSION['players'][$_SESSION['count']%count($_SESSION['players'])]['currTarget']),
                                            $points,
                                            $_SESSION['eventId']
                                        );

                                        $score->insert();

                                        $_SESSION['players'][$_SESSION['count']%count($_SESSION['players'])]['currTarget']++;
                                        $_SESSION['count']++;

                                        if($_SESSION['count']/count($_SESSION['players']) < $_SESSION['parcour']['animalCount'])
                                        {
                                            echo '<script>window.location.href = "./game.php";</script>';
                                        }
                                        else
                                        {
                                            echo '<script>window.location.href = "./statistics.php";</script>';
                                        }
                                    } 
                                    catch (PDOException $e)
                                    {
                                        echo $e->getMessage();
                                    }
                                }
                                ?>
                                <!-- End General Form Elements -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- End #main -->
        <!-- ======= Footer ======= -->
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
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
