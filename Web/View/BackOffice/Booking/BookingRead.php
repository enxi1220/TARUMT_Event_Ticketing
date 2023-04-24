<?php
require '../../Layout.php';
?>
<!-- author: Vinnie Chin Loh Xin -->
<div class="mx-5 p-4">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-4">View Booking</h2>
        </div>
          <div class="col d-flex justify-content-end mb-4">
        <a class="btn btn-secondary btn-floating float-end" title="Back" href="BookingSummary.php" role="button">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>
    </div>
    <!-- Booking Information -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="txt-booking-no">Booking No</label>
            <input type="text" id="txt-booking-no" minlength="150" class="form-control" readonly />

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="txt-status">Booking Date</label>
            <input type="text" name="Status" id="txt-booking-date" minlength="150" class="form-control" readonly />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="txt-participant">Booked By</label>
            <input type="text" name="Status" id="txt-participant" minlength="150" class="form-control" readonly />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="txt-phone">Participant Contact</label>
            <input type="text" name="Status" id="txt-phone" minlength="150" class="form-control" readonly />
        </div>
    </div>



    <fieldset class="my-3 border p-3">
        <legend class="w-auto">Ticket Booked</legend>
        <!-- Price -->
        <div class="ticket-booked">
            <!--loop-->
            
        </div>


    </fieldset>

    <!-- Event Detail -->
    <fieldset class="mb-3 border p-3">
        <legend class="w-auto">Event Booked</legend>

        <div class="row mb-4 mx-5 px-5">
            <div class="col-md-4 d-flex justify-content-center">

                
                <img id="event-poster" class="img-fluid rounded-0 w-50" style="object-fit: cover;">

            </div>


            <div class="col-md-8">
                
                    <h3 id="booking-event-no" class="mb-2"></h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="txt-event-name">Event Name</label>
                        <input type="text" name="eventName" id="txt-event-name" minlength="150" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="txt-event-venue">Venue</label>
                        <input type="text" name="Venue" id="txt-event-venue" class="form-control" minlength="100" readonly />
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="txt-event-start">Start Date</label>
                        <input type="text" name="Status" id="txt-event-start" minlength="150" class="form-control" readonly />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="txt-event-end">End Date</label>
                        <input type="text" name="Venue" id="txt-event-end" class="form-control" minlength="100" readonly />
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

  
</div>

<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Booking/BookingRead.js"></script>