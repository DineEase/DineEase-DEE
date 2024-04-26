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
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
    .container {
        max-width: 800px;
        margin-top: 20px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {

        color: #333;
    }

    form {
        max-width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    select,
    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: green;
        color: #fff;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: lightgreen;
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
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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
        <h1>Add Capacity and Package for a New Table</h1>

        <form action="<?php echo URLROOT; ?>/managers/addtable" method="post">
            <label for="packageDropdown">Select Package:</label>
            <select id="packageDropdown" name="packageID">
            <option value="">Select Package</option>
                <?php
                foreach ($data['packages'] as $package) {
                    echo "<option value=\"{$package->packageID}\">{$package->packageName}</option>";
                }
                ?>
            </select>
            <input type="hidden" id="packageName" name="packageName" value="">
            <label for="capacityInput">Enter Capacity (Numbers Only):</label>
            <input type="number" id="capacityInput" name="capacity" pattern="\d+" required>

            <input type="submit" value="Add">
        </form>
    </div>
    <script>
    // JavaScript to update the hidden input field with the selected package name and extract the first three letters
    document.getElementById('packageDropdown').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var packageName = selectedOption.text;
        var firstThreeLetters = packageName.substring(0, 3);
        document.getElementById('packageName').value = firstThreeLetters;
    });
    </script>
</body>

</html>