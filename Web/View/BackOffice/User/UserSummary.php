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
      <h2 class="float-start mb-5">User Summary</h2>
    </div>
    <div class="col">

      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export CSV" onclick="exportUserInCSV()">
      <i class="fas fa-file-csv fs-4"></i>
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportUserInPDF()">
    <i class="fas fa-file-pdf fs-4"></i>
  </button>
    </div>
  </div>
    
    <table id="user-summary" class="table table-striped w-100">
    <thead>
      <tr>
        <th>Username</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Mail</th>
        <th>Status</th>
        <th>Created By</th>
        <th>Created Date</th>
        <th>Updated By</th>
        <th>Updated Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<!----------------------- Modal ----------------------->
<div class="modal fade" id="modal-activate-user" tabindex="-1" aria-labelledby="txt-modal-activate-user" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="txt-modal-activate-user">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to activate the user?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-activate-user">Sure</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-deactivate-user" tabindex="-1" aria-labelledby="txt-modal-deactivate-user" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="txt-modal-deactivate-user">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to deactivate the user?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-deactivate-user">Sure</button>
      </div>
    </div>
  </div>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/User/UserSummary.js"></script>