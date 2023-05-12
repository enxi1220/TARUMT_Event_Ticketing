//author: Vinnie Chin Loh Xin

$(document).ready(function () {
    get(
            '/TARUMT_Event_Ticketing/Controller/CtrlEvent/Read.php',
    
            {eventId: new URLSearchParams(window.location.search).get('eventId'),
            office: "front"},
            function (success) {
                console.log(success)
                var event = JSON.parse(success);
                display(event);
            }
    );


});

function addToWishlist() {

    
    var wishlist = JSON.stringify({
       
        eventId: new URLSearchParams(window.location.search).get('eventId')
   
    });
    
    
     post(
                '/TARUMT_Event_Ticketing/Controller/CtrlWishList/Create.php',
                [
                    submitData('wishlist', wishlist)
                  
                ],
                null,
                function () {
                    location.href = "EventSummary.php";
                }
            );
   
}
//function display(event) {
//    const html = `<div class="container mt-5"> <h1 class="mb-3">Event Details</h1> <div class="row"> <div class="col-md-4 mb-3"> <img src="${event.poster}" alt="${event.name}" class="img-fluid" /> </div> <div class="col-md-8"> <h2>${event.name}</h2> <div class="mb-3"> <strong>Event ID:</strong> ${event.eventId} </div> <div class="mb-3"> <strong>Category:</strong> ${event.category.name} </div> <div class="mb-3"> <strong>Venue:</strong> ${event.venue} </div> <div class="mb-3"> <strong>Event Dates:</strong> ${new Date(event.eventStartDate).toDateString()} - ${new Date(event.eventEndDate).toDateString()} </div> <div class="mb-3"> <strong>Registration Dates:</strong> ${new Date(event.registerStartDate).toDateString()} - ${new Date(event.registerEndDate).toDateString()} </div> <div class="mb-3"> <strong>Description:</strong> ${event.description} </div> <div class="mb-3"> <strong>Organizer Name:</strong> ${event.organizerName} </div> <div class="mb-3"> <strong>Organizer Phone:</strong> ${event.organizerPhone} </div> <div class="mb-3"> <strong>Organizer Email:</strong> ${event.organizerMail} </div> <div class="mb-3"> <strong>Status:</strong> ${event.status} </div> </div> </div> </div>`;
//    document.querySelector('body').innerHTML = html;
//}
//
//
//
//function display(event) {
//  const html = `
//<div class="container mt-5">
//  <h1 class="mb-3">Event Details</h1>
//  <div class="row">
//    <div class="col-md-4 mb-3">
//      <img src="${event.posterPath}" alt="${event.name}" class="img-fluid" />
//    </div>
//    <div class="col-md-8">
//      <h2>${event.name}</h2>
//      <div class="mb-3">
//        <strong>Category:</strong> ${event.categoryName}
//      </div>
//      <div class="mb-3">
//        <strong>Venue:</strong> ${event.venue}
//      </div>
//      <div class="mb-3">
//        <strong>Event Dates:</strong> ${new Date(event.eventStartDate).toDateString()} - ${new Date(event.eventEndDate).toDateString()}
//      </div>
//      <div class="mb-3">
//        <strong>Registration Dates:</strong> ${new Date(event.registerStartDate).toDateString()} - ${new Date(event.registerEndDate).toDateString()}
//      </div>
//      <div class="mb-3">
//        <strong>Description:</strong> ${event.description}
//      </div>
//      <div class="mb-3">
//        <strong>Status:</strong> ${event.status}
//      </div>
//    </div>
//  </div>
//  
//  <hr>
//  
//  <div class="row mt-4 d-flex align-items-center">
//    <div class="col-md-8">
//      <h2>Organizer Details</h2>
//      <div class="mb-3">
//        <strong>Name:</strong> ${event.organizerName}
//      </div>
//      <div class="mb-3">
//        <strong>Phone:</strong> ${event.organizerPhone}
//      </div>
//      <div class="mb-3">
//        <strong>Email:</strong> ${event.organizerMail}
//      </div>
//    </div>
//    <div class="col-md-4 text-center">
//      <button type="button" class="btn btn-primary btn-lg">Book Now</button>
//    </div>
//</div>
//
//  
//</div>
//
//
//  `;
//  document.querySelector('body').innerHTML = html;
//}
//function display(event) {
//  const html = `
//<div class="container my-5">
//  <div class="row">
//    <div class="col-lg-5 mb-4 mb-lg-0">
//      <div class="card rounded-0 border-0 shadow h-100">
//        <img src="${event.posterPath}" alt="${event.name}" class="card-img-top rounded-0">
//        <div class="card-body">
//          <h2 class="card-title mb-4">Organizer Details</h2>
//          <div class="row mb-4">
//           
//              <p class="card-text"><i class="fas fa-user me-2"></i>${event.organizerName}</p>
//         
//              <p class="card-text"><i class="fas fa-phone me-2"></i>${event.organizerPhone}</p>
//        
//              <p class="card-text"><i class="far fa-envelope me-2"></i>${event.organizerMail}</p>
//     
//          </div>
//        </div>
//      </div>
//    </div>
//    <div class="col-lg-7">
//      <div class="card rounded-0 border-0 shadow h-100">
//        <div class="card-body">
//          <h1 class="card-title display-4 mb-4">${event.name}</h1>
//          <div class="row mb-4">
//            <div class="col-md-6 mb-3 mb-md-0">
//              <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i>${event.venue}</p>
//            </div>
//            <div class="col-md-6">
//              <p class="card-text"><i class="fas fa-tag me-2"></i>${event.categoryName}</p>
//            </div>
//          </div>
//          <div class="row">
//            <div class="col-md-6 mb-3 mb-md-0">
//              <p class="card-text"><i class="far fa-calendar-alt me-2"></i>${new Date(event.registerStartDate).toLocaleDateString()} - ${new Date(event.registerEndDate).toLocaleDateString()}</p>
//            </div>
//            <div class="col-md-6">
//              <p class="card-text"><i class="far fa-clock me-2"></i>${new Date(event.eventStartDate).toLocaleString([], {hour: '2-digit', minute:'2-digit'})} - ${new Date(event.eventEndDate).toLocaleString([], {hour: '2-digit', minute:'2-digit'})}</p>
//            </div>
//          </div>
//          <hr class="my-4">
//          <p class="card-text">${event.description}</p>
//          <hr class="my-4">
//        </div>
//      </div>
//    </div>
//  </div>
//</div>
//
//
//
//
//
//
//
//
//  `;
//  document.querySelector('body').innerHTML = html;
//}

function display(event) {
  const html = `
           <div class="container my-5">
            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="card rounded-0 border-0 shadow h-100">
                        <div class="card-body p-0">
                            <img src="${event.posterPath}" alt="${event.name}" class="img-fluid rounded-0 w-100 " >
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 border-end">
                                    <h4 class="card-title mb-3">Ticket Prices</h4>
                                    <p class="card-text"><i class="fas fa-star me-2"></i>VIP Ticket: RM ${event.vipTicketPrice}</p>
                                    <p class="card-text"><i class="fas fa-star-half-alt me-2"></i>Standard Ticket: RM ${event.standardTicketPrice}</p>
                                    <p class="card-text"><i class="fas fa-star-half me-2"></i>Budget Ticket: RM ${event.budgetTicketPrice}</p>

                                </div>


                                <div class="col-md-6 ps-4">
                                    <h4 class="card-title mb-3">Ticket Left</h4>
                                    <p class="card-text"><i class="fas fa-star me-2"></i>VIP: ${event.vipTicketQty}</p>
                                    <p class="card-text"><i class="fas fa-star-half-alt me-2"></i>Standard: ${event.standardTicketQty}</p>
                                    <p class="card-text"><i class="fas fa-star-half me-2"></i>Budget: ${event.budgetTicketQty}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card rounded-0 border-0 shadow h-100">
                        <div class="card-body">
                            <h1 class="card-title display-4 mb-4">${event.name}</h1>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i>${event.venue}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><i class="fas fa-tag me-2"></i>${event.categoryName}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <p class="card-text"><i class="far fa-calendar-alt me-2"></i>${new Date(event.registerStartDate).toLocaleDateString()} - ${new Date(event.registerEndDate).toLocaleDateString()}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><i class="far fa-clock me-2"></i>${new Date(event.eventStartDate).toLocaleString([], {hour: '2-digit', minute: '2-digit'})} - ${new Date(event.eventEndDate).toLocaleString([], {hour: '2-digit', minute: '2-digit'})}</p>
                                </div>
                            </div>
                            <hr class="my-4">
                            <p class="card-text">${event.description}</p>

                        </div>
                        <hr class="my-4 mx-4">
                        <div class="row d-flex m-3 mt-0 mb-4">
                                <h5 class="card-title mb-3 d-flex justify-content-between">Organizer Details 
                                <i class="fa-regular fa-heart fs-3" onclick="addToWishlist()"></i>
                                </h5>
                               
                            <div class="col-md-7">
                                <p class="card-text"><i class="fas fa-user me-2"></i>${event.organizerName}</p>
                                <p class="card-text"><i class="fas fa-phone me-2"></i>${event.organizerPhone}</p>
                                <p class="card-text"><i class="far fa-envelope me-2"></i>${event.organizerMail}</p>
                            </div>

                            <div class="col-md-5 d-flex justify-content-end align-items-end">
                                 <a href="../Booking/BookingCreate.php?eventId=${event.eventId}" class="btn btn-primary">Book Now </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
  `;

      $('.container').append(html);
}

