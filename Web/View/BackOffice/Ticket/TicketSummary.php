<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">
                Ticket Summary - 
                <span id="txt-event-no"></span>
                <span id="txt-event-name"></span>
            </h2>
            
        </div>
        <div class="col-1">
            <a class="btn btn-secondary btn-lg btn-floating float-end" title="Back" href="../Event/EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <table id="ticket-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Ticket No</th>
                <th>Description</th>
                <th>Status</th>
                <th>Owner</th>
                <th>Ticket Purchased By</th>
                <th>Ticket Sold Date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Ticket/TicketSummary.js" type="text/javascript"></script>