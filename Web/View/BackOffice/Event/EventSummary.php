<?php
require '../../Layout.php';
?>
<div class="bg-light p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Event Summary</h2>
        </div>
        <div class="col">
            <a class="btn btn-primary btn-lg btn-floating float-end" data-mdb-toggle="tooltip" title="Add" href="EventCreate.php" role="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <table id="event-summary" class="table table-striped w-100">
        <thead>
            <tr>
                <th>Event No</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created Date</th>
                <th>Updated By</th>
                <th>Updated Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>EVT/2303/00001</td>
                <td>Voice Of Rahman</td>
                <td>28/03/2023 09:00</td>
                <td>Open</td>
                <td>En Xi</td>
                <td>19/03/2023 09:00</td>
                <td></td>
                <td>19/03/2023 09:00</td>
                <td>
                    <a class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="View" href="EventRead.php?eventId=" role="button">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="Update" href="EventUpdate.php?eventId=" role="button">
                        <i class="fas fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="View Ticket" href="../Ticket/TicketSummary.php?eventId=" role="button">
                        <i class="fas fa-ticket"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="View Participant" href="../Participant/ParticipantSummary.php?eventId=" role="button">
                        <i class="fas fa-users"></i>
                    </a>
                    <button id="btn-activate" class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="Activate" onclick="activateEvent(`$eventId`)">
                        <i class="fas fa-check"></i>
                    </button>
                    <button id="btn-deactivate" class="btn btn-secondary btn-floating" data-mdb-toggle="tooltip" title="Deactivate" onclick="deactivateEvent(`$eventId`)">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="activateEventModal" tabindex="-1" aria-labelledby="activateEventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="activateEventModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to activate the event?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-activate-event">Sure</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deactivateEventModal" tabindex="-1" aria-labelledby="deactivateEventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deactivateEventModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">Are you sure to deactivate the event?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-deactivate-event">Sure</button>
      </div>
    </div>
  </div>
</div>


<script src="../../../Script/BackOffice/Event/EventSummary.js"></script>