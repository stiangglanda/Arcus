<?php
  session_start();
  require_once "../classes/score.php";
  require_once "../classes/user.php";

  $i = 0;
  while ($i < count($_SESSION['players'])) {
    $_SESSION['players'][$i]['currTarget'] = 1;
    $i++;
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
            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <img src="../assets/img/arrows.png" alt="">
                    <span class="d-none d-lg-block">Arcus</span>
                </a>
            </div><!-- End Logo -->
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi-list toggle-sidebar-btn"></i>
                        </a>
                        <!-- End Profile Image Icon -->
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                            style="user-select: none">
                            <li class="dropdown-header">
                                <h6><?= $_SESSION['loggedUser']['firstName'] ?>
                                    <?= $_SESSION['loggedUser']['lastName'] ?></h6>
                                <span><?= $_SESSION['loggedUser']['nickName'] ?></span>
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
                        </ul>
                        <!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                </ul>
            </nav><!-- End Icons Navigation -->
        </header><!-- End Header -->
        <main id="main" class="main">
            <section class="section" hidden>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistics</h5>
                                <!-- Line Chart -->
                                <div id="lineChart"></div>
                                <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#lineChart"), {
                                        series: [{
                                            name: "Score",
                                            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'line',
                                            zoom: {
                                                enabled: false
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'straight'
                                        },
                                        grid: {
                                            row: {
                                                colors: ['#f3f3f3',
                                                    'transparent'
                                                ], // takes an array which will be repeated on columns
                                                opacity: 0.5
                                            },
                                        },
                                        xaxis: {
                                            categories: ['Animal 1', 'Animal 2', 'Animal 3', 'Animal 4',
                                                'Animal 5', 'Animal 6', 'Animal 7', 'Animal 8',
                                                'Animal 9'
                                            ],
                                        }
                                    }).render();
                                });
                                </script>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                    </div>
            </section>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Scoreboard</h5>
                                <!-- Default Table -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Position</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Points(Average)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $players = array();
                                        
                                        for ($i=0; $i < count($_SESSION['players']); $i++)
                                        {
                                            array_push($players, array($_SESSION['players'][$i]['nickName'], Score::getPointsFromPlayer($_SESSION['players'][$i]['userId'], $_SESSION['eventId'])));
                                        }

                                        for ($i=0; $i < count($players); $i++)
                                        { 
                                            for ($j=0; $j < count($players)-1; $j++) { 
                                                if($players[$j][1] < $players[$j+1][1])
                                                {
                                                    $help = $players[$j];
                                                    $players[$j] = $players[$j+1];
                                                    $players[$j+1] = $help;
                                                }
                                            }
                                        }

                                        $count = 1;

                                        foreach($players as $player)
                                        {
                                            echo '<tr>
                                            <th scope="row">' . $count . '</th>
                                            <td>' . User::showName($player[0]) . '</td>
                                            <td>' . $player[1] . '(' . $player[1]/$_SESSION['parcour']['animalCount'] . ')</td>
                                            </tr>';

                                            $count++;
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="./dashboard.php" class="btn btn-primary" role="button">Finish</a>
                                </div>
                                <!-- End Default Table Example -->
                            </div>
                        </div>
            </section>
        </main><!-- End #main -->
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