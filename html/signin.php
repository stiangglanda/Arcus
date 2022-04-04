<?php
session_start();

require_once '../classes/user.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Sign In</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Favicons -->
        <link href="../assets/img/arrows.png" rel="icon">
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
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
        <main>
            <div class="container">
                <section
                    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                                <!-- Start Logo -->
                                <div class="d-flex justify-content-center py-4">
                                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                                        <img src="../assets/img/arrows.png" alt="">
                                        <span class="d-none d-lg-block">Arcus</span>
                                    </a>
                                </div>
                                <!-- End Logo -->
                                <form method="post" action="./signin.php">
                                    <?php
									$username = isset($_POST['yourUsername']) ? $_POST['yourUsername'] : '';
									$password = isset($_POST['yourPassword']) ? $_POST['yourPassword'] : '';
									?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="pt-4 pb-2">
                                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                                <p class="text-center small">Enter your username & password to login</p>
                                            </div>
                                            <form class="row g-3 needs-validation" method="post" novalidate>
                                                <div class="col-12">
                                                    <label for="yourUsername" class="form-label">Username</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        <input type="text" name="yourUsername" class="form-control"
                                                            id="yourUsername" value="<?= $username ?>" required>
                                                        <div class="invalid-feedback">Please enter your username.</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="yourPassword" class="form-label">Password</label>
                                                    <input type="password" name="yourPassword" class="form-control"
                                                        id="yourPassword" <?= $password ?> required>
                                                    <div class="invalid-feedback">Please enter your password!</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100" name="save"
                                                        type="submit">Login</button>
                                                </div>
                                                <div class="col-12">
                                                    <p class="small mb-0">Don't have account? <a
                                                            href="?page=Register">Create an account</a></p>
                                                </div>
                                            </form>
                                            <?php
												if (isset($_POST['save']) && $username != '' && $password != '') {
													$loggedUser = User::validUser($username, $password);

													if (!is_null($loggedUser)) {
														$_SESSION['auth'] = true;
												
														$userVars = array($loggedUser->userId, $loggedUser->firstName, $loggedUser->lastName, $loggedUser->nickName, $loggedUser->password, $loggedUser->guest);

														$_SESSION['loggedUser'] = $userVars;
														echo '<script>window.location.href = "./dashboard.php";</script>';
													}
													else {
														?>
                                            <script>
                                            alert('Invalid username or password');
                                            </script>
                                            <?php
													}
												}
											?>
                                        </div>
                                    </div>
                                    <?php
									
									?>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script>
            window.onload = function() {
                var button = document.getElementById('clickButton');
                button.form.submit();
            }
            </script>
        </main>
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