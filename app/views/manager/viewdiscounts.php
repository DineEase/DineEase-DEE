<!-- C:\wamp64\www\DineEase-DEE\app\views\manager\viewdiscounts.php -->

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

    <style>
        /* Overall page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Section heading styles */
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #666;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        /* Alternate row colors */
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
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
                                    <button class="button-sidebar-menu " id="homeButton">
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
                            <button class="button-sidebar-menu active-nav" id="reservationButton">
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

<body>
    <div class="container">
        <h2>Category-wise Discounts</h2>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Discount Percentage</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['discountedcategories'] as $category) : ?>
                    <tr>
                        <td><?php echo $category->category_name; ?></td>
                        <td><?php echo $category->discount_percentage; ?>%</td>
                        <td><?php echo $category->start_date; ?></td>
                        <td><?php echo $category->end_date; ?></td>
                        <td><a href="<?php echo URLROOT; ?>/managers/getcategorydiscountdetails/<?php echo $category->category_menu_id; ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Menu-wise Discounts</h2>
        <table>
            <thead>
                <tr>
                    <th>Menu Item</th>
                    <th>Discount Percentage</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['discountedmenus'] as $menu) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo URLROOT; ?>/managers/viewmenuitem/<?php echo $menu->category_menu_id; ?>">
                                <?php echo $menu->itemName; ?>
                            </a>
                        </td>

                        <td><?php echo $menu->discount_percentage; ?>%</td>
                        <td><?php echo $menu->start_date; ?></td>
                        <td><?php echo $menu->end_date; ?></td>
                        <td><a href="<?php echo URLROOT; ?>/managers/getmenudiscountdetails/<?php echo $menu->category_menu_id; ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total Bill Discounts</h2>
        <table>
            <thead>
                <tr>
                    <th>Discount Percentage</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['totaldiscount'] as $total) : ?>
                    <tr>
                        <td><?php echo $total->discount_percentage; ?>%</td>
                        <td><?php echo $total->start_date; ?></td>
                        <td><?php echo $total->end_date; ?></td>
                        <td><a href="<?php echo URLROOT; ?>/managers/viewtotaldiscount">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>