<?php
require '../../Layout.php';
?>
<!-- author: Ong Yi Chween -->

<section class="vh-100">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
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

                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <!-- Pills navs -->
                                <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Touch and Go</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Online Banking</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Credit Card</a>
                                    </li>
                                </ul>

                                <!-- Pills content -->
                                <div class="tab-content" id="ex1-content">
                                    <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                                        <div class="container-fluid px-1 px-md-2 px-lg-4 py-2 mx-auto">
                                            <!--                                                    <form class="needs-validation" novalidate>
                                                        <div class="form-outline mb-4">
                                                            <input type="cardName" id="form2Example17" class="form-control form-control-lg" required/>
                                                            <label class="form-label" for="txt-name">Card Holder Name *</label>
                                                            <div class="invalid-feedback">Required</div>
                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <input type="text" id="form2Example27" class="form-control form-control-lg" placeholder="0000 0000 0000 0000" required/>
                                                            <label class="form-label" for="txt-num">Card Number *</label>
                                                            <div class="invalid-feedback">Required</div>
                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <input type="text" id="form2Example27" class="form-control form-control-lg" placeholder="000" required/>
                                                            <label class="form-label" for="txt-sec">CVV *</label>
                                                            <div class="invalid-feedback">Required</div>
                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <input type="date" id="form2Example27" class="form-control form-control-lg" required/>
                                                            <label class="form-label" for="txt-date">Expiry Date *</label>
                                                            <div class="invalid-feedback">Required</div>
                                                        </div>
                                                        <div class="pt-1 mb-4">
                                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Place Order</button>
                                                        </div>
                                                    </form>-->
                                            <img id="img-poster" src="../../../Poster/qrcode.png" alt="qr code" class="img-fluid" style="display: block; margin: 0 auto; width: 300px; height: 300px;" />
                                            <p style="text-align: center;">Note: After completing the payment process, you will be redirected back to the website to view details of your order.</p>
                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="submitPayment('Touch N Go')">Place Order</button>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                        <div class="container-fluid px-1 px-md-2 px-lg-4 py-2 mx-auto">
                                            <div class="form-group">
                                                <label for="sort" class="p-2 px-md-2 control-label">Please select your bank</label>
                                                <div class="col-sm-14 px-md-2 mb-4">
                                                    <select class="form-control" name="sort" id="sort">
                                                        <option value=""></option>
                                                        <option value="">Affin Bank</option>
                                                        <option value="">Alliance Bank</option>
                                                        <option value="">AmBank</option>
                                                        <option value="">CIMB</option>
                                                        <option value="">Hong Leong Bank</option>
                                                        <option value="">Maybank</option>
                                                        <option value="">Public Bank</option>
                                                        <option value="">RHB Bank</option>
                                                    </select>
                                                </div>
                                                <div class="pt-1 mb-3">
                                                    <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="submitPayment('Online Banking')">Place Order</button>
                                                </div>
                                                <div class="p-5 col-sm-14 px-md-2">
                                                    <p>Note: After clicking on the button, you will be directed to a secure gateway for payment.
                                                        After completing the payment process, you will be redirected back to the website to view details of your order.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                        <div class="container-fluid px-1 px-md-2 px-lg-4 py-2 mx-auto">
                                            <form class="needs-validation" novalidate>
                                                <div class="form-outline mb-4">
                                                    <input type="cardName" id="form2Example17" class="form-control form-control-lg" required />
                                                    <label class="form-label" for="txt-name">Card Holder Name *</label>
                                                    <div class="invalid-feedback">Required</div>
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="text" id="form2Example27" class="form-control form-control-lg" placeholder="0000 0000 0000 0000" required />
                                                    <label class="form-label" for="txt-num">Card Number *</label>
                                                    <div class="invalid-feedback">Required</div>
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="text" id="form2Example27" class="form-control form-control-lg" placeholder="000" required />
                                                    <label class="form-label" for="txt-sec">CVV *</label>
                                                    <div class="invalid-feedback">Required</div>
                                                </div>

                                                <div class="form-outline mb-4">
                                                    <input type="date" id="form2Example27" class="form-control form-control-lg" required />
                                                    <label class="form-label" for="txt-date">Expiry Date *</label>
                                                    <div class="invalid-feedback">Required</div>
                                                </div>
                                                <div class="pt-1 mb-4">
                                                    <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="submitPayment('Credit Card')">Place Order</button>
                                                </div>
                                            </form>

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
</section>

<?php
require '../../Footer.php';
?>
<script src="../../../Script/FrontOffice/Payment/PaymentCreate.js" type="text/javascript"></script>