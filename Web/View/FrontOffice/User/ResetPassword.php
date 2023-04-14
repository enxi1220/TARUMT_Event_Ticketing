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

                <form>
                  <h1 class="mb-3 pb-3" style="letter-spacing: 1px;">Reset Password</h1>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Enter email you used to register</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="button">Get code</button>
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


        <?php
        require '../../Footer.php';
        ?>
    </body>
</html>

