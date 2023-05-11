<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
    $admin_id = $_SESSION['adminInfo']['admin_id'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
require '../../BackOfficeLayout.php';
?>
<!--Author : Ong Wi Lin-->
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<section style="background-color: #eee;">
  <div class="container py-5">

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
         <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Profile Picture</div>
          <div class="card-body text-center">
            <!--<img src="https://ca-times.brightspotcdn.com/dims4/default/ee920fb/2147483647/strip/true/crop/2836x2000+0+0/resize/1200x846!/format/webp/quality/80/?url=https%3A%2F%2Fcalifornia-times-brightspot.s3.amazonaws.com%2Fdc%2F61%2Fc19d543f43a8b6634e43ae19d377%2Ffilm-superman-11403.jpg" alt="avatar"-->
            <img src="https://assets-prod.sumo.prod.webservices.mozgcp.net/static/default-FFA-avatar.2f8c2a0592bda1c5.png" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3" id="name">Name</h5>
            <!--<p class="text-muted mb-1" id="username"></p>-->
            <p class="text-muted mb-4" id="role2"></p>
            <div class="d-flex justify-content-center mb-2">
              <!--<button type="button" class="btn btn-primary" id="edit-btn">Edit</button>-->
              <!--<button type="button" class="btn btn-primary" id="edit-btn" onclick="window.location.href = '../AdminUpdate.php';">Edit</button>-->
                <!--<button type="button" class="btn btn-primary" id="edit-btn" onclick="window.location.href = '../AdminUpdate.php?admin_id=' + admin_id;">Edit</button>-->
                <button type="button" class="btn btn-primary" id="edit-btn" onclick="window.location.href = './AdminUpdate.php?admin_id=' + getAdminId();">Edit</button>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Account Details</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="name2"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="username2"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="mail"></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="phone"></p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="role"></p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Status</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="status"></p>
              </div>
            </div>
            <hr>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
require '../../Footer.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="../../../Script/BackOffice/Admin/AdminProfile.js" type="text/javascript"></script>

<script>
function getAdminId() {
  // get the URL parameters
  const searchParams = new URLSearchParams(window.location.search);
  // get the value of the 'admin_id' parameter
//  const adminId = searchParams.get('admin_id');
  const adminId = <?php echo $admin_id; ?>;
  // return the adminId value
  return adminId;
}
</script>