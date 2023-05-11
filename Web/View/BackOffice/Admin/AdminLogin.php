<?php
require $_SERVER['DOCUMENT_ROOT'] . '/TARUMT_Event_Ticketing/Web/StyleSheet/CSS_links.php';
//if(isset($_SESSION['adminInfo'])) {
//    $adminName = $_SESSION['adminInfo']['name'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
//    
//}else{
//    header('Location: ../Admin/AdminLogin.php');
//    exit;
//}

?>
<!-- author: Vinnie Chin Loh Xin -->
<!-- author: Ong Wi Lin -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin / Staff Sign In </title>

    </head>
    <body>
        <section class="mt-5">
            <div class="container py-5 mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0 d-flex justify-content-center align-items-center">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="https://www.tampabaytamilacademy.org/assets/login.c6b269bc.png"
                                         alt="login form" class="img-fluid mt-5" style="border-radius: 1rem 0 0 1rem;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">

                                        <form id="admin-login-form" method="POST" class="needs-validation" novalidate>
                                            <h1 class="mb-3 pb-3">Admin / Staff Sign In </h1>


                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <input type="email" id="mail" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="email">Email</label>
                                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12  mb-4">
                                                    <div class="form-outline">
                                                        <input type="password" id="password-input" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="invalid-feedback">Please enter your password.</div>

                                                    </div>
                                                    <p id="password-strength"></p>

                                                </div>

                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button id="submit-button" class="btn btn-dark btn-lg btn-block" type="submit">Submit</button>
                                            </div>

                                            

                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color: #999999; " href="/TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminResetPassword.php">Forgot Password?</a>
                    </li>
                </ul>
                                            <!--<a class="text-muted" href="ResetPassword.php">Forgot password?</a>-->

                                            <!--<p class="my-5 pb-lg-2 text-muted">Don't have an account? <a href="SignUp.php" class="ms-1">Sign up here</a></p>-->
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <?php
        require '../../Footer.php';
        ?>
        <script src="../../../Script/BackOffice/Admin/AdminLogin.js"></script>
    </body>


</html>

