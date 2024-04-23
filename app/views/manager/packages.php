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
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #e8f7e4;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .package {
        margin-bottom: 40px;
        padding: 30px;
        border: 2px solid #68af15;
        border-radius: 10px;
        background-color: #d9ead3;
    }

    .package h2 {
        color: #68af15;
        text-align: center;
        margin-bottom: 20px;
    }

    .package p {
        color: #333;
        margin-bottom: 10px;
    }

    .package ul {
        list-style-type: none;
        padding: 0;
        margin-bottom: 20px;
    }

    .package ul li {
        margin-left: 20px;
        padding-left: 10px;
        position: relative;
    }

    .package ul li:before {
        content: '\2022';
        position: absolute;
        left: -20px;
        color: #68af15;
    }

    .description {
        text-align: justify;
        font-size: 18px;
        line-height: 1.6;
        color: #333;
        margin-bottom: 20px;
    }
    .edit-btn {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
}

.edit-btn:hover {
    background-color: #45a049;
}
.package-image {
    width: 300px; /* adjust the width as needed */
    height: auto; /* maintain aspect ratio */
    border-radius: 10px; /* add rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* add a subtle shadow */
    /* You can add more styles here */
}


</style>

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
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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
        <h1>Package Details</h1>
        <?php foreach ($data['packages'] as $package) : ?>
            <div class="package">

                <h2><?php echo $package->packageName; ?> Package</h2>
                <img class="package-image" src="<?php echo URLROOT; ?>/uploads/package/<?php echo basename($package->image); ?>" alt="Package Image">
                <p>Includes:</p>
                <ul>
                    <li><?php echo $package->capacity; ?> Tables</li>
                    <li><?php echo $package->tax; ?>% Tax</li>
                    <!-- Add more details as needed -->
                </ul>
                <!-- Price can be added dynamically or fetched from database if available -->
                <p class="description"><?php echo $package->description; ?></p>
                <a href="<?php echo URLROOT . '/managers/getpackagedetails/' . $package->packageID; ?>" class="edit-btn">Edit</a>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>