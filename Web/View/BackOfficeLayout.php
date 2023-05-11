<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require $_SERVER['DOCUMENT_ROOT'] . '/TARUMT_Event_Ticketing/Web/StyleSheet/CSS_links.php';

?>
<!-- author: Vinnie Chin Loh Xin -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="#">
                    <img src="https://logos-world.net/wp-content/uploads/2021/09/One-Piece-Logo.png" height="66" alt="MDB Logo" loading="lazy" />
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminProfile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/TARUMT_Event_Ticketing/Web/View/BackOffice/Dashboard/BackOfficeDashboard.php">Dashboard</a>
                    </li>
<!--                    <li class="nav-item">
                        <a class="nav-link" href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/Booking/BookingSummary.php">Booking</a>
                    </li>-->
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                <a
          class="btn btn-dark px-3"  onclick="adminSignOut()"
          role="button"
          >Sign Out</i></a>
        <!--          href="/TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminLogin.php"-->
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    
</body>
<script>
function adminSignOut() {
  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Define the PHP script that will handle the request
  var url = "/TARUMT_Event_Ticketing/Controller/CtrlAdmin/AdminLogout.php";
  
  // Set the request method and URL
  xhr.open("POST", url, true);
  
  // Set the request header to send the data as form data
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  // Define the data to send with the request
  var data = "logout=true";
  
  // Send the request
  xhr.send(data);
  
  // Redirect the user to the login page
  window.location.href = "/TARUMT_Event_Ticketing/Web/View/BackOffice/Admin/AdminLogin.php";
}
</script>

</html>