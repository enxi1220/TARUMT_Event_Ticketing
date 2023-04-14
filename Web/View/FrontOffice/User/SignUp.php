<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

    </head>
    <body style="background-color: hsl(0, 0%, 96%)">

        <section class="mt-3">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col col-xl-11">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0 d-flex justify-content-center align-items-center">
                                <div class="col-md-6 col-lg-5 d-none d-md-block p-5 border-end">


                                    <h1 class="my-5 display-3 fw-bold ls-tight">
                                        Book Event<br />
                                        <span class="text-primary">with us</span>
                                    </h1>
                                    <p class="small text-muted">
                                        We offer a seamless booking experience that allows you to create unforgettable memories. 

                                    </p>
                                    <p class="small text-muted">
                                        Discover and book your dream events with us today!
                                    </p>


                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <div class="text-center">
                                            <img src="https://static.vecteezy.com/system/resources/previews/003/689/231/original/online-registration-or-sign-up-login-for-account-on-smartphone-app-user-interface-with-secure-password-mobile-application-for-ui-web-banner-access-cartoon-people-illustration-vector.jpg"
                                                 alt="login form" class="img-fluid w-50 h-50" style="border-radius: 1rem 0 0 1rem;" />
                                        </div>
                                        <form id="sign-up-form" method="POST">

                                            <div class="row">

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <input type="text" id="username" class="form-control" required />
                                                        <label class="form-label" for="username">Username</label>
                                                        <div class="invalid-feedback">Please enter a username.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-outline">
                                                        <input type="text" id="name" class="form-control" required />
                                                        <label class="form-label" for="name">Name</label>
                                                        <div class="invalid-feedback">Please enter your name.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-outline">
                                                        <input type="email" id="email" class="form-control" required />
                                                        <label class="form-label" for="email">Email</label>
                                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-outline">
                                                        <input type="tel" id="phone" class="form-control" required />
                                                        <label class="form-label" for="phone">Phone</label>
                                                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="password" class="form-control" required />
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="invalid-feedback">Please enter a password.</div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="confirmPass" class="form-control" required />
                                                        <label class="form-label" for="confirmPass">Confirm Password</label>
                                                        <div class="invalid-feedback">Please confirm your password.</div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit">Sign Up</button>
                                            </div>

                                            <p class="pb-lg-2 text-muted">Already have an account? <a href="SignIn.php" class="ms-1">Sign In here</a></p>

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
        <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/TARUMT_Event_Ticketing/Web/Script/FrontOffice/User/UserCreate.js" type="text/javascript"></script>

    </body>
</html>

