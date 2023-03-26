//author: Lim En Xi
$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Summary.php',
        null,
        function (success) {
            var events = JSON.parse(success);
            $('#event-summary').DataTable({
                // data: success,
                // columns: [
                //     { data: "eventNo" },
                //     { data: "name" },
                //     { data: "eventStartDate" },
                //     { data: "status" },
                //     { data: "createdBy" },
                //     { data: "createdDate" },
                //     { data: "updatedBy" },
                //     { data: "updatedDate" },
                //     {
                //         data: "eventId",
                //         render: function (eventId) {
                //             var html =
                //                 `
                //             <a class="btn btn-secondary btn-floating" title="View" href="EventRead.php?eventId=${eventId}" role="button">
                //             <i class="fas fa-eye"></i>
                //             </a>
                //             <a class="btn btn-secondary btn-floating" title="Update" href="EventUpdate.php?eventId=${eventId}" role="button">
                //                 <i class="fas fa-pen-to-square"></i>
                //             </a>
                //             <a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?eventId=${eventId}" role="button">
                //                 <i class="fas fa-ticket"></i>
                //             </a>
                //             <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?eventId=${eventId}" role="button">
                //                 <i class="fas fa-users"></i>
                //             </a>
                //             <button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateEvent(${eventId})">
                //                 <i class="fas fa-check"></i>
                //             </button>
                //             <button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateEvent(${eventId})">
                //                 <i class="fas fa-times"></i>
                //             </button>
                //             `;
                //             return html;
                //         }
                //     }

                // ]
            });
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Oops...',
            //     text: success
            // })
            var html = ``;
            // // todo: add data to DataTable, currently is just show but not bind into datatable proof: Showing 1 to 1 of 1 entries
            events.forEach(event => {
                html += `
                <tr>
                <td>${event.eventNo}</td>
                <td>${event.name}</td>
                <td>${event.eventStartDate}</td>
                <td>${event.status}</td>
                <td>${event.createdBy}</td>
                <td>1${event.createdDate}</td>
                <td>${event.updatedBy}</td>
                <td>1${event.updatedDate}</td>
                <td>
                    <a class="btn btn-secondary btn-floating" title="View" href="EventRead.php?eventId=${event.eventId}" role="button">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" title="Update" href="EventUpdate.php?eventId=${event.eventId}" role="button">
                        <i class="fas fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?eventId=${event.eventId}" role="button">
                        <i class="fas fa-ticket"></i>
                    </a>
                    <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?eventId=${event.eventId}" role="button">
                        <i class="fas fa-users"></i>
                    </a>
                    <button id="btn-activate" class="btn btn-secondary btn-floating" title="Activate" onclick="activateEvent(${event.eventId})">
                        <i class="fas fa-check"></i>
                    </button>
                    <button id="btn-deactivate" class="btn btn-secondary btn-floating" title="Deactivate" onclick="deactivateEvent(${event.eventId})">
                        <i class="fas fa-times"></i>
                    </button>
                </td>
            </tr>
                `;
            });
            $('#table-content').html(html);

        },
        function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.responseText
            })
        }
    )

    StatusButton();
});

// todo: based on status to set hide button 
function StatusButton() {
    if (false) {
        // role is staff
        $(`#btn-activate`).hide();
        $(`#btn-deactivate`).hide();
    } else if (true) {
        // status is activate
        $(`#btn-activate`).hide();
    } else {
        // status is deactivate
        $(`#btn-deactivate`).hide();
    }
}

function activateEvent(eventId) {
    $(`#activateEventModal`).modal('show');
    $(`#btn-activate-event`).click(function () {
        //todo: update db
        console.log(eventId);
        $(`#activateEventModal`).modal('hide');
    });
}

function deactivateEvent(eventId) {
    $(`#deactivateEventModal`).modal('show');
    $(`#btn-deactivate-event`).click(function () {
        //todo: update db
        console.log(eventId);
        $(`#deactivateEventModal`).modal('hide');
    });
}