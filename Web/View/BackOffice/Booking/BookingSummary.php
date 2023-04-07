<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Booking Summary</h2>
        </div>
        <div class="col">
            <a class="btn btn-primary btn-lg btn-floating float-end" title="Add" href="BookingCreate.php" role="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <table id="event-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Booking No</th>
                <th>Event Name</th>
                <th>Booking Date</th>
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
<div class="modal fade" id="activateBookingModal" tabindex="-1" aria-labelledby="activateBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="activateBookingModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to activate the booking?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn-activate-event">Sure</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deactivateBookingModal" tabindex="-1" aria-labelledby="deactivateBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deactivateBookingModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to deactivate the booking?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn-deactivate-event">Sure</button>
      </div>
    </div>
  </div>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Booking/BookingSummary.js"></script>