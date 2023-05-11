<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
    $admin_id = $_SESSION['adminInfo']['admin_id'];
    $role = $_SESSION['adminInfo']['role'];    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
require '../../BackOfficeLayout.php';

//else{
//    header('Location: /TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminLogin.php');
//    exit;
//}
?>
<!--
author : ONG WI LIN
-->


<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Add Admin / Staff</h2>
        </div>
    </div>
    <form id="form-add-admin" class="needs-validation" novalidate  method="POST">
        <!-- Admin Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-name">Name*</label>
                    <input type="text" name="Name" id="txt-name" maxlength="50" class="form-control" required />
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-phone">Phone Number*</label>
                <input type="phone" name="Phone" id="txt-phone" class="form-control" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" required />
                <div class="invalid-feedback">Required a valid phone number</div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-mail">Email*</label>
                    <input type="mail" name="Email" id="txt-mail" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,10}$" class="form-control" required />
                    <div class="invalid-feedback">Required a valid email</div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="drop-down-role">Role*</label>
                <select class="form-outline form-control" id="drop-down-role" name="Role" required>
                    <option disable selected hidden></option>
                    <!-- todo: rm cat hardcode -->
                    <option value="1">Staff</option>
                    <option value="2">Admin</option>
                </select>
                <div class="invalid-feedback">Required</div>
            </div>
        </div>
<!--        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="profile-pic">Profile Picture</label>
                    <input type="file" id="profile-pic" name="ProfilePicture" class="form-control" pattern="^$" />
                    <div class="invalid-feedback">Only allow jpg, jpeg, png, gif file types</div>
                </div>
            </div>
        </div>-->
        <!-- Save -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="AdminSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <button type="submit" id="btn-add-admin" class="btn btn-primary btn-floating ms-4" title="Save">
                <i class="fas fa-floppy-disk"></i>
            </button>
        </div>
    </form>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Admin/AdminCreate.js"></script>