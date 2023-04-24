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
              <img src="https://img.freepik.com/free-vector/access-control-system-abstract-concept_335657-3180.jpg?w=826&t=st=1680959844~exp=1680960444~hmac=f1a8a16e5e9fca2d79ea6e5b3e50e8d0065841ce159fe3166b72fac31407b036"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form id="resetPwd-mail-form">
                  <h1 class="mb-3 pb-3" style="letter-spacing: 1px;">Reset Password</h1>

                  <div class="form-outline mb-4">
                    <input type="email" id="resetPwd-mail" class="form-control form-control-lg" />
                    <label class="form-label" for="resetPwd-mail">Enter email you used to register</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Get code</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
        
         <!-- -------------------------------------------------- OTP Modal -------------------------------------------------- -->
    <div class="modal fade in " id="otp-modal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h3 class="modal-title" id="otpModalLabel">OTP to reset password</h3>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3 mb-5">
                    <form id="otp-form">
                        <div class="form-outline mt-3">
                            <input type="text" id="otpNum" class="form-control border-bottom"/>
                            <label class="form-label" for="otpNum">Enter OTP received in email</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div> 
                </form>
            </div>
        </div>
    </div>

    <!-- -------------------------------------------------- Reset Password Modal -------------------------------------------------- -->
    <div class="modal fade" id="resetPwd-modal" tabindex="-1" aria-labelledby="resetPassModalLabel" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="resetPassModalLabel">Reset your password</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reset-pwd-form">
                        <div class="form-outline mt-3">
                            <input type="password" id="reset-pwd" class="form-control border-bottom" />
                            <label class="form-label" for="reset-pwd">New Password</label>
                            <div class="form-helper"></div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reset</button>
                </div>
                </form>
            </div>
        </div>
    </div>



        <?php
        require '../../Footer.php';
        ?>
        
        
        <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/TARUMT_Event_Ticketing/Web/Script/FrontOffice/User/UserUpdate.js" type="text/javascript"></script>

    </body>
</html>

