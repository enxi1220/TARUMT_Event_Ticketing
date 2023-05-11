<?php
//session_start();
//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/LoginUser.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/TARUMT_Event_Ticketing/Model/Event.php";
require '../../BackOfficeLayout.php';

if(isset($_SESSION['adminInfo'])) {
    $adminName = $_SESSION['adminInfo']['name'];
    $admin_id = $_SESSION['adminInfo']['admin_id'];
    $role = $_SESSION['adminInfo']['role'];
    $loginUser = new LoginUser();
    $loginUser->attach(new Event());
    $loginUser->setLoginUser($adminName);
    
}else{
    header('Location: ../Admin/AdminLogin.php');
    exit;
}
?>


<!-- author: Ong Wi Lin -->
<?php
    require 'chart/data.php';
    ?>
<head>
    
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  
  

</head>
<body>

  <div class="container-scroller">


    <!-- partial -->
    <div class="container-fluid page-body-wrapper" style="margin-top: -60px;">
     
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="BackOfficeDashboard.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/AdminSummary.php">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Admin</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Booking/BookingSummary.php">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Booking</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Category/CategorySummary.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Category</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Event/EventSummary.php">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Event</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
<!--          <li class="nav-item">
            <a class="nav-link" href="../Participant/ParticipantSummary.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Participant</span>
              <i class="menu-arrow"></i>
            </a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="../Payment/PaymentSummary.php">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Payment</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Admin/AdminProfile.php">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Profile</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?php echo $adminName; ?> !</h3>

<!--                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>-->
                </div>
              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <!--<img src="images/dashboard/people.svg" alt="people">-->
                  <!--<img src="https://images.unsplash.com/photo-1594003715326-f6030861574e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c2NlbmVyeSUyMHdhbGxwYXBlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=600&q=60" alt="scenery">-->
                    <img src="https://images.unsplash.com/photo-1594003715326-f6030861574e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c2NlbmVyeSUyMHdhbGxwYXBlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=600&q=60" alt="scenery" style="margin-top: -30px;">

                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <div id="dynamicDate" style="font-size: 40px; font-weight: bold; letter-spacing: 6px; margin-top: 15px; line-height: 2.5em; color:white; margin-right:60px">  </div>
                        <div id="dynamicTime" style="font-size: 25px; font-weight: bold; letter-spacing: 6px; margin-top: 5px; line-height: 2.5em; color:white; "></div>
                        <!--<div class="mb-0 font-weight-normal" id="date" style="font-size: 20px; font-weight: bold;"></div>-->
                        <!--<h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>-->
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <!--<div class="col-md-7 grid-margin transparent">-->
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Today’s Income</p>
                      <p class="fs-30 mb-2" style="text-align: center;">RM <?php echo $incomeArray[0]['today_sum']; ?></p>
                      <!--<p>10.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Current Year Income</p>
                      <p class="fs-30 mb-2" style="text-align: center;">RM <?php echo $incomeArray[0]['current_year_sum']; ?></p>
                      <!--<p>22.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Today's Tickets Sold</p>
                      <p class="fs-30 mb-2" style="text-align: center;"><?php echo $ticketSoldArray[0]['today_ticket_sold']; ?></p>
                      <!--<p>2.00% (30 days)</p>-->
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Tickets Sold</p>
                      <p class="fs-30 mb-2" style="text-align: center;"><?php echo $ticketSoldArray[0]['current_year_ticket_sold']; ?></p>
<!--                      <p>0.22% (30 days)</p>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Order Details</p>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Order value</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Orders</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Users</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Downloads</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div> 
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>-->
<!--            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">Sales Report</p>
                  <a href="#" class="text-info">View all</a>
                 </div>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>-->
          </div>
          
          
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner">
<!--                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Detailed Reports</p>
                              <h1 class="text-primary">$54040</h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary">When to When </h3>
                              <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                              
                            </div>  
                            </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                    <tr>
                                      <td class="text-muted">Illinois</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Washington</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Mississippi</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">California</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Maryland</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Alaska</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                <canvas id="north-america-chart"></canvas>
                                <div id="north-america-legend"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>-->
                      <div class="carousel-item">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Most Popular Event</p>
<!--                            <img src="chart/1stPrize.jpg" alt="1st Prize" style="height: 10%; ">
                              <h3 class="text-primary">adgdf</h3>-->
                            </div>  
                            </div>

                          <div class="col-md-12 col-xl-9">
                                                           <?php require 'chart/MostPopularEventReport.php'; ?>

<!--                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                       <?php foreach($names as $key => $value) { ?>
                                    <tr>
                                      <td class="text-muted"><?php echo $value; ?></td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $bookingCount[$key]/$totalBookingCount *100 ?>" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0"><?php echo $bookingCount[$key]?></h5></td>
                                    </tr>
                                    <?php } ?>

                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                <canvas id="north-america-chart"></canvas>
                                  <canvas id="mostPopEventChart" width="350" height="350"></canvas>
                                  <button onclick="downloadPDF()">PDF Version</button>
                                <div id="north-america-legend"></div>
                              </div>
                            </div>-->
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="row">
                          <!--<div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">-->
                            <!--<div class="ml-xl-4 mt-3">-->
                            <p class="card-title" style="margin-left:3px;">  Available / Remaining Event Tickets</p>
<!--                              <h1 class="text-primary">$34040</h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                              <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>-->
                            <!--</div>-->  
                            <!--</div>-->
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                                <div class="col-md-6 border-right" style="width: 120%">
                                <div class="table-responsive mb-3 mb-md-0 mt-3"  style="width: 200%">
<!--                                  <table class="table table-borderless report-table">
                                    <tr>
                                      <td class="text-muted">Illinois</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Washington</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Mississippi</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">California</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Maryland</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Alaska</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">-->
                                <!--<canvas id="south-america-chart"></canvas>-->
                                  <?php
                                    require 'chart/DoughnutChart.php';
                                    ?>
                                <div id="south-america-legend"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                        <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Sales Reports</p>
                        <?php
                            require 'chart/BarChartData.php';
                        ?>
                            <h2 class="text-primary">RM <?php echo $ttlPrice7days; ?></h2>

                            <?php
                                // Get the current date
                                $currentDate = new DateTime();

                                // Create a DateInterval object for 7 days
                                $interval = new DateInterval('P7D');

                                // Clone the current date and subtract the interval to get the date of 7 days ago
                                $sevenDaysAgo = clone $currentDate;
                                $sevenDaysAgo->sub($interval);

                                // Format the dates in Y-m-d format
                                $currentDateFormatted = $currentDate->format('Y-m-d');
                                $sevenDaysAgoFormatted = $sevenDaysAgo->format('Y-m-d');

                                // Output the dates
//                                echo "Current Date: " . $currentDateFormatted . "<br>";
//                                echo "Seven Days Ago: " . $sevenDaysAgoFormatted;
//                                echo $currentDateFormatted." - ".$sevenDaysAgoFormatted;
                                ?>
                              <br>
                                <h4 class="font-weight-500 mb-xl-4 text-primary">  Total Income From : </h4>
                                
                                            
                                <h6 class="font-weight-500 mb-xl-4 text-primary"><?php echo $sevenDaysAgoFormatted." - ".$currentDateFormatted; ?></h6>

                                <!--<p class="mb-2 mb-xl-0"><?php // echo $currentDateFormatted." - ".$sevenDaysAgoFormatted; ?></p>-->                              
                                <!--<p class="mb-2 mb-xl-0">2023 - 2023</p>-->
                            </div>  
                            </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
<!--                                    <tr>
                                      <td class="text-muted">Illinois</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Washington</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Mississippi</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">California</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Maryland</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Alaska</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>-->
                                      
                                      
<!--                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">-->

                                <!--<canvas id="south-america-chart"></canvas>-->
                                <!--<canvas id="myChart"></canvas>-->
                                  <?php
                                    require 'chart/BarChart.php';
                                    ?>
                                <div id="south-america-legend"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
<!--            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top Products</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>  
                      </thead>
                      <tbody>
                        <tr>
                          <td>Search Engine Marketing</td>
                          <td class="font-weight-bold">$362</td>
                          <td>21 Sep 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>
                        <tr>
                          <td>Search Engine Optimization</td>
                          <td class="font-weight-bold">$116</td>
                          <td>13 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>
                        <tr>
                          <td>Display Advertising</td>
                          <td class="font-weight-bold">$551</td>
                          <td>28 Sep 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Pay Per Click Advertising</td>
                          <td class="font-weight-bold">$523</td>
                          <td>30 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>E-Mail Marketing</td>
                          <td class="font-weight-bold">$781</td>
                          <td>01 Nov 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-danger">Cancelled</div></td>
                        </tr>
                        <tr>
                          <td>Referral Marketing</td>
                          <td class="font-weight-bold">$283</td>
                          <td>20 Mar 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Social media marketing</td>
                          <td class="font-weight-bold">$897</td>
                          <td>26 Oct 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>-->
<!--            <div class="col-md-5 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">To Do Lists</h4>
									<div class="list-wrapper pt-2">
										<ul class="d-flex flex-column-reverse todo-list todo-list-custom">
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Meeting with Urban Team
													</label>
												</div>
												<i class="remove ti-close"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" checked>
														Duplicate a project for new customer
													</label>
												</div>
												<i class="remove ti-close"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Project meeting with CEO
													</label>
												</div>
												<i class="remove ti-close"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" checked>
														Follow up of team zilla
													</label>
												</div>
												<i class="remove ti-close"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox">
														Level up for Antony
													</label>
												</div>
												<i class="remove ti-close"></i>
											</li>
										</ul>
                  </div>
                  <div class="add-items d-flex mb-0 mt-2">
										<input type="text" class="form-control todo-list-input"  placeholder="Add new task">
										<button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent"><i class="icon-circle-plus"></i></button>
									</div>
								</div>
							</div>
            </div>-->
          <!--</div>-->
          <div class="row" >
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card"  style="background-color: rgba(33, 40, 50, 0.03)">
                <div class="card-body" >
                  <p class="card-title mb-0">Preferred Payment</p>
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Payment Method</th>
                          <th class="border-bottom pb-2">Count</th>
                          <!--<th class="border-bottom pb-2">Users</th>-->
                        </tr>
                      </thead>
                      <tbody>
                         
                        <?php foreach($payment_type as $key => $value) { ?>
                        <tr>
                          <td class="pl-0"><?php echo $value ?></td>
                          <td><p class="mb-0"><span class="font-weight-bold mr-2"><?php echo $payment_count[$key] ?></span>(<?php echo number_format($payment_count[$key] / $totalPaymentCount * 100, 2)?>%)</p></td>
                          <!--<td class="text-muted">65</td>-->
                        </tr>
                        <?php } ?>

                      <hr>
                        <tr>
                          <td class="pl-0">Total : </td>
                          <td><p class="mb-0"><span class="font-weight-bold mr-2"><?php echo $totalPaymentCount ?></span></p></td>
                          <!--<td class="text-muted">65</td>-->
                        </tr>
    
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-md-4 stretch-card grid-margin" style="width:800px">
              <div class="row">

                  <!--<div class="col-md-12 grid-margin stretch-card">-->
                <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                  <div class="card"  style="background-color: rgba(33, 40, 50, 0.03)">
                    <div class="card-body">
                      <p class="card-title">Number of Admin/Staff</p>
                      <div class="charts-data">
                          
                         
                       <?php foreach($role as $key => $value) { ?>
                        <div class="mt-3">
                          <p class="mb-0"><?php echo $value ?></p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: <?php echo $roleCount[$key]/$totalRoleCount *100 ?>" aria-valuenow="<?php echo $roleCount[$key]/$totalRoleCount *100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0"><?php echo $roleCount[$key] ?></p>
                          </div>
                        </div>
                       <?php } ?>
                          
                        <div class="mt-3">
                          <p class="mb-0">Total : </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width:<?php echo $totalRoleCount/$totalRoleCount*100 ?>" aria-valuenow="<?php echo $totalRoleCount/$totalRoleCount*100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                              <hr>
                            <p class="mb-0" style="font-weight: bold;"><?php echo $totalRoleCount ?></p>
                          </div>
                        </div>

                      </div>
                      
                      
                       <div style="border-top: 0.5px solid grey; margin-top : 30px; margin-bottom : 30px;"></div>

                      
                      <p class="card-title">Number of User</p>

                      
                      <div class="charts-data">
                          
                         
                       <?php // foreach($totalUserCount as $key => $value) { ?>
<!--                        <div class="mt-3 invisible" >
                          <p class="mb-0">Total Number Of Users</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: <?php echo $totalUserCount ?>" aria-valuenow="<?php echo $totalUserCount?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0"><?php echo $totalUserCount?></p>
                          </div>
                        </div>-->
                       <?php // } ?>
                          
                        <div class="mt-3">
                          <p class="mb-0">Total no of users : </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width:<?php echo $totalUserCount?>" aria-valuenow="<?php echo $totalUserCount?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                              <hr>
                            <p class="mb-0" style="font-weight: bold;"><?php echo $totalUserCount ?></p>
                          </div>
                        </div>

                          
                          
                      </div>  
                    </div>
                  </div>
                </div>
                  
                  <div class="col-md-12 stretch-card grid-margin grid-margin-md-0 invisible">
                  <div class="card data-icon-card-primary">
                    <div class="card-body">
                      <p class="card-title text-white">Number of Meetings</p>                      
<!--                      <div class="row">
                        <div class="col-8 text-white">
                          <h3>34040</h3>
                          <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
                        </div>
                        <div class="col-4 background-icon">
                        </div>
                      </div>-->
                    </div>
                  </div>
                </div>
                  
                  
                  
<!--                <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                  <div class="card data-icon-card-primary">
                    <div class="card-body">
                      <p class="card-title text-white">Number of Meetings</p>                      
                      <div class="row">
                        <div class="col-8 text-white">
                          <h3>34040</h3>
                          <p class="text-white font-weight-500 mb-0">The total number of sessions within the date range.It is calculated as the sum . </p>
                        </div>
                        <div class="col-4 background-icon">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>-->
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card">
                  <div class="col-md-12 grid-margin stretch-card">
                  <div class="card"  style="background-color: rgba(33, 40, 50, 0.03)">
                    <div class="card-body">
                      <p class="card-title">Status of Users</p>
                      <div class="charts-data">
                          
                         
                       <?php foreach($userStatus as $key => $value) { ?>
                        <div class="mt-3">
                          <p class="mb-0"><?php echo $value ?></p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $user_status_count[$key]/$totalUserStatusCount *100 ?>" aria-valuenow="<?php echo $user_status_count[$key]/$totalUserStatusCount *100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0"><?php echo $user_status_count[$key] ?></p>
                          </div>
                        </div>
                       <?php } ?>
                          
                        <div class="mt-3">
                          <p class="mb-0">Total : </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-warning" role="progressbar" style="width:<?php echo $totalUserStatusCount/$totalUserStatusCount *100 ?>" aria-valuenow="<?php echo $totalUserStatusCount/$totalUserStatusCount *100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                              <hr>
                            <p class="mb-0" style="font-weight: bold;"><?php echo $totalUserStatusCount ?></p>
                          </div>
                        </div>
                         
                          <!--no of admin status-->
                          <div style="border-top: 0.5px solid grey; margin-top : 30px; margin-bottom : 30px;"></div>

                          <p class="card-title" style="margin-top : 30px;">Status of Admin / Staff</p>

                       <?php foreach($adminStatus as $key => $value) { ?>
                        <div class="mt-3">
                          <p class="mb-0"><?php echo $value ?></p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $admin_status_count[$key]/$totalAdminStatusCount *100 ?>" aria-valuenow="<?php echo $admin_status_count[$key]/$totalAdminStatusCount *100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0"><?php echo $admin_status_count[$key] ?></p>
                          </div>
                        </div>
                       <?php } ?>
                          
                        <div class="mt-3">
                          <p class="mb-0">Total : </p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-danger" role="progressbar" style="width:<?php echo $totalAdminStatusCount/$totalAdminStatusCount *100 ?>" aria-valuenow="<?php echo $totalAdminStatusCount/$totalAdminStatusCount *100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                              <hr>
                            <p class="mb-0" style="font-weight: bold;"><?php echo $totalAdminStatusCount ?></p>
                          </div>
                        </div>

                      </div>  
                    </div>
                  </div>
                </div>
<!--                <div class="card-body">
                  <p class="card-title">Notifications</p>
                  <ul class="icon-data-list">
                    <li>
                      <div class="d-flex">
                        <img src="images/faces/face1.jpg" alt="user">
                        <div>
                          <p class="text-info mb-1">Isabella Becker</p>
                          <p class="mb-0">Sales dashboard have been created</p>
                          <small>9:30 am</small>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <img src="images/faces/face2.jpg" alt="user">
                        <div>
                          <p class="text-info mb-1">Adam Warren</p>
                          <p class="mb-0">You have done a great job #TW111</p>
                          <small>10:30 am</small>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                      <img src="images/faces/face3.jpg" alt="user">
                     <div>
                      <p class="text-info mb-1">Leonard Thornton</p>
                      <p class="mb-0">Sales dashboard have been created</p>
                      <small>11:30 am</small>
                     </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <img src="images/faces/face4.jpg" alt="user">
                        <div>
                          <p class="text-info mb-1">George Morrison</p>
                          <p class="mb-0">Sales dashboard have been created</p>
                          <small>8:50 am</small>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex">
                        <img src="images/faces/face5.jpg" alt="user">
                        <div>
                        <p class="text-info mb-1">Ryan Cortez</p>
                        <p class="mb-0">Herbs are fun and easy to grow.</p>
                        <small>9:00 am</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body"  style="background-color: rgba(33, 40, 50, 0.03)">
                  <p class="card-title">User Info</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                      <thead>
                          <tr style="background : black; color: white;">
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Mail</th>
                          <th>Status</th>
                          <th>Created Date</th>
                          <th>Created By</th>
 
                        </tr>  
                      </thead>
                      <tbody>
                          <?php
                          foreach ($userInfoArray as $row) { ?>

                        <tr>
                          <td><?php echo $row["user_id"] ?></td>
                          <td class="font-weight-bold"><?php echo $row["name"] ?></td>
                          <td><?php echo $row["phone"] ?></td>
                          <td><?php echo $row["mail"] ?></td>
                          <?php 
                          if($row["status"] == "Activate"){
                              $class = "badge badge-success";
                          }
                          else{
                               $class = "badge badge-warning";
                          }
                          ?>
                          <td class="font-weight-medium"><div class="<?php echo $class ?>"><?php echo $row["status"] ?></div></td>
                          <td><?php echo $row["created_date"] ?></td>
                          <td><?php echo $row["created_by"] ?></td>
                        </tr>
                          <?php } ?>
<!--                        <tr>
                          <td>Search Engine Optimization</td>
                          <td class="font-weight-bold">$116</td>
                          <td>13 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>
                        <tr>
                          <td>Display Advertising</td>
                          <td class="font-weight-bold">$551</td>
                          <td>28 Sep 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Pay Per Click Advertising</td>
                          <td class="font-weight-bold">$523</td>
                          <td>30 Jun 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>E-Mail Marketing</td>
                          <td class="font-weight-bold">$781</td>
                          <td>01 Nov 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-danger">Cancelled</div></td>
                        </tr>
                        <tr>
                          <td>Referral Marketing</td>
                          <td class="font-weight-bold">$283</td>
                          <td>20 Mar 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-warning">Pending</div></td>
                        </tr>
                        <tr>
                          <td>Social media marketing</td>
                          <td class="font-weight-bold">$897</td>
                          <td>26 Oct 2018</td>
                          <td class="font-weight-medium"><div class="badge badge-success">Completed</div></td>
                        </tr>-->
                      </tbody>
                    </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!--chartjs-->
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js" integrity="sha512-ml/QKfG3+Yes6TwOzQb7aCNtJF4PUyha6R3w8pSTo/VJSywl7ZreYvvtUso7fKevpsI+pYVVwnu82YO0q3V6eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    </script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>  

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
   <script>
		// get current date and time
		var today = new Date();
		var dynamicDate = today.toLocaleDateString();
		var dynamicTime = today.toLocaleTimeString();

		// update the HTML element with current date and time
		document.getElementById("dynamicTime").innerHTML = dynamicTime;
		document.getElementById("dynamicDate").innerHTML = dynamicDate;
//		document.getElementById("date").innerHTML = date + "<br>" + time;
		
		// update the date and time dynamically every second
		setInterval(function() {
			var today = new Date();
			var dynamicDate = today.toLocaleDateString();
			var dynamicTime = today.toLocaleTimeString();
			document.getElementById("dynamicDate").innerHTML = dynamicDate;
			document.getElementById("dynamicTime").innerHTML = dynamicTime;
//			document.getElementById("date").innerHTML = date + "<br>" + time;
		}, 1000);
	</script>

</body>
