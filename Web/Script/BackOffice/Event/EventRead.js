//author: Lim En Xi

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
    $(`#txt-event-no`).val(event.eventNo);
    $('#txt-status').val(event.status);
    $('#txt-name').val(event.name);
    $(`#txt-category`).val(event.categoryName);
    $('#txt-description').val(event.description);
    $('#txt-poster').val(event.poster);
    $('#txt-venue').val(event.venue);
    $(`#date-reg-start`).val(event.registerStartDate);
    $(`#date-reg-end`).val(event.registerEndDate);
    $(`#date-event-start`).val(event.eventStartDate);
    $(`#date-event-end`).val(event.eventEndDate);
    $('#txt-vip-ticket-price').val(event.vipTicketPrice);
    $('#txt-std-ticket-price').val(event.standardTicketPrice);
    $('#txt-bgt-ticket-price').val(event.budgetTicketPrice);
    $('#txt-vip-ticket-qty').val(event.vipTicketQty);
    $('#txt-std-ticket-qty').val(event.standardTicketQty);
    $('#txt-bgt-ticket-qty').val(event.budgetTicketQty);
    $('#txt-organizer-name').val(event.organizerName);
    $('#txt-organizer-phone').val(event.organizerPhone);
    $('#txt-organizer-mail').val(event.organizerMail);
    $('#img-poster').attr('src', event.posterPath);
}
