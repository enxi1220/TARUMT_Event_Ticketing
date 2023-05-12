<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['adminInfo'])) {
        $adminName = $_SESSION['adminInfo']['name'];
        $admin_id = $_SESSION['adminInfo']['admin_id'];
    } else {
        header('Location: ../Admin/AdminLogin.php');
        exit;
    }
    require '../../BackOfficeLayout.php';
?>
<!-- author: Tan Lin Yi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">
                Participant Summary - 
                <span id="txt-event-no"></span>
                <span id="txt-event-name"></span>
            </h2>

        </div>
        <div class="col-1">
            <a class="btn btn-secondary btn-lg btn-floating float-end" title="Back" href="../Event/EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
            
                <button id="btn-activate" class="btn btn-secondary btn-lg btn-floating float-end me-4" title="Export PDF" onclick="exportParticipantInPDF()">
                    <i class="fas fa-file-pdf fs-4"></i>
                </button>
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
        </tbody>
    </table>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Participant/ParticipantSummary.js" type="text/javascript"></script>