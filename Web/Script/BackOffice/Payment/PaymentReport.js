/* 
Author : Ong Wi Lin
 */

$(document).ready(function () {
    display();
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ReportPaymentRead.php',null,
        function (success) {
                console.log(success);
            console.log(JSON.parse(success));
            var payment = JSON.parse(success);
            display(payment);
        }
    )
});


//
//$(document).ready(function () {
//    $.get(
//        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ReportPaymentRead.php',
//        function(response) {
//            try {
//                var payment = JSON.parse(response);
//                display(payment);
//            } catch (error) {
//                console.log('Error parsing JSON:', error);
//            }
//        }
//    ).fail(function(error) {
//        console.log('Error:', error);
//    });
//});
//

//
//$(document).ready(function () {
//    $.get(
//        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ReportPaymentRead.php',
//        function(response) {
//            try {
//                var payment = JSON.parse(response);
//                display(payment);
//            } catch (error) {
//                console.log('Error parsing JSON:', error);
//            }
//        }
//    ).fail(function(error) {
//        console.log('Error:', error);
//    });
//});

//$(document).ready(function () {
////    $.get(
////        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ReportPaymentRead.php',
//////        { payment_id: new URLSearchParams(window.location.search).get('payment_id') }
////    ).done(function(success) {
////        console.log(JSON.parse(success));
////        var payment = JSON.parse(success);
////        display(payment);
////    }).fail(function(error) {
////        console.log('Error:', error);
////    });
//    $.get(
//        '/TARUMT_Event_Ticketing/Controller/CtrlPayment/ReportPaymentRead.php',
//        function(success) {
//            console.log(JSON.parse(success));
//            var payment = JSON.parse(success);
//            display(payment);
//        }
//    ).fail(function(error) {
//        console.log('Error:', error);
//    });
//
//});


function display(payment) {
        console.log(payment);
    var dateLabel;
    var dataTtlPrice;

    
    payment.paymentArray.forEach(function (paymentArr, index)
    {
        let dateObj = new Date(paymentArr.created_date); // Convert the date string to a Date object
        let day = dateObj.getDate(); // Get the day of the month (1-31)
        let month = dateObj.getMonth() + 1; // Get the month (0-11), add 1 to get the correct month (1-12)
        
        dateLabel+=day+"/"+month;
        dateLabel+=",";
        
        dataTtlPrice+=paymentArr.price;
        dataTtlPrice+=",";
        
    });
    
        $('#label').val(payment.payment_no);
    $('#data').val(payment.payment_type);
} 
//    //        $dateString = '2023-04-14 14:51:52';
//    $date = new DateTime(payment.created_date);
//    $day = $date->format('d');
//    $month = $date->format('m');
//
//    echo "Day: $day, Month: $month";

//let dateStr = '2023-04-22 14:51:52'; // Example date string
//let dateObj = new Date(payment.created_date); // Convert the date string to a Date object
//let day = dateObj.getDate(); // Get the day of the month (1-31)
//let month = dateObj.getMonth() + 1; // Get the month (0-11), add 1 to get the correct month (1-12)
//
//console.log(day + "/" + month); // Output the day and month

    
//    $label = day + "/" + month;
//    $data = 
//    
    
    
//    $('#txt-payment-no').val(payment.payment_no);
//    $('#txt-payment-method').val(payment.payment_type);
//    $('#txt-total-price').val(payment.price);
//    $('#txt-date-time').val(payment.created_date);
    
    //payment details
    // payment details
//    var html = '';
////    for (var i = 0; i < payment.paymentDetails.length; i++) {
//    if (typeof payment.paymentDetails === 'object' && payment.paymentDetails !== null) {
//        payment.paymentDetails.forEach(function(paymentDetails) {
//
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
//        
//        });
    
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
//    $('#product-details').html(html);



