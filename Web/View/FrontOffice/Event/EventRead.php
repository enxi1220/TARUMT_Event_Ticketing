<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Details</title>

    </head>
    <body>

        <!--        <div class="container my-5">
                    <h1 class="mb-4 text-center display-4">Event Details</h1>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <img src="${event.posterPath}" alt="${event.name}" class="img-fluid" />
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-4">${event.name}</h2>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Event Details</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">
                                        <strong>Category:</strong> ${event.categoryName}
                                    </p>
                                    <p class="card-text">
                                        <strong>Venue:</strong> ${event.venue}
                                    </p>
                                    <p class="card-text">
                                        <strong>Event Dates:</strong> ${new Date(event.eventStartDate).toDateString()} - ${new Date(event.eventEndDate).toDateString()}
                                    </p>
                                    <p class="card-text">
                                        <strong>Registration Dates:</strong> ${new Date(event.registerStartDate).toDateString()} - ${new Date(event.registerEndDate).toDateString()}
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Event Description</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">${event.description}</p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Organizer Details</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">
                                        <strong>Name:</strong> ${event.organizerName}
                                    </p>
                                    <p class="card-text">
                                        <strong>Phone:</strong> ${event.organizerPhone}
                                    </p>
                                    <p class="card-text">
                                        <strong>Email:</strong> ${event.organizerMail}
                                    </p>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

        <!--        <div class="container my-5">
                    <h1 class="mb-4 text-center display-4">Event Details</h1>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <img src="${event.posterPath}" alt="${event.name}" class="img-fluid" />
                             <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Organizer Details</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">
                                        <strong>Name:</strong> ${event.organizerName}
                                    </p>
                                    <p class="card-text">
                                        <strong>Phone:</strong> ${event.organizerPhone}
                                    </p>
                                    <p class="card-text">
                                        <strong>Email:</strong> ${event.organizerMail}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-4">${event.name}</h2>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Event Details</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">
                                        <strong>Category:</strong> ${event.categoryName}
                                    </p>
                                    <p class="card-text">
                                        <strong>Venue:</strong> ${event.venue}
                                    </p>
                                    <p class="card-text">
                                        <strong>Event Dates:</strong> ${new Date(event.eventStartDate).toDateString()} - ${new Date(event.eventEndDate).toDateString()}
                                    </p>
                                    <p class="card-text">
                                        <strong>Registration Dates:</strong> ${new Date(event.registerStartDate).toDateString()} - ${new Date(event.registerEndDate).toDateString()}
                                    </p>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Event Description</h5>
                                    <hr class="my-4" />
                                    <p class="card-text">${event.description}</p>
                                </div>
                            </div>
                           
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
        <!--        <div class="container my-5">
                    <div class="row">
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <div class="card rounded-0 border-0 shadow h-100">
                                <div class="card-body p-0">
                                    <img src="${event.posterPath}" alt="${event.name}" class="img-fluid rounded-0">
                                </div>
                            </div>
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
        
                        <div class="col-lg-7">
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
                                            <p class="card-text"><i class="far fa-clock me-2"></i>${new Date(event.eventStartDate).toLocaleString([], {hour: '2-digit', minute:'2-digit'})} - ${new Date(event.eventEndDate).toLocaleString([], {hour: '2-digit', minute:'2-digit'})}</p>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <p class="card-text">${event.description}</p>
        
                                </div>
                                <hr class="my-4 mx-4">
                                <div class="row d-flex align-items-end m-3 mt-0 mb-4">
                                    <div class="col-md-7">
                                        <h5 class="card-title mb-3">Organizer Details</h5>
                                        <p class="card-text"><i class="fas fa-user me-2"></i>${event.organizerName}</p>
                                        <p class="card-text"><i class="fas fa-phone me-2"></i>${event.organizerPhone}</p>
                                        <p class="card-text"><i class="far fa-envelope me-2"></i>${event.organizerMail}</p>
                                    </div>
        
                                    <div class="col-md-5 d-flex justify-content-end align-items-end">
                                        <button class="btn btn-primary">Book Now</button>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->


    </body>
    <?php
    require '../../Footer.php';
    ?>
    <script src="../../../Script/FrontOffice/Event/EventRead.js"></script>
</html>