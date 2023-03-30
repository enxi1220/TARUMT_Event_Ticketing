//author: Lim En Xi

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            var event = JSON.parse(success);
            display(event);
        }
    )
    
    $(`#form-add-booking`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-add-event`)[0].checkValidity() && checkQty()) {
            var booking = preparePostData();
            console.log(booking);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlBooking/CheckTicketAvailability.php',
                [
                    submitData('booking', booking)
                ],
                null,
                function () {
                    location.href = "../Payment/PaymentCreate.php";
                }
            );
        }
    });
});


function placeOrder() {
    // check qty
}

function ticketChange() {
    calcPrice();
    toggleOrderButton();
}

function calcPrice() {
    var vipQty = parseInt($(`#txt-vip-ticket-qty`).val());
    var stdQty = parseInt($(`#txt-std-ticket-qty`).val());
    var bgtQty = parseInt($(`#txt-bgt-ticket-qty`).val());
    let vipPrice = 0;
    let stdPrice = 0;
    let bgtPrice = 0;
    var vipUnitPrice = parseInt($(`#txt-vip-ticket-price`).val());
    var stdUnitPrice = parseInt($(`#txt-std-ticket-price`).val());
    var bgtUnitPrice = parseInt($(`#txt-bgt-ticket-price`).val());

    if (!isNaN(vipQty)) {
        vipPrice = vipQty * vipUnitPrice;
    }

    if (!isNaN(stdQty)) {
        stdPrice = stdQty * stdUnitPrice;
    }
    if (!isNaN(bgtQty)) {
        bgtPrice = bgtQty * bgtUnitPrice;
    }

    $(`#txt-total-ticket-price`).val(vipPrice + stdPrice + bgtPrice);
}

function toggleOrderButton() {
    if (parseFloat($(`#txt-total-ticket-price`).val()) <= 0) {
        $(`#btn-place-order`).addClass('disabled');
    } else {
        $(`#btn-place-order`).removeClass('disabled');
    }
}

function display(event) {
    $(`#txt-event-no`).text(event.eventNo);
    $('#txt-name').text(event.name);
    $(`#txt-event-start`).text(event.eventStartDate);
    $('#txt-vip-ticket-price').val(event.vipTicketPrice);
    $('#txt-std-ticket-price').val(event.standardTicketPrice);
    $('#txt-bgt-ticket-price').val(event.budgetTicketPrice);
    $('#img-poster').attr('src', event.posterPath);
}

function preparePostData() {
    var event = JSON.stringify({
        name: $('#txt-name').val(),
        categoryId: $(`#drop-down-category`).val(),
        description: $('#txt-description').val(),
        venue: $('#txt-venue').val(),
        registerStartDate: $(`#date-reg-start`).val(),
        registerEndDate: $(`#date-reg-end`).val(),
        eventStartDate: $(`#date-event-start`).val(),
        eventEndDate: $(`#date-event-end`).val(),
        vipTicketPrice: $('#txt-vip-ticket-price').val(),
        stdTicketPrice: $('#txt-std-ticket-price').val(),
        bgtTicketPrice: $('#txt-bgt-ticket-price').val(),
        vipTicketQty: $('#txt-vip-ticket-qty').val(),
        stdTicketQty: $('#txt-std-ticket-qty').val(),
        bgtTicketQty: $('#txt-bgt-ticket-qty').val(),
        organizerName: $('#txt-organizer-name').val(),
        organizerPhone: $('#txt-organizer-phone').val(),
        organizerMail: $('#txt-organizer-mail').val()
    });

    return event;
}
