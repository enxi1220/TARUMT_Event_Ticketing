//author: Vinnie Chin Loh Xin

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Summary.php',
        null,
        function (success) {
            var booking = JSON.parse(success);
            
            

            console.log(JSON.parse(success));
            
            buildDataTable(booking);
        }
    );
});

function exportBookingInCSV(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Export.php',
        { action: "exportCSV"}
    );
}

function exportBookingInPDF(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Export.php',
        { action: "exportPDF"}
    );
}

function buildDataTable(booking){
    $('#booking-summary').DataTable({
        order: [[0, 'desc']],
        data: booking,
        columns: 
        [
            { data: "bookingNo" },
            { data: "ticketCount" },
            { data: "price" },
            { data: "createdBy" },
            { data: "createdDate" },
            { data: "eventName" },
            { data: "eventNo" },
            {
                render: function (data, type, row, meta) {
                    var html = `
                            <a class="btn btn-secondary btn-floating" title="View" href="BookingRead.php?bookingId=${row.bookingId}" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?bookingId=${row.bookingId}" role="button">
                                <i class="fas fa-ticket"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="View Participant" href="../Participant/ParticipantSummary.php?bookingId=${row.bookingId}" role="button">
                                <i class="fas fa-users"></i>
                            </a>`;
                   
                    return html;
                },
                orderable: false
            }
        ]
    });
}