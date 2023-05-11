        <!-- author: Vinnie Chin Loh Xin -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Booking Summary</title>
    </head>
<?php
require '../../Layout.php';

?>
    <body>
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Booking Summary</h2>
        </div>
        <div class="col">
            <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export CSV" onclick="exportBookingInCSV()">
                <i class="fas fa-file-csv fs-4"></i>
                <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportBookingInPDF()">
                    <i class="fas fa-file-pdf fs-4"></i>
        </div>
    </div>



    <table id="booking-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Booking Number</th>
                <th>Booking Ticket</th>
                <th>Booking Price</th>
                <th>Booking By</th>
                <th>Booking Date</th>
                <th>Booking Event</th>
                <th>Booking Event Number</th>
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
      
    </body>
</html>
