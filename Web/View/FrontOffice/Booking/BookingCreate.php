<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<!-- Description: backend check quantity only go payment -->
<body>
<form id="form-add-booking" method="POST">
    <div class="container py-5 d-none">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col">
                <div class="card my-4 shadow-3">
                    <div class="row g-0">
                        <div class="col-md-5 bg-image">
                            <img id="img-poster" src="" alt="Event Poster" class="img-fluid" />
                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.7)">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="text-center">
                                        <i class="fas fa-calendar text-white fa-3x mb-3"></i>
                                        <p class="text-white title-style mb-0" id="txt-event-no"></p>
                                        <p class="text-white mb-0" id="txt-event-start"></p>
                                        <figure class="text-center mb-0">
                                            <blockquote class="blockquote text-white">
                                                <p class="pb-3">
                                                    <i class="fas fa-quote-left fa-xs text-primary" style="color: hsl(210, 100%, 50%) ;"></i>
                                                    <span class="lead font-italic" id="txt-name"></span>
                                                    <i class="fas fa-quote-right fa-xs text-primary" style="color: hsl(210, 100%, 50%) ;"></i>
                                                </p>
                                            </blockquote>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-4 text-uppercase">Booking Info</h3>
                                <!-- Quantity -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-vip-ticket-qty">VIP Ticket Quantity*</label>
                                            <input type="number" name="VIPTicketQuantity" id="txt-vip-ticket-qty" onchange="ticketChange()" min="0" class="form-control" tabindex="1"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-std-ticket-qty">Standard Ticket Quantity*</label>
                                            <input type="number" name="StandardfTicketQuantity" id="txt-std-ticket-qty" onchange="ticketChange()" min="0" class="form-control" tabindex="2"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-bgt-ticket-qty">Budget Ticket Quantity*</label>
                                            <input type="number" name="BudgetTicketQuantity" id="txt-bgt-ticket-qty" onchange="ticketChange()" min="0" class="form-control" tabindex="3"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- Price -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-vip-ticket-qty">VIP Ticket Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input type="text" name="VIPTicketPrice" id="txt-vip-ticket-price" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-std-ticket-price">Standard Ticket Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input type="text" name="StandardfTicketPrice" id="txt-std-ticket-price" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-bgt-ticket-price">Budget Ticket Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input type="text" name="BudgetTicketPrice" id="txt-bgt-ticket-price" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total Price -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="txt-total-ticket-price">Total Ticket Price</label>
                                            <div class="input-group">
                                                <div class="input-group-text">RM</div>
                                                <input type="text" class="form-control" id="txt-total-ticket-price" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-end pt-3 mt-3">
                                            <button type="submit" id="btn-place-order" class="btn btn-primary ms-2 disabled" tabindex="4">Place order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/FrontOffice/Booking/BookingCreate.js" type="text/javascript"></script>
</body>
