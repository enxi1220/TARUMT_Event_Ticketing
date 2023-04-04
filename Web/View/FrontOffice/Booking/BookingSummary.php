<?php
require '../../Layout.php';
?>
<!-- author: Lim En Xi -->
<div class="p-5 rounded-2">
    <div class="row">
        <div class="col">
            <h2 class="float-start mb-5">Booking History</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <!-- Tab navs -->
            <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-future-tab" data-mdb-toggle="pill" href="#v-pills-future" role="tab" aria-controls="v-pills-future" aria-selected="true">Future</a>
                <a class="nav-link" id="v-pills-past-tab" data-mdb-toggle="pill" href="#v-pills-past" role="tab" aria-controls="v-pills-past" aria-selected="false">Past</a>
            </div>
            <!-- Tab navs -->
        </div>

        <div class="col-9">
            <!-- Tab content -->
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-future" role="tabpanel" aria-labelledby="v-pills-future-tab">
                    <div class="row row-cols-1 row-cols-md-3 g-4" id="future">
                        <!-- loop content -->
                        <!-- end of loop content -->
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-past" role="tabpanel" aria-labelledby="v-pills-past-tab">
                    <div class="row row-cols-1 row-cols-md-3 g-4" id="past">
                        <!-- loop content -->
                        <!-- end of loop content -->
                    </div>
                </div>
            </div>
            <!-- Tab content -->
        </div>
    </div>
</div>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/FrontOffice/Booking/BookingSummary.js" type="text/javascript"></script>