<section style="background-color: #eee;">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
require '../../BackOfficeLayout.php';
?>

    <div class="container-xl px-4 mt-4">

    <div class="row">
<!--        <div class="col-xl-4">
             Profile picture card
            <div class="card mb-4 mb-xl-0">
                <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Profile Picture</div>
                <div class="card-body text-center">
                     Profile picture image
                                <img src="https://assets-prod.sumo.prod.webservices.mozgcp.net/static/default-FFA-avatar.2f8c2a0592bda1c5.png" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
    </div>
            </div>
        </div>-->
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header" style="background-color: rgba(33, 40, 50, 0.03)">Update Account Details</div>
                <div class="card-body">
                    <form id="form-edit-admin" class="needs-validation" novalidate method="POST">
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="name">Full name</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter your full name" value="" required >
                                <div class="invalid-feedback">Required</div>

                            </div>
                            <!-- Form Group (username)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="username">Username</label>
                                <input class="form-control" id="username" type="text" placeholder="Enter your username" value=""  required >
                                <div class="invalid-feedback">Required</div>
                            </div>
                        </div>
                       
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="mail">Email address</label>
                            <input class="form-control" id="mail" type="email" placeholder="Enter your email address" value=""  required >
                            <div class="invalid-feedback">Required</div>

                        </div>
                        <!-- Form Group (phone)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="phone">Phone</label>
                            <input class="form-control" id="phone" type="tel" placeholder="Enter your phone" value=""  required >
                            <div class="invalid-feedback">Required</div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="role">Role</label>
                                <select name="role" class="form-control" id="roleDdl">
<!--                                    <option value="Staff">Staff</option>
                                    <option value="Admin">Admin</option>-->
                                  </select>
                            </div>
                            <!-- Form Group (status)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="status">Status</label>
                                <!--<input class="form-control" id="status" type="text" name="status" placeholder="Enter your status" value="Activate">-->
                                <select name="status" class="form-control"  id="statusDdl" >
<!--                                    <option value="Activate">Activate</option>
                                    <option value="Deactivate">Deactivate</option>-->
                                  </select>
                            </div>
                        </div>
                        <!-- Save changes button-->
<!--                        <button class="btn btn-primary" type="button">Save changes</button>-->
                        <button type="submit" class="btn btn-primary" title="Save">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
</section>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Admin/AdminUpdate.js" type="text/javascript"></script>
<script src="../../../Script/BackOffice/Admin/AdminRead.js" type="text/javascript"></script>
