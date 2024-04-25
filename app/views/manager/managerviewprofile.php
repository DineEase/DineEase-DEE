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
        margin: -46px;
        background-color: #f5f5f5;
    }

    .header {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 10px;
        font-size: 24px;
    }

    .profile-container {
        margin-top: 107px !important;
        max-width: 400px;
        margin: auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .profile-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-image {
        max-width: 100%;
        height: auto;
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .profile-field {
        margin-bottom: 15px;
    }

    .profile-field label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-field span {
        display: inline-block;
    }

    .delete-button {
        background-color: #ff0000;
        color: #fff;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .role-change-form {
        margin-top: 20px;
        text-align: center;
    }

    .role-change-form label,
    .role-change-form select,
    .role-change-form input[type="submit"] {
        margin-bottom: 10px;
    }

    .home-button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
    }

    /* Styling for success alert */
    .alert {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
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
                        <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>">
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

                            <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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

    <div class="profile-container">
        <?php if ($data['manager']) : ?>
            <?php $manager = $data['manager']; ?>

            <img class="profile-image" src="<?php echo URLROOT; ?>/uploads/profile/<?php echo basename($manager->profile_picture); ?>" alt="Profile Image">

            <div class="profile-field">
                <label for="name">Name:</label>
                <span id="name"><?php echo $manager->name; ?></span>
            </div>

            <div class="profile-field">
                <label for="email">Email:</label>
                <span id="email"><?php echo $manager->email; ?></span>
            </div>

            <div class="profile-field">
                <label for="address">Address:</label>
                <span id="address"><?php echo $manager->address; ?></span>
            </div>
            <div class="profile-field">
                <label for="dob">Date of Birth:</label>
                <span id="dob"><?php echo $manager->dob; ?></span>
            </div>

            <div class="profile-field">
                <label for="role">Role:</label>
                <span id="role"><?php echo $manager->role_name; ?></span>
            </div>

            <div class="profile-field">
                <label for="nic">NIC:</label>
                <span id="nic"><?php echo $manager->nic; ?></span>
            </div>
            <div class="profile-field">
                <label for="mobile_number">Mobile Number:</label>
                <span id="mobile_number"><?php echo $manager->mobile_no; ?></span>
            </div>

        <?php endif; ?>

    </div>
    <!-- Role Change Form -->



</body>

</html>