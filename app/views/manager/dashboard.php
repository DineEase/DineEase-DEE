<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/manager-style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <title><?php echo SITENAME; ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .card {
            width: calc(25% - 20px);
            /* Adjust width to fit 4 cards in a row */
            min-height: 150px;
            background-color: #e6f7e9;
            /* Light green */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
            /* Adjust padding */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            margin: 0;
            text-align: center;
            color: #333;
            font-size: 16px;
            /* Adjust font size */
        }

        .card p {
            margin: 5px 0;
            text-align: center;
            font-size: 14px;
            /* Adjust font size */
            color: #555;
        }

        /* Adjustments for smaller screens */
        @media only screen and (max-width: 768px) {
            .card {
                width: calc(50% - 20px);
                /* Adjust width to fit 2 cards in a row */
            }
        }

        @media only screen and (max-width: 480px) {
            .card {
                width: calc(100% - 20px);
                /* Adjust width to fit 1 card in a row */
            }
        }

        /* Adjustments for Total Sales card */
        .total-sales-card {
            width: calc(35% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Total Orders card */
        .total-orders-card {
            width: calc(25% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Total Customers card */
        .total-customers-card {
            width: calc(20% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Total Menus card */
        .total-menus-card {
            width: calc(20% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Best Selling Menu Item card */
        .best-selling-card {
            width: calc(30% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Most Used Package card */
        .most-used-package-card {
            width: calc(30% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Top 5 Customers card */
        .top-5-customers-card {
            width: calc(45% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Best Reviewed Food card */
        .best-reviewed-food-card {
            width: calc(35% - 20px);
            /* Adjust width to fit the content */
        }

        /* Adjustments for Least Reviewed Food card */
        .least-reviewed-food-card {
            width: calc(35% - 20px);
            /* Adjust width to fit the content */
        }

        .chart-container {
            width: 100%;
            max-width: 600px;
            /* Adjust max-width as needed */
            margin: 20px auto;
        }
    </style>

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
                            <img src="<?php echo $profile_picture_url; ?>" alt="profile-photo" class="profile" />
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
                        <li class="item">
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
    <div class="container">
        <div class="card total-sales-card">
            <h2>Total Sales</h2>
            <p>LKR:<?php echo $data['totalsales']->{'SUM(amount)'}; ?></p>
        </div>
        <div class="card total-orders-card">
            <h2>Total Orders</h2>
            <p><?php echo $data['totalorders']->{'COUNT(orderItemID)'}; ?></p>
        </div>
        <div class="card total-customers-card">
            <h2>Total Customers</h2>
            <p><?php echo $data['totalcustomers']->{'COUNT(user_id)'}; ?></p>
        </div>
        <div class="card total-menus-card">
            <h2>Total Menus</h2>
            <p><?php echo $data['totalmenus']->{'COUNT(itemID)'}; ?></p>
        </div>
        <div class="card best-selling-card">
            <h2>Best Selling Menu Item</h2>
            <p><?php echo $data['bestsellingmenuitem']->itemName; ?></p>
            <p>Total Quantity: <?php echo $data['bestsellingmenuitem']->total_quantity; ?></p>
            <img src="<?php echo $data['bestsellingmenuitem']->imagePath ?>" alt="Menu Image" style="width: 100px; height: 100px;">
        </div>
        <div class="card most-used-package-card">
            <h2>Most Used Package</h2>
            <p><strong>Package Name:</strong> <?php echo $data['mostusedpackage']->packageName; ?></p>
            <p><strong>Total Usage:</strong> <?php echo $data['mostusedpackage']->total_usage; ?></p>
        </div>
        <div class="card top-5-customers-card">
            <h2>Top 5 Customers</h2>
            <ul>
                <?php foreach ($data['top5customers'] as $customer) : ?>
                    <li><?php echo $customer->name; ?> - Total Reservations: <?php echo $customer->total_reservations; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card best-reviewed-food-card">
            <h2>Best Reviewed Food</h2>
            <p>Name: <?php echo $data['bestreviewedfood']->itemName; ?></p>
            <p>Average Rating: <?php echo $data['bestreviewedfood']->average_rating; ?></p>
        </div>
        <div class="card least-reviewed-food-card">
            <h2>Least Reviewed Food</h2>
            <p>Name: <?php echo $data['leastreviewedfood']->itemName; ?></p>
            <p>Average Rating: <?php echo $data['leastreviewedfood']->average_rating ?? 'N/A'; ?></p>
        </div>

    </div>
    <div class="chart-container">
    <h2 style="text-align: center;">Best Selling Top 5 Menu Items</h2>
        <canvas id="best-selling-chart"></canvas>
    </div>
    <div class="chart-container">
    <h2 style="text-align: center;">Total Package Usage</h2>
        <canvas id="total-package-chart"></canvas>
    </div>
    <script>
        // Data for the bar chart
        var menuItems = <?php echo json_encode(array_column($data['bestsellingtop5menuitems'], 'itemName')); ?>;
        var quantities = <?php echo json_encode(array_column($data['bestsellingtop5menuitems'], 'total_quantity')); ?>;

        // Bar chart configuration
        var ctx = document.getElementById('best-selling-chart').getContext('2d');
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
        var pieCtx = document.getElementById('total-package-chart').getContext('2d');
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
