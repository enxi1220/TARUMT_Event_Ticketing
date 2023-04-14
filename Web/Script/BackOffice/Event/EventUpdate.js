//author: Lim En Xi

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
        { eventId: new URLSearchParams(window.location.search).get('eventId') },
        function (success) {
            var event = JSON.parse(success);
            display(event);
        }
    );

    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Summary.php',
        [],
        function (success) {
            var category = JSON.parse(success);
            console.log(category);
            displayCategory(category);
        }
    )

    $(`#form-edit-event`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-edit-event`)[0].checkValidity()) {
            var event = preparePostData();
            console.log(event);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Update.php',
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

function preparePostData() {
    var event = JSON.stringify({
        eventId: new URLSearchParams(window.location.search).get('eventId'),
        eventNo: $('#txt-event-no').val(),
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
        status: $(`#drop-down-status`).val(),
        organizerName: $('#txt-organizer-name').val(),
        organizerPhone: $('#txt-organizer-phone').val(),
        organizerMail: $('#txt-organizer-mail').val()
    });

    return event;
}

function displayCategory(category){
    for (var c in category) {
        $(`#drop-down-category`).append($("<option>", {
            value: category[c].categoryId,
            text: category[c].name
        }));
    }
}

function display(event) {
    for (var key in EventStatus) {
        var status = EventStatus[key];
        $(`#drop-down-status`).append($("<option>", {
            value: status,
            text: status
        }));
    }
    
    $(`#txt-event-no`).val(event.eventNo);
    $('#drop-down-status').val(event.status);
    $('#txt-name').val(event.name);
    $(`#drop-down-category`).val(event.categoryId);
    $('#txt-description').val(event.description);
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
    // $('#txt-poster').val(event.poster);
    $('#img-poster').attr('src', event.posterPath);
}