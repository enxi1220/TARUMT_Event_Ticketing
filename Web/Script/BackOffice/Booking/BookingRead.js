//author: Vinnie Chin Loh Xin


$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlBooking/Read.php',
        { bookingId: new URLSearchParams(window.location.search).get('bookingId') },
        function (success) {
            
            
            var booking = JSON.parse(success);
            
            console.log(JSON.parse(success));
            display(booking);
        }
    )
});

function display(booking) {
    
     var ticket;
     booking.bookingDetails.forEach(function (bookingDetail, index) {
    
          ticket = $(`  <div class="row mb-4 px-5">
          <div class="col-md-1">
                    ${index+1} 
                </div>
                <div class="col-md-7">
                  ${bookingDetail.ticketNo} 
                </div>
                <div class="col-md-4">
                  ${bookingDetail.price} 
                </div>
            </div>`);
     
      $(`.ticket-booked`).append(ticket);
    });
    
    
    $(`#txt-booking-no`).val(booking.bookingNo);
    $(`#txt-booking-date`).val(booking.createdDate);
   
    $('#txt-participant').val(booking.createdBy);
    $('#txt-phone').val(booking.customerPhone);
    $('#event-poster').attr('src', booking.posterPath);
    $('#txt-event-name').val(booking.eventName);
    $('#txt-event-venue').val(booking.venue);
    $('#txt-event-start').val(booking.eventStartDate);
    $('#txt-event-end').val(booking.eventEndDate);
}
