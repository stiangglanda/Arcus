
<?php
session_start();
if(isset($_POST['save']))
{
    try {
        $Username=$_POST['yourUsername'];
        $Password=$_POST['yourPassword'];
        //$db = new Database();
        $exists= User::getUserByNickNamePassword($Username, $Password);

        if(!is_null($exists))
        {
            $_SESSION['loggedin_user'] = $exists;
            header('Location: ../html/dashboard.php');
        }
        else
        {
            header('Location: ../index.php');
        }        
    }catch (Exception $e)
    {
        echo $e->getCode().': '.$e->getMessage().'<br>';
    }

}else{
    ?>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/arrows.png" alt="">
                                    <span class="d-none d-lg-block">Arcus</span>
                                </a>
                            </div><!-- End Logo -->
                            <form method="post">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>
                                    <form class="row g-3 needs-validation" action="./forms/login.php" method="post" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="yourUsername" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="yourPassword" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" name="save" type="submit">Login</button>
                                            <a href="?page=dashboard">Dashboard</a>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="?page=Register">Create an account</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
}
?>
<script>
        window.onload = function(){
            var button = document.getElementById('clickButton');
            button.form.submit();
        }
        </script>