//author: Lim En Xi

$(document).ready(function () {
    needLogin()
                .then(function (result) {
                    console.log('Login succeeded:', result);
                    $('.container').removeClass('d-none');

                })
                .catch(function (error) {
                    console.error('Login failed:', error);
                    $('.container').addClass('d-none');
                });

//    $('body').addClass('d-none');
//    if (needLogin()) {
//        
//        $('body').removeClass('d-none');
//        get(
//                '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
//                {eventId: new URLSearchParams(window.location.search).get('eventId')},
//                function (success) {
//                    console.log(success);
//                    var event = JSON.parse(success);
//                    display(event);
//                }
//        )
//
//
//       
//
//    }



    $(`#form-add-booking`).submit(function (event) {
        event.preventDefault();
        var ticket = preparePostData();
        console.log(ticket);
        post(
            '/TARUMT_Event_Ticketing/Controller/CtrlTicket/CheckQuantity.php',
            // '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Create.php',
            [
                submitData('ticket', ticket)
            ],
            null,
            function () {
                var data = JSON.parse(ticket);
                location.href = `../Payment/PaymentCreate.php?eventId=${data.eventId}&vipTicketQty=${data.vipTicketQty}&stdTicketQty=${data.stdTicketQty}&bgtTicketQty=${data.bgtTicketQty}`;
            }
        );
    });
});

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
    return JSON.stringify({
        eventId: new URLSearchParams(window.location.search).get('eventId'),
        vipTicketQty: $('#txt-vip-ticket-qty').val(),
        stdTicketQty: $('#txt-std-ticket-qty').val(),
        bgtTicketQty: $('#txt-bgt-ticket-qty').val()
    });
}
