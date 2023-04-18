<?php
require '../../Layout.php';

?>
<!-- author: Vinnie Chin Loh Xin -->
<div class="p-5 rounded-2">
    <div class="row">
        <h2 class="float-start mb-5">Booking Summary</h2>


    </div>

    <table id="booking-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Booking No</th>
                <th>Number of Tickets</th>
                <th>Event Name</th>
                <th>Venue</th>
                <th>Booking Date</th>
                <th>Booked By</th>
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
<script src="../../../Script/BackOffice/Booking/BookingSummary.js"></script>