<?php
require '../../Layout.php';
?>
<!-- author: Ong Wi Lin -->
<div class="p-5 rounded-2">
  <div class="row">
    <div class="col">
      <h2 class="float-start mb-5">Payment Summary</h2>
    </div>
    <div class="col">
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export CSV" onclick="exportPaymentInCSV()">
      <i class="fas fa-file-csv fs-4"></i>
      <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportPaymentInPDF()">
    <i class="fas fa-file-pdf fs-4"></i>
  </button>
    </div>
  </div>

  <table id="payment-summary" class="table table-striped w-100">
    <thead>
      <tr>
        <!--<th>ID</th>-->
        <th>ID</th>
        <th>Payment No</th>
        <th>Booking ID</th>
        <th>Payment Method</th>
        <th>Price</th>
        <th>Created Date</th>
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
<script src="../../../Script/BackOffice/Payment/PaymentSummary.js"></script>