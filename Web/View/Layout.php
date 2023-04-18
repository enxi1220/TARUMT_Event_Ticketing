<?php
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
                        <a class="nav-link" href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/Event/EventSummary.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/Booking/BookingSummary.php">Booking</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                <a
          class="btn btn-dark px-3 sign-in-link"
          href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/User/SignIn.php"
          role="button"
          >Sign In</i
        ></a>
        
                <div class="dropdown profile-dropdown invisible">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <button class=" btn btn-dark btn-floating"><i class="fas fa-user"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end" >
                        <li>
                            <a class="dropdown-item" href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/User/UserRead.php">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/TARUMT_Event_Ticketing/Web/View/FrontOffice/User/WishList.php">My Wish List</a>
                        </li>
                         <li><hr class="dropdown-divider"/></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="signOut()">Sign Out</a>

                        </li>
                    </ul>
                </div>
                
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    
</body>
</html>