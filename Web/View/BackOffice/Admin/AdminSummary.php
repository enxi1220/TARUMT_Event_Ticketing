<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
    $role = $_SESSION['adminInfo']['role'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
require '../../BackOfficeLayout.php';
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'] . '/TARUMT_Event_Ticketing/Web/StyleSheet/CSS_links.php';

?>


<!-- author: Ong Wi Lin -->
<div class="p-5 rounded-2">
  <div class="row">
    <div class="col">
      <h2 class="float-start mb-5">Admin / Staff Summary</h2>
    </div>
    <div class="col">
        <?php if ($role == "Admin"){ ?>
      <a class="btn btn-primary btn-lg btn-floating float-end" title="Add" href="AdminCreate.php" role="button">
        <i class="fas fa-plus"></i>
      </a>
        <?php } ?>

      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export CSV" onclick="exportAdminInCSV()">
      <i class="fas fa-file-csv fs-4"></i>
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportAdminInPDF()">
    <i class="fas fa-file-pdf fs-4"></i>
  </button>
    </div>
  </div>

  

  <table id="admin-summary" class="table table-striped w-100">
    <thead>
      <tr>
        <!--<th>ID</th>-->
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
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

<div class="modal fade" id="modal-activate-admin" tabindex="-1" aria-labelledby="txt-modal-activate-admin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="txt-modal-activate-admin">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to activate the account?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-activate-admin">Sure</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-deactivate-admin" tabindex="-1" aria-labelledby="txt-modal-deactivate-admin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="txt-modal-deactivate-admin">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to deactivate the admin?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-deactivate-admin">Sure</button>
      </div>
    </div>
  </div>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Admin/AdminSummary.js"></script>