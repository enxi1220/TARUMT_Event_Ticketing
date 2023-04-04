<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Update Event</h2>
        </div>
    </div>
    <form id="form-edit-event" class="needs-validation" novalidate method="POST">
        <!-- Event Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-event-no">Event No</label>
                    <input type="text" name="EventNo" id="txt-event-no" minlength="150" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="drop-down-status">Status*</label>
                <select class="form-outline form-control" id="drop-down-status" name="Status" required>
                    <option disable selected hidden></option>
                </select>
                <div class="invalid-feedback">Required</div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-name">Event Name*</label>
                    <input type="text" name="Name" id="txt-name" maxlength="150" class="form-control" required />
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="drop-down-category">Event Category*</label>
                <select class="form-outline form-control" id="drop-down-category" name="Category" required>
                    <option disable selected hidden></option>
                    <!-- todo: rm cat hardcode -->
                    <option value="1">Festival</option>
                    <option value="2">Competition</option>
                </select>
                <div class="invalid-feedback">Required</div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-description">Description*</label>
                    <textarea type="text" id="txt-description" name="Description" maxlength="255" class="form-control" rows="3" required></textarea>
                    <div class="invalid-feedback">Required</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-poster">Poster*</label>
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-primary" type="button" id="btn-show-poster" data-mdb-ripple-color="dark" data-mdb-toggle="modal" data-mdb-target="#modal-show-poster">
                            Initial Preview
                        </button>
                        <input type="file" id="txt-poster" name="Poster" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Detail -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Event Detail</legend>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="txt-venue">Venue*</label>
                        <input type="text" name="Venue" id="txt-venue" class="form-control" maxlength="100" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-reg-start">Register Start Date*</label>
                        <input type="datetime-local" name="RegisterStartDate" id="date-reg-start" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-reg-end">Register End Date*</label>
                        <input type="datetime-local" name="RegisterEndDate" id="date-reg-end" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-event-start">Event Start Date*</label>
                        <input type="datetime-local" name="EventStartDate" id="date-event-start" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="date-event-end">Event End Date*</label>
                        <input type="datetime-local" name="EventEndDate" id="date-event-end" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
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
                        <label class="form-label" for="txt-vip-ticket-price">VIP Ticket Price*</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="number" class="form-control" id="txt-vip-ticket-price" step=".01" pattern="^\d*(\.\d{0,2})?$" required />
                            <div class="invalid-feedback">Required with optional up to 2 decimal places</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-std-ticket-price">Standard Ticket Price*</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="number" name="StandardfTicketPrice" id="txt-std-ticket-price" step=".01" pattern="^\d*(\.\d{0,2})?$" class="form-control" required />
                            <div class="invalid-feedback">Required with optional up to 2 decimal places</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-bgt-ticket-price">Budget Ticket Price*</label>
                        <div class="input-group">
                            <div class="input-group-text">RM</div>
                            <input type="number" name="BudgetTicketPrice" id="txt-bgt-ticket-price" step=".01" pattern="^\d*(\.\d{0,2})?$" class="form-control" required />
                            <div class="invalid-feedback">Required with optional up to 2 decimal places</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quantity -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-vip-ticket-qty">VIP Ticket Quantity</label>
                        <input type="number" name="VIPTicketQuantity" id="txt-vip-ticket-qty" class="form-control" disabled />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-std-ticket-qty">Standard Ticket Quantity</label>
                        <input type="number" name="StandardfTicketQuantity" id="txt-std-ticket-qty" class="form-control" disabled />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-bgt-ticket-qty">Budget Ticket Quantity</label>
                        <input type="number" name="BudgetTicketQuantity" id="txt-bgt-ticket-qty" class="form-control" disabled />
                        <div class="invalid-feedback">Required</div>
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
                        <label class="form-label" for="txt-organizer-name">Organizer Name*</label>
                        <input type="text" name="OrganizerName" id="txt-organizer-name" class="form-control" required />
                        <div class="invalid-feedback">Required</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-organizer-phone">Organizer Phone*</label>
                        <input type="phone" name="OrganizerPhone" id="txt-organizer-phone" pattern="^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" class="form-control" required />
                        <div class="invalid-feedback">Required with Malaysia phone number format ie. 0123456789</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="txt-organizer-mail">Organizer Email*</label>
                        <input type="mail" name="OrganizerMail" id="txt-organizer-mail" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,10}$" class="form-control" required />
                        <div class="invalid-feedback">Required with valid email address</div>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="EventSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <button type="submit" class="btn btn-primary btn-floating ms-4" title="Save">
                <i class="fas fa-floppy-disk"></i>
            </button>
        </div>
    </form>
</div>
<!----------------------- Modal ----------------------->
<div class="modal fade " id="modal-show-poster" tabindex="-1" aria-labelledby="txt-modal-show-poster" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="txt-modal-show-poster">Image Preview</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="img-poster" src="" class="img-fluid" alt="Event poster" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Event/EventUpdate.js"></script>