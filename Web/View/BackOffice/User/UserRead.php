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
<!-- author: Ong Yi Chween -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">View User</h2>
        </div>
    </div>
    <form>
        <!-- Event Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-username">Username</label>
                    <input type="text" name="" id="txt-username" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-name">Name</label>
                <input type="text" name="Name" id="txt-name" minlength="150" class="form-control" readonly />
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-phone">Phone</label>
                    <input type="text" name="Phone" id="txt-phone" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-mail">Mail</label>
                <input type="text" name="Mail" id="txt-mail" minlength="150" class="form-control" readonly />
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label" for="txt-status">Status</label>
                <input type="text" name="Status" id="txt-status" minlength="150" class="form-control" readonly />
            </div>
        </div>

        

        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="UserSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </form>
</div>

<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/User/UserRead.js"></script>