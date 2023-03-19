<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="bg-light p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">$eventNo Participant Summary</h2>
        </div>
        <div class="col">
            <a class="btn btn-primary btn-lg btn-floating float-end" data-mdb-toggle="tooltip" title="Back" href="../Event/EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <table id="participant-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kuma</td>
                <td>En Xi</td>
                <td>8888</td>
                <td>enxi@gmail.com</td>
            </tr>
        </tbody>
    </table>
</div>
<script src="../../../Script/BackOffice/Participant/ParticipantSummary.js" type="text/javascript"></script>