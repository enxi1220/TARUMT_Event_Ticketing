//author: Lim En Xi

$(document).ready(function () {

    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlParticipant/Summary.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            var participant = JSON.parse(success);
            buildDataTable(participant);

        }
    );
    
        get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            var event = JSON.parse(success);
            display(event);
        }
    );
        
    
});



function buildDataTable(participants) {
    $('#participant-summary').DataTable({
        order: [[0, 'desc']],
        data: participants,
        columns:
            [
                { data: "username" },
                { data: "name" },
                { data: "phone" },
                { data: "mail" }
            ]
    });
}

function display(event) {
   $(`#txt-event-no`).text(event.eventNo);
   $(`#txt-event-name`).text(event.name);
}


