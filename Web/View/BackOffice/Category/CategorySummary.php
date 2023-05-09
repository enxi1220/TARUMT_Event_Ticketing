<?php
require '../../Layout.php';


?>
<!-- author: Ong Yi Chween -->
<div class="p-5 rounded-2">
  <div class="row">
    <div class="col">
      <h2 class="float-start mb-5">Category Summary</h2>
    </div>
    <div class="col">
      <a class="btn btn-primary btn-lg btn-floating float-end" title="Add" href="CategoryCreate.php" role="button">
        <i class="fas fa-plus"></i>
      </a>
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export CSV" onclick="exportCategoryInCSV()">
      <i class="fas fa-file-csv fs-4"></i>
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportCategoryInPDF()">
    <i class="fas fa-file-pdf fs-4"></i>
  </button>
    </div>
  </div>
    
    <table id="category-summary" class="table table-striped w-100">
    <thead>
      <tr>
        <th>Category Name</th>
        <th>Category Description</th>
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



<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Category/CategorySummary.js"></script>
