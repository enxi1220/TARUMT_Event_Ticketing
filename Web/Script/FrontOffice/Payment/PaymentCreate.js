//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            console.log(success);
            var event = JSON.parse(success);
            display(event);
        }
    )
});

function display(event) {
    $(`#txt-event-no`).text(event.eventNo);
    $('#txt-name').text(event.name);
    $(`#txt-event-start`).text(event.eventStartDate);
    $('#txt-vip-ticket-price').val(event.vipTicketPrice);
    $('#txt-std-ticket-price').val(event.standardTicketPrice);
    $('#txt-bgt-ticket-price').val(event.budgetTicketPrice);
    $('#img-poster').attr('src', event.posterPath);
}


function submitPayment(paymentType) {
    var payment = preparePostData(paymentType);
    console.log(payment);
    post(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Create.php',
        [
            submitData('payment', payment)
        ],
        null,
        function () {
            location.href = `../Event/EventSummary.php`;
        }
    );
}

function preparePostData(type) {
    return JSON.stringify({
        eventId: new URLSearchParams(window.location.search).get('eventId'),
        vipTicketQty: new URLSearchParams(window.location.search).get('vipTicketQty'),
        stdTicketQty: new URLSearchParams(window.location.search).get('stdTicketQty'),
        bgtTicketQty: new URLSearchParams(window.location.search).get('bgtTicketQty'),
        paymentType : type
    });
}