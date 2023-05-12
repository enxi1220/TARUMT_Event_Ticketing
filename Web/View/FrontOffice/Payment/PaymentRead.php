<?php
require '../../Layout.php';
?>
<!-- author: Ong Yi Chween -->

<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">View Payment</h2>
        </div>
    </div>
    <form>
        <!--Category information -->
        <div class="row mb-4">
            <fieldset class="mb-3 border p-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="txt-paymentNo">Invoice no. :</label>
                            <input type="text" name="Status" id="txt-paymentNo" minlength="150" class="form-control" readonly />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="txt-price">Total Price</label>
                            <input type="text" name="Status" id="txt-price" minlength="150" class="form-control" readonly />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="txt-method">Payment Method</label>
                            <input type="text" name="Status" id="txt-method" minlength="150" class="form-control" readonly />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="txt-date">Payment Date</label>
                            <input type="text" name="Status" id="txt-date" minlength="150" class="form-control" readonly />
                        </div>
                    </div>
                
            </fieldset>
        </div>
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

<script src="../../../Script/FrontOffice/Payment/PaymentRead.js" type="text/javascript"></script>