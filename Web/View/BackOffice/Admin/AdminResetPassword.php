<?php
//require '../../Layout.php';
require $_SERVER['DOCUMENT_ROOT'] . '/TARUMT_Event_Ticketing/Web/StyleSheet/CSS_links.php';

?>
<!-- author: Vinnie Chin Loh Xin -->
<!-- author: Ong Wi Lin -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Set Password</title>

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

                                        <form id="admin-set-password-form" method="POST" class="needs-validation" novalidate>
                                            <h1 class="mb-3 pb-3">Set Password</h1>


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
                                                <button id="submit-button" class="btn btn-dark btn-lg btn-block" type="submit" disabled="">Submit</button>
                                            </div>

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
        <script src="../../../Script/BackOffice/Admin/AdminResetPassword.js"></script>
    </body>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    const passwordInput = document.getElementById('password-input');
    const submitButton = document.getElementById('submit-button');
    const passwordStrength = document.getElementById('password-strength');

    passwordInput.addEventListener('input', () => {
      const password = passwordInput.value;
      var strength = checkPasswordStrength(password);
      var strengthLevel = "Weak";

    if (password.length >= 8) { // check length
        strength++;
      }

      switch (strength) {
        case 0:
        case 1:
          strengthLevel = "Weak";
          submitButton.disabled = true;
          break;
        case 2:
        case 3:
        case 4:
          strengthLevel = "Moderate";
          submitButton.disabled = true;
          break;
        case 5:
          strengthLevel = "Strong";
          submitButton.disabled = false;
          break;
        default:
          strengthLevel = "Invalid password";
          submitButton.disabled = true;
          break;
      }
      passwordStrength.innerText = `Password strength: ${strengthLevel}`;
//      passwordStrength.innerText = `Password strength: ${strength}`;

    });

    function checkPasswordStrength(password) {
      const regexes = [
        /[a-z]/, // lowercase letters
        /[A-Z]/, // uppercase letters
        /[0-9]/, // digits
        /[!@#$%^&*()]/, // specific special characters
      ];

      let strength = 0;

      for (let regex of regexes) {
        if (regex.test(password)) {
          strength++;
        }
      }

      return strength;
    }
    });

</script>

</html>

