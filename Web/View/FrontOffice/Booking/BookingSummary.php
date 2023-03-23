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
                <a class="nav-link" id="v-pills-all-tab" data-mdb-toggle="pill" href="#v-pills-all" role="tab" aria-controls="v-pills-all" aria-selected="false">All</a>
            </div>
            <!-- Tab navs -->
        </div>

        <div class="col-9">
            <!-- Tab content -->
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-future" role="tabpanel" aria-labelledby="v-pills-future-tab">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <!-- loop content -->
                        <div class="col">
                            <div class="card h-100">
                                <img src="../../../Poster/i.jpg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <div class="card-body">
                                    <h5 class="card-title" id="txt-booking-no">BKG/2303/00001</h5>
                                    <p class="card-text">
                                        EVT/2303/00001
                                        Voice Of Rahman
                                    </p>
                                    <p class="card-text">
                                        <i class="fas fa-location-dot"></i>
                                        <span class="p-2">Arte S Condo</span>
                                    </p>
                                    <p class="card-text">
                                        <i class="fas fa-clock"></i>
                                        <span class="p-2">28/03/2023 12:00</span>
                                    </p>
                                    <p class="card-text float-end">
                                        <a class="btn btn-primary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?bookingId=" role="button">
                                            <i class="fas fa-ticket"></i>
                                        </a>
                                        <a class="btn btn-primary btn-floating" title="View Payment" href="../Payment/PaymentRead.php?bookingId=" role="button">
                                            <i class="fas fa-dollar-sign"></i>
                                        </a>
                                        <a class="btn btn-primary btn-floating" title="View Event" href="../Event/PaymentRead.php?eventId=" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end of loop content -->
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-past" role="tabpanel" aria-labelledby="v-pills-past-tab">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <!-- loop content -->
                        <div class="col">
                            <div class="card h-100">
                                <img src="../../../Poster/i.jpg" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                <div class="card-body">
                                    <h5 class="card-title" id="txt-booking-no">BKG/2303/00002</h5>
                                    <p class="card-text">
                                        EVT/2303/00002
                                        Game Development
                                    </p>
                                    <p class="card-text">
                                        <i class="fas fa-location-dot"></i>
                                        <span class="p-2">Dewan Utama</span>
                                    </p>
                                    <p class="card-text">
                                        <i class="fas fa-clock"></i>
                                        <span class="p-2">28/03/2023 12:00</span>
                                    </p>
                                    <p class="card-text float-end">
                                        <a class="btn btn-primary btn-floating" title="View Ticket" href="../Ticket/TicketSummary.php?bookingId=" role="button">
                                            <i class="fas fa-ticket"></i>
                                        </a>
                                        <a class="btn btn-primary btn-floating" title="View Payment" href="../Payment/PaymentView.php?bookingId=" role="button">
                                            <i class="fas fa-dollar-sign"></i>
                                        </a>
                                        <a class="btn btn-primary btn-floating" title="View Event" href="../Event/EventView.php?eventId=" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end of loop content -->
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">

                </div>
            </div>
            <!-- Tab content -->
        </div>
    </div>
</div>
<?php
require '../../Footer.php';
?>