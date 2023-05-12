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
            <h2 class="float-start mb-5">View Category</h2>
        </div>
    </div>
    <form>
        <!--Category information -->
        <div class="row mb-4">
            <fieldset class="mb-3 border p-3">
                <legend class="w-auto">Category Information</legend>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txt-name">Category Name</label>
                                <input type="text" name="CategoryName" id="txt-name" class="form-control" readonly />
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="txt-description">Description</label>
                                <textarea type="text" id="txt-description" name="Description" maxlength="255" class="form-control" rows="3" readonly></textarea>
                                
                            </div>
                        </div>
                    </div>
            </fieldset>
        </div>
        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="CategorySummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </form>

</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Category/CategoryRead.js"></script>