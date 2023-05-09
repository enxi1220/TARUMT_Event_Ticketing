//author: Lim En Xi

$(document).ready(function () {
    
    // checkLogin();
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Summary.php',
        {},
        function (success) {
            console.log(success);
            var booking = JSON.parse(success);
            display(booking);
        }
    )
});

function display(booking) {
    var template = '';

    booking.forEach(item => {
        const date = new Date(item.eventStartDate);
        const isFuture = date > new Date();

        template += `
            <div class="col">
                <div class="card h-100">
                    <img src="${item.posterPath}" class="card-img-top" alt="" />
                    <div class="card-body">
                        <h5 class="card-title" id="txt-booking-no">${item.bookingNo}</h5>
                        <p class="card-text">
                            ${item.eventNo} 
                        </p>
                        <p class="card-text">
                            ${item.eventName}
                        </p>
                        <p class="card-text">
                            <i class="fas fa-location-dot"></i>
                            <span class="p-2">${item.venue}</span>
                        </p>
                        <p class="card-text">
                            <i class="fas fa-clock"></i>
                            <span class="p-2">${item.eventStartDate} - ${item.eventEndDate}</span>
                        </p>
                        <p class="card-text float-end">
                            <a class="btn btn-primary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?bookingId=${item.bookingId}" role="button">
                                <i class="fas fa-ticket"></i>
                            </a>
                            <a class="btn btn-primary btn-floating" title="View Payment" href="../Payment/PaymentRead.php?bookingId=${item.bookingId}" role="button">
                                <i class="fas fa-dollar-sign"></i>
                            </a>
                            <a class="btn btn-primary btn-floating" title="View Event" href="../Event/EventRead.php?eventId=${item.eventId}" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        `;

        if (isFuture) {
            $('#future').append(template);
        } else {
            $('#past').append(template);
        }

        template = '';
    });
}
