<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">View Event</h2>
        </div>
    </div>
    <form>
        <!-- Event Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-event-no">Event No</label>
                    <input type="text" name="EventNo" id="txt-event-no" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-status">Status</label>
                <input type="text" name="Status" id="txt-status" minlength="150" class="form-control" readonly />
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-name">Event Name</label>
                    <input type="text" name="Name" id="txt-name" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-category">Event Category</label>
                <input type="text" name="CategoryName" id="txt-category" minlength="150" class="form-control" readonly />
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-description">Description</label>
                    <textarea type="text" id="txt-description" name="Description" minlength="255" class="form-control" rows="3" readonly></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-poster">Poster</label>
                    <input type="text" id="txt-poster" name="Poster" class="form-control" readonly />
                </div>
            </div>

        </div>

        <!-- Event Detail -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Event Detail</legend>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="txt-venue">Venue</label>
                        <input type="text" name="Venue" id="txt-venue" class="form-control" minlength="100" readonly />
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-reg-start">Register Start Date</label>
                        <input type="datetime-local" name="RegisterStartDate" id="date-reg-start" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-reg-end">Register End Date</label>
                        <input type="datetime-local" name="RegisterEndDate" id="date-reg-end" class="form-control" readonly />
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-event-start">Event Start Date</label>
                        <input type="datetime-local" name="EventStartDate" id="date-event-start" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-event-end">Event End Date</label>
                        <input type="datetime-local" name="EventEndDate" id="date-event-end" class="form-control" readonly />
                    </div>
                </div>
            </div>
        </fieldset>
        <!-- Ticket Information -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Ticket Information</legend>
            <!-- Price -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-vip-ticket-price">VIP Ticket Price</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="text" class="form-control" id="txt-vip-ticket-price" readonly />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-std-ticket-price">Standard Ticket Price</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="text" name="StandardfTicketPrice" id="txt-std-ticket-price" class="form-control" readonly />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-bgt-ticket-price">Budget Ticket Price</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="text" name="BudgetTicketPrice" id="txt-bgt-ticket-price" class="form-control" readonly />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quantity -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-vip-ticket-qty">VIP Ticket Quantity</label>
                        <input type="number" name="VIPTicketQuantity" id="txt-vip-ticket-qty" min="1" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-std-ticket-qty">Standard Ticket Quantity</label>
                        <input type="number" name="StandardfTicketQuantity" id="txt-std-ticket-qty" min="1" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-bgt-ticket-qty">Budget Ticket Quantity</label>
                        <input type="number" name="BudgetTicketQuantity" id="txt-bgt-ticket-qty" min="1" class="form-control" readonly />
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Organizer Information -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Organizer Information</legend>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-organizer-name">Organizer Name</label>
                        <input type="text" name="OrganizerName" id="txt-organizer-name" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-organizer-phone">Organizer Phone</label>
                        <input type="phone" name="OrganizerPhone" id="txt-organizer-phone" class="form-control" readonly />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-organizer-mail">Organizer Email</label>
                        <input type="mail" name="OrganizerMail" id="txt-organizer-mail" class="form-control" readonly />
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </form>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Event/EventRead.js"></script>