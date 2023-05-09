//author: Lim En Xi

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlTicket/Summary.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            console.log(success);
            var tickets = JSON.parse(success);
            display(tickets[0]);
            buildDataTable(tickets);

        }
    )
});

function buildDataTable(tickets) {
    $('#ticket-summary').DataTable({
        order: [[0, 'desc']],
        data: tickets,
        columns:
            [
                { data: "ticketNo" },
                { data: "description" },
                { data: "status" },
                { data: "owner" },
                { data: "updatedBy" },
                { data: "updatedDate" },
            ]
    });
}

function display(ticket) {
    $(`#txt-event-no`).text(ticket.eventNo);
    $('#txt-event-name').text(ticket.eventName);
}