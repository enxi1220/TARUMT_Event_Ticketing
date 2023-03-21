<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">$eventNo Ticket Summary</h2>
        </div>
        <div class="col">
            <a class="btn btn-secondary btn-lg btn-floating float-end" title="Back" href="../Event/EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <table id="ticket-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Ticket No</th>
                <th>Price (RM)</th>
                <th>Owner</th>
                <th>Ticket Type</th>
                <th>Ticket Sold Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>VIP/2303/0001</td>
                <td>39</td>
                <td>En Xi</td>
                <td>VIP</td>
                <td>20/03/2023 12:00</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Ticket/TicketSummary.js" type="text/javascript"></script>