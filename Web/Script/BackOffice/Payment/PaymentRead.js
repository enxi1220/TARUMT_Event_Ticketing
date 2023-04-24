/* 
Author : Ong Wi Lin
 */


$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/PaymentRead.php',
        { payment_id: new URLSearchParams(window.location.search).get('payment_id') },
        function (success) {
            
            var payment = JSON.parse(success);
            console.log(JSON.parse(success));
            console.log(payment);
//            console.log(payment.paymentArray);

            display(payment[0]);
        }
    )
});

function display(payment) {
    console.log(payment);
    console.log(payment.payment_no);
    
    console.log(payment); // log the payment object
console.log(payment.$paymentDetail); // log the $paymentDetail array

// iterate through the $paymentDetail array and log the values of ticketNo and ticketPrice for each object
//payment.$paymentDetail.forEach(function(paymentDetail) {
//    console.log(paymentDetail.ticket_no, paymentDetail.ticketPrice);
//});
//
    console.log(payment.paymentDetail.ticket_no, payment.paymentDetail.ticket_price);
    console.log(payment.paymentDetail[0]);

payment.paymentDetail.forEach(function(paymentDetail) {
    console.log(paymentDetail.ticketNo, paymentDetail.ticketPrice);
});

    $('#txt-payment-no').val(payment.payment_no);
    $('#txt-payment-method').val(payment.payment_type);
    $('#txt-total-price').val(payment.price);
    $('#txt-date-time').val(payment.created_date);
    $('#txt-user-id').val(payment.userId);
    $('#txt-user-name').val(payment.name);
    $('#txt-user-mail').val(payment.mail);
    
    $('#txt-event-id').val(payment.eventId);
    $('#txt-event-no').val(payment.eventNo);
    $('#txt-event-name').val(payment.eventName);
    
    
    
    
    
    var table = '<label class="form-label" for="txt-event-name"><b>Ticket(s) Purchased</b></label><table><tr><th>Ticket No</th><th>Price</th></tr>';
    
    //payment details
    var html = '<label class="form-label" style="text-align: center;" for="txt-event-name">Ticket(s) Purchased</label>';
    $ticketCount = 0;

    payment.paymentDetail.forEach(function(paymentDetail) {
    
    $ticketCount++;
    table += '<tr><td>' + paymentDetail.ticketNo + '</td><td>RM ' + paymentDetail.ticketPrice + '</td></tr>';
    
    
    
    
        html += '<div class="col-md-6">'
        html += '<input type="text" minlength="150" class="form-control" value="' + paymentDetail.ticketNo + '"  readonly />'
        html +=  '</div>'
        html += '<div class="col-md-6">'
        html += '<input type="text" minlength="150" class="form-control"  value="RM ' + paymentDetail.ticketPrice + '" readonly />'
        html += '</div>';
        
        });
        
        table += '<tr><td><b>Total : </b></td><td><b>RM '+payment.price+'</b></td></tr>';

//        table += '<tr><td rowspan="2"></td><td rowspan="2"></td></tr>';
//        table += '<tr><td></td><td></td></tr>';
        table += '<tr ><td><b>Total Ticket(s) Count : </b></td><td><b>'+$ticketCount+'</b></td></tr>';

        
//        }
//        else{
//            console.log(" no values");
//        }
//    $('#ticket-info').html(html);
    $('#ticket-info').html(table);

}
