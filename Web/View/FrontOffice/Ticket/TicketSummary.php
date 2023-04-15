<?php
require '../../Layout.php';
?>
<!-- author: Tan Lin Yi -->
<section class="h-100">
    <div class="container h-100 p-5">
            <!-- Tab conteant -->
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-future" role="tabpanel" aria-labelledby="v-pills-future-tab">
                    <div class="row d-flex justify-content-center " id="future">
                        <h3 class="fw-normal mb-0 text-black mb-3 ms-5 ps-5">Ticket History</h3>
                        <!-- loop content -->
                        <!-- end of loop content -->

                        
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-past" role="tabpanel" aria-labelledby="v-pills-past-tab">
                    <div class="row " id="past">
                        <!-- loop content -->
                        <!-- end of loop content -->
                    </div>
                </div>
            </div>
            <!-- Tab content -->

    </div>
</section>
<?php
require '../../Footer.php';
?>
<script src="../../../Script/FrontOffice/Ticket/TicketSummary.js" type="text/javascript"></script>