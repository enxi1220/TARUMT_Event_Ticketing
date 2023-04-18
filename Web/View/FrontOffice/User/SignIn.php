<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>

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

                                        <form id="sign-in-form" method="POST" class="needs-validation" novalidate>
                                            <h1 class="mb-3 pb-3">Sign In</h1>


                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-outline">
                                                        <input type="email" id="signInMail" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="email">Email address</label>
                                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12  mb-4">
                                                    <div class="form-outline">
                                                        <input type="password" id="signInPwd" class="form-control form-control-lg" required />
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="invalid-feedback">Please enter your password.</div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                            </div>

                                            <a class="text-muted" href="ResetPassword.php">Forgot password?</a>

                                            <p class="my-5 pb-lg-2 text-muted">Don't have an account? <a href="SignUp.php" class="ms-1">Sign up here</a></p>
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
        <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/TARUMT_Event_Ticketing/Web/Script/FrontOffice/User/UserRead.js" type="text/javascript"></script>

    </body>
</html>

