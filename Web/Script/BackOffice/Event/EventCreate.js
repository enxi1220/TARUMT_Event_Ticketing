//author: Lim En Xi

$(document).ready(function () {
    $(`#form-add-event`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-add-event`)[0].checkValidity() && checkQty()) {
            var event = setJSON();
            console.log(event);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Create.php',
                [
                    submitData('event', event),
                    submitData('poster', $('#txt-poster')[0].files[0]),
                ],
                null,
                function () {
                    location.href = "EventSummary.php";
                }
            );
        }
    });
});

function setJSON() {
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

// validation 
function checkQty() {
    var qty =
        parseInt($(`#txt-vip-ticket-qty`).val()) +
        parseInt($(`#txt-std-ticket-qty`).val()) +
        parseInt($(`#txt-bgt-ticket-qty`).val());

    if (qty <= 0 || isNaN(qty)) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "Total ticket quantity must be more than 0"
        });
        return false;
    }
    return true;
}