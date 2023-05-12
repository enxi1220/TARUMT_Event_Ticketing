//author: Ong Yi Chween


$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayments/Read.php',
        { bookingId: new URLSearchParams(window.location.search).get('bookingId') },
        function (success) {
            console.log(success);
            var payment = JSON.parse(success);
            display(payment);
        }
    )
});

function display(payment) {
    
    $(`#txt-paymentNo`).val(payment.payment_no);
    $(`#txt-price`).val(payment.price);
    $('#txt-method').val(payment.payment_type);
    $('#txt-date').val(payment.created_date);
}


