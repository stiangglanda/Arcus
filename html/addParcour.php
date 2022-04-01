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
        <a href="dashboard.php" class="logo d-flex align-items-center">
          <img src="../assets/img/arrows.png" alt="">
          <span class="d-none d-lg-block">Arcus</span>
        </a>
      </div><!-- End Logo -->
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <i class="bi-list toggle-sidebar-btn"></i>
            </a><!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
              <!-- todo: get logged in user   -->
              <h6>Leander Kieweg</h6>
                <span>stiangglanda</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="Settings.php">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="../index.php">
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
                <h5 class="card-title">Add Parcour</h5>
                
                <!-- General Form Elements -->
                <form action="das">
                  <div class="col-12">
                    <label for="FirstName" class="form-label">Parcour Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                    <div class="invalid-feedback">Please, enter a valid name!</div>
                  </div>
                  <div class="col-12">
                    <label for="SecondName" class="form-label">Place</label>
                    <input type="text" name="name" class="form-control" id="place" required>
                    <div class="invalid-feedback">Please, enter a valid place!</div>
                  </div>
                  <div class="col-12">
                    <label for="SecondName" class="form-label">3D Animal Count</label>
                    <input type="number" name="name" class="form-control" id="animalCount" required>
                    <div class="invalid-feedback">Please, enter a valid number!</div>
                  </div>
                  <div class="container-fluid mt-3">
                    <div class="row">
                      <div class="col-sm-6 p-3 text-white">
                        <div class="d-grid gap-2 mt-3">
                          <button class="btn btn-primary" type="submit" name="submit">Save</button>
                        </div>
                      </div>
                      <div class="col-sm-6 p-3 text-white">
                        <div class="d-grid gap-2 mt-3">
                          <a href="dashboard.php" class="btn btn-primary" role="button">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- End General Form Elements -->
              
                <?php
                  // insert new parcour
                  if (isset($_POST['submit'])) {

                    $name = $_POST['name'];
                    $place = $_POST['place'];
                    $animalCount = $_POST['animalCount'];

                    $new_parcour = new Parcour(Utils::nextId("parcour"), $name, $place, $animalCount);
                    if ($new_parcour->insert()) {
                      echo "<script>window.location.href = \"dashboard site\"</script>";
                    } else {
                      echo "Error inserting new parcour";
                    }
                  }
                ?>

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