//author: Lim En Xi

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Summary.php',
        null,
        function (success) {
            console.log(success);
            var events = JSON.parse(success);
            buildDataTable(events);
        }
    )
});

function exportEventInCSV() {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/ExportCSV.php',
    );
}

function exportEventInPDF() {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/ExportPDF.php',
    );
}

function activateEvent(eventId, eventNo) {
    $(`#modal-activate-event`).modal('show');
    $(`#btn-activate-event`).click(function () {
        var event = preparePostData(eventId, eventNo);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Activate.php',
            [submitData('event', event)],
            null,
            function () {
                location.reload();
            }
        );
        $(`#modal-activate-event`).modal('hide');
    });
}

function deactivateEvent(eventId, eventNo) {
    $(`#modal-deactivate-event`).modal('show');
    $(`#btn-deactivate-event`).click(function () {
        var event = preparePostData(eventId, eventNo);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Deactivate.php',
            [submitData('event', event)],
            null,
            function () {
                location.reload();
            }
        );
        $(`#modal-deactivate-event`).modal('hide');
    });
}

function preparePostData(eventId, eventNo) {
    var event = JSON.stringify({
        eventId: eventId,
        eventNo: eventNo
    });
    return event;
}

function buildDataTable(events) {
    $('#event-summary').DataTable({
        //show in desc according to column[0] event no
        order: [[0, 'desc']],
        data: events,
        columns:
            [
                { data: "eventNo" },
                { data: "name" },
                { data: "eventStartDate" },
                { data: "status" },
                { data: "createdBy" },
                { data: "createdDate" },
                { data: "updatedBy" },
                { data: "updatedDate" },
                {
                    render: function (data, type, row, meta) {
                        var html = `
                            <a class="btn btn-secondary btn-floating" title="View" href="EventRead.php?eventId=${row.eventId}" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="Update" href="EventUpdate.php?eventId=${row.eventId}" role="button">
                                <i class="fas fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?eventId=${row.eventId}" role="button">
                                <i class="fas fa-ticket"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?eventId=${row.eventId}" role="button">
                                <i class="fas fa-users"></i>
                            </a>`;

                        if (row.role == AdminRole.Admin) {
                            if (row.status == EventStatus.Closed) {
                                html +=
                                    `<button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateEvent(${row.eventId}, '${row.eventNo}')">
                                        <i class="fas fa-check"></i>
                                    </button>`;
                            } else if (row.status == EventStatus.Open) {
                                html += `<button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateEvent(${row.eventId}, '${row.eventNo}')">
                                            <i class="fas fa-times"></i>
                                        </button>`;
                            }
                        }
                        return html;
                    },
                    orderable: false
                }
            ]
    });
}