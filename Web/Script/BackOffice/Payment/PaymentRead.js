/* 
Author : Ong Wi Lin
 */


$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/PaymentRead.php',
        { payment_id: new URLSearchParams(window.location.search).get('payment_id') },
        function (success) {
            console.log(JSON.parse(success));
            var payment = JSON.parse(success);
            display(payment);
        }
    )
});

function display(payment) {
    $('#txt-payment-no').val(payment.payment_no);
    $('#txt-payment-method').val(payment.payment_type);
    $('#txt-total-price').val(payment.price);
    $('#txt-date-time').val(payment.created_date);
    
    //payment details
    // payment details
    var html = '';
//    for (var i = 0; i < payment.paymentDetails.length; i++) {
    if (typeof payment.paymentDetails === 'object' && payment.paymentDetails !== null) {
        payment.paymentDetails.forEach(function(paymentDetails) {

        html += '<div class="row mb-4">';
        html += '<div class="col-md-6">';
        html += '<div class="form-group">';
        html += '<label class="form-label">Ticket No</label>';
        html += '<input type="text" value="' + paymentDetails.ticket_no + '" class="form-control" readonly />';

        html += '<label class="form-label">Ticket Price</label>';
        html += '<input type="text" value="' + paymentDetails.ticket_price + '" class="form-control" readonly />';

        html += '<label class="form-label">Event Name</label>';
        html += '<input type="text" value="' + paymentDetails.event_name + '" class="form-control" readonly />';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        
        });
    
//    payment.paymentDetails.forEach(function(paymentDetails) {
//
////        var paymentDetails = payment.paymentDetails[i];
//        html += '<div class="row mb-4">';
//        html += '<div class="col-md-6">';
//        html += '<div class="form-group">';
//        html += '<label class="form-label">Ticket No</label>';
//        html += '<input type="text" value="' + paymentDetails.ticket_no + '" class="form-control" readonly />';
//
//        html += '<label class="form-label">Ticket Price</label>';
//        html += '<input type="text" value="' + paymentDetails.ticket_price + '" class="form-control" readonly />';
//
//        html += '<label class="form-label">Event Name</label>';
//        html += '<input type="text" value="' + paymentDetails.event_name + '" class="form-control" readonly />';
//        html += '</div>';
//        html += '</div>';
//        html += '</div>';
//    });
    $('#product-details').html(html);
}
}
