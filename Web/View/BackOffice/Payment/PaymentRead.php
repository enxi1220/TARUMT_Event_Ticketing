<?php
require '../../Layout.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
    $admin_id = $_SESSION['adminInfo']['admin_id'];
    $role = $_SESSION['adminInfo']['role'];
//    $loginUser = new LoginUser();
//    $loginUser->attach(new Event());
//    $loginUser->setLoginUser($adminName);
//    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
?>
<!-- author: Ong Wi Lin -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">View Payment</h2>
        </div>
    </div>
    <form>
        <!-- Payment Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-payment-no">Payment No</label>
                    <input type="text" name="PaymentNo" id="txt-payment-no" minlength="150" class="form-control" readonly />
                </div>
            </div>
<!--            <div class="col-md-6">
                <label class="form-label" for="txt-status">Status</label>
                <input type="text" name="Status" id="txt-status" minlength="150" class="form-control" readonly />
            </div>-->
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-payment-method">Payment Method</label>
                    <input type="text" name="PaymentMethod" id="txt-payment-method" minlength="150" class="form-control" readonly />
                </div>
            </div>
<!--            <div class="col-md-6">
                <label class="form-label" for="txt-category">Event Category</label>
                <input type="text" name="CategoryName" id="txt-category" minlength="150" class="form-control" readonly />
            </div>-->
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-total-price">Total Price</label>
                    <input type="text" name="TotalPrice" id="txt-total-price" minlength="150" class="form-control" readonly />
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-date-time">Date/Time</label>
                    <input type="text" name="DateTime" id="txt-date-time" minlength="150" class="form-control" readonly />
                </div>
            </div>
        </div>

        <!-- Payment Detail -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">User Details</legend>
            <div id="user-details"></div>

            <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-user-id">User ID</label>
                    <input type="text" name="txt-user-id" id="txt-user-id" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-user-name">Name</label>
                <input type="text" name="Name" id="txt-user-name" minlength="150" class="form-control" readonly />
            </div>
        </div>
            

            <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-user-mail">Email</label>
                    <input type="text" name="txt-user-mail" id="txt-user-mail" minlength="150" class="form-control" readonly />
                </div>
            </div>

        </div>
            
        </fieldset>
        

        <!-- Payment Detail -->
        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Payment Details</legend>
            <div id="user-details"></div>

            <div class="row mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="txt-event-id">Event ID</label>
                    <input type="text" name="txt-event-id" id="txt-event-id" minlength="150" class="form-control" readonly />
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="txt-event-no">Event No</label>
                <input type="text" name="Name" id="txt-event-no" minlength="150" class="form-control" readonly />
            </div>
        </div>
            

            <div class="row mb-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label" for="txt-event-name">Event Name</label>
                    <input type="text" name="txt-event-name" id="txt-event-name" minlength="150" class="form-control" readonly />
                </div>
            </div>

        </div>
            
        <div class="row mb-4" id="ticket-info">
<!--            <label class="form-label" for="txt-event-name">Ticket(s) Purchased</label>-->

        </div>

            
        </fieldset>
        

        <!-- Payment Detail -->
<!--        <fieldset class="mb-3 border p-3">
            <legend class="w-auto">Product Details</legend>
            <div id="product-details"></div>

                <div class="row mb-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="txt-venue">Venue</label>
                        <input type="text" name="Venue" id="txt-venue" class="form-control" minlength="100" readonly />
                    </div>
                </div>
            </div>-->
<!--        <div class="row mb-4">
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
            </div>-->
        <!--</fieldset>-->
        
        <!-- Action -->
        <div class="col d-flex justify-content-end mb-4">
            <a class="btn btn-secondary btn-floating float-end" title="Back" href="PaymentSummary.php" role="button">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </form>
</div>
<!----------------------- Modal ----------------------->
<!--<div class="modal fade " id="modal-show-poster" tabindex="-1" aria-labelledby="txt-modal-show-poster" aria-hidden="true">
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
</div>-->
<?php
require '../../Footer.php';
?>
<script src="../../../Script/BackOffice/Payment/PaymentRead.js"></script>
>
<style>
/*    body{
         background-color: rgba(33, 40, 50, 0.03);
    }*/
/*table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-left: 10px;
  margin-right: 10px;
  padding-right: 10px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}*/
table {
  border-collapse: collapse;
  width: 20%;
  margin: 0 auto; /* Centers the table horizontally */
  background-color: white;
}

th{
         background-color: rgba(33, 40, 50, 0.03);

/*    background-color: rgba(0, 0, 0, 0.1);
    color: white;*/
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

td:first-child {
  padding-right: 100px;
  /*text-align: right;*/
  width: 40%;
}

td:last-child {
/*  padding-right: 100px;*/
  /*text-align: right;*/
  width: 40%;
}

tr:nth-child(odd) {
  /*background-color: #dddddd;*/
           background-color: rgba(33, 40, 50, 0.03);

}

</style>