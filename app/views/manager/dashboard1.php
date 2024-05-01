<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/manager-style1.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
     <!-- Material Icons -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    


    <title><?php echo SITENAME; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

</head>

<body>
    <div class="navbar-template">
        <nav class="navbar">
            <div class="topbar">
                <div class="logo-item">
                    <i class="bx bx-menu" id="sidebarOpen"></i>
                    <img src="<?php echo URLROOT ?>/public/img/login/dineease-logo.svg" alt="DineEase Logo">
                    <div class="topbar-title">
                        DINE<span>EASE</span>
                    </div>
                </div>
                <div class="navbar-content">
                    <div class="profile-details">
                        <span class="material-symbols-outlined material-symbols-outlined-topbar ">notifications </span>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $profile_picture_url = URLROOT . '/uploads/profile/' . basename($_SESSION['profile_picture']);
                        ?>
                        Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                        <a href="<?php echo URLROOT . '/managers/viewmanagerprofile' ?>">
                            <img src="<?php echo URLROOT ?>/img/profilePhotos/<?php echo $_SESSION['profile_picture'] ?>" alt="profile-photo" class="profile" />
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="sidebar-template">
        <nav class="sidebar">
            <div class="sidebar-container">
                <div class="menu_content">
                    
                    <ul class="menu_items">
                        <div class="menu_title menu_menu"></div>
                        <li class="item">
                            <a href="<?php echo URLROOT ?>/managers/dashboard" class="nav_link nav_link_switch" data-content='home'>
                                <button class="button-sidebar-menu active-nav" id="homeButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            dashboard
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Dashboard</span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT ?>/managers/getUsers" class="nav_link nav_link_switch" data-content='home'>
                                <button class="button-sidebar-menu " id="homeButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            manage_accounts
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Users</span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT ?>/managers/menu" class="nav_link" data-content='reservation'>
                                <button class="button-sidebar-menu " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            restaurant_menu
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Menus </span>
                                </button>
                            </a>
                        </li>


                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/updatetimecategories" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu" id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            category
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Categories </span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/packages" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu" id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            Package
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Packages </span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/viewtables" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu" id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            Table_Restaurant
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Tables </span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/handlediscounts" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            sell
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Discounts</span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/reports" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            lab_profile
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reports</span>
                                </button>
                            </a>
                        </li>
                        <a href="<?php echo URLROOT; ?>/managers/reservations" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu  " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            book_online
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reservations</span>
                                </button>
                            </a>
                        </li>
                        <!-- End -->


                    </ul>
                    <hr class='separator'>

                    <ul class="menu_items">
                        <div class="menu_title menu_user"></div>



                        <li class="item">

                            <a href="<?php echo URLROOT . '/managers/viewmanagerprofile' ?>" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu" id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            account_circle
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">My Account </span>
                                </button>
                            </a>
                        </li>
                        <li class="item">

                            <a href="<?php echo URLROOT; ?>/users/logout" class="nav_link">
                                <button class="button-sidebar-menu">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            logout
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Logout</span>
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="grid-container">
      <!-- Main -->
      <main class="main-container">
        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">TOTAL SALES</p>
              <span class="material-icons-outlined text-blue"><i class="fa-solid fa-coins"></i></span>
            </div>
            <span class="text-primary font-weight-bold">LKR:<?php echo $data['totalsales']->{'SUM(amount)'}; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">TOTAL ORDERS</p>
              <span class="material-icons-outlined text-orange"><i class="fa-solid fa-arrow-up-wide-short"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['totalorders']->{'COUNT(orderItemID)'}; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">TOTAL CUSTOMERS</p>
              <span class="material-icons-outlined text-green"><i class="fa-solid fa-users"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['totalcustomers']->{'COUNT(user_id)'}; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">TOTAL MENUS</p>
              <span class="material-icons-outlined text-red"><i class="fa-solid fa-bars"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['totalmenus']->{'COUNT(itemID)'}; ?></span>
          </div>


          <div class="card">
            <div class="card-inner">
              <p class="text-primary">BEST SELLING MENU ITEM </p>
              <span class="material-icons-outlined text-color1"><i class="fa-solid fa-bowl-food"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['bestsellingmenuitem']->itemName; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">MOST USED PACKAGE</p>
              <span class="material-icons-outlined text-color2"> <i class="fa-solid fa-cubes"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['mostusedpackage']->packageName; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">BEST REVIEWD FOOD</p>
              <span class="material-icons-outlined text-color3"><i class="fa-regular fa-circle-up"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['bestreviewedfood']->itemName; ?></span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">LEAST REVIEW FOOD</p>
              <span class="material-icons-outlined text-color4"><i class="fa-regular fa-circle-down"></i></span>
            </div>
            <span class="text-primary font-weight-bold"><?php echo $data['leastreviewedfood']->itemName; ?></span>
          </div>

          

        </div>

        <div class="charts">

          <div class="charts-card">
            <p class="chart-title">Top 5 Products</p>
            <canvas id="bar-chart"></canvas>
          </div>

          <div class="charts-card">
            <p class="chart-title">Most Used Package</p>
            <canvas id="piechart"></canvas>
          </div>


          </div>

        </div>
      </main>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo URLROOT; ?>/js/manager.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- <script type="text/javascript">
    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
     var data = google.visualization.arrayToDataTable([
  ['Task', 'Reservation Count'],
  ['finished', 8],
  ['Deposited', 6],
  ['Waiting Payment', 4],
  ['Pending', 3],
  ['Canceled', 3]

]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Reservation Status', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script> -->
<script>
        // Data for the bar chart
        var menuItems = <?php echo json_encode(array_column($data['bestsellingtop5menuitems'], 'itemName')); ?>;
        var quantities = <?php echo json_encode(array_column($data['bestsellingtop5menuitems'], 'total_quantity')); ?>;

        // Bar chart configuration
        var ctx = document.getElementById('bar-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: menuItems,
                datasets: [{
                    label: 'Quantity Sold',
                    data: quantities,
                    backgroundColor: '#4caf50', // Green color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var packageNames = <?php echo json_encode(array_column($data['gettotalpackageusage'], 'packageName')); ?>;
        var packageUsages = <?php echo json_encode(array_column($data['gettotalpackageusage'], 'total_usage')); ?>;

        // Pie chart configuration
        var pieCtx = document.getElementById('piechart').getContext('2d');
        var pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: packageNames,
                datasets: [{
                    label: 'Package Usage',
                    data: packageUsages,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Colors for the pie slices
                    borderWidth: 1
                }]
            },
            options: {}
        });
    </script>

</body>

</html>
