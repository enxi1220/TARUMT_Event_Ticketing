//author: Lim En Xi

$(document).ready(function () {
    get(
            '/TARUMT_Event_Ticketing/Controller/CtrlTicket/Summary.php',
            {eventId: new URLSearchParams(window.location.search).get('eventId')},
            function (success) {
                console.log(success);
                var ticket = JSON.parse(success);
                display(ticket);
            }
    );
});

function display(ticket) {
    var template = '';
    ticket.forEach(item => {

        template += `
            <div class="card rounded-3 mb-4  w-75">
                            <div class="card-body p-4">
                                <div class="row ">
                                    <div class="col-md-5">
                                        <img src="${item.posterPath}" class="card-img-top" alt="" />
                                    </div>

                                    <div class="col-md-7 ">
                                        <h5 class="card-title d-flex justify-content-between" id="txt-ticket-no">${item.ticketNo}
                                            <span>${new Date(item.eventStartDate).toLocaleDateString()}</span>
                                        </h5>
                                        <p class="card-text">
                                            ${item.eventNo} 
                                        </p>
                                        <p class="card-text">
                                            ${item.eventName}
                                        </p>
        

                                    </div>
                                </div>
                            </div>
                        </div>
        `;


        $('#future').append(template);
    });

}