//author: Lim En Xi

$(document).ready(function () {
    get(
            '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Summary.php',
            [],
            function (success) {
                var category = JSON.parse(success);
                console.log(category);
                display(category);
            }
    )

    $(`#form-add-event`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-add-event`)[0].checkValidity() && checkQty()) {
            var event = preparePostData();
            console.log(event);
            post(
                    '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Create.php',
                    [
                        submitData('event', event),
                        submitData('poster', $('#txt-poster')[0].files[0]),
                    ],
                    null,
                    function () {
                        get('/TARUMT_Event_Ticketing/Controller/CtrlUser/Update.php',
                                [],
                                []
                                )

                        location.href = "EventSummary.php";
//                      

//                        location.href = "EventSummary.php";
                    }
            );
        }
    });

    $('#txt-name').val('testing');
    $(`#drop-down-category`).val(2);
    $('#txt-description').val('testing');
    $('#txt-venue').val('testing');
    $(`#date-reg-start`).val(new Date());
    $(`#date-reg-end`).val(new Date());
    $(`#date-event-start`).val(new Date());
    $(`#date-event-end`).val(new Date());
    $('#txt-vip-ticket-price').val(100);
    $('#txt-std-ticket-price').val(50);
    $('#txt-bgt-ticket-price').val(10);
    $('#txt-vip-ticket-qty').val(1);
    $('#txt-std-ticket-qty').val(1);
    $('#txt-bgt-ticket-qty').val(1);
    $('#txt-organizer-name').val('testing');
    $('#txt-organizer-phone').val('0123456789');
    $('#txt-organizer-mail').val('testing@gmail.com');

});

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
            html: "Total ticket quantity must be more than 0"
        });
        return false;
    }
    return true;
}

function display(category) {
    for (var c in category) {
        $(`#drop-down-category`).append($("<option>", {
            value: category[c].categoryId,
            text: category[c].name
        }));
    }

}