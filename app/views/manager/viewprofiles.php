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
            margin: 20px;
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
                            <a href="<?php echo URLROOT . '/managers/viewmanagerprofile'?>">
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
                                    <button class="button-sidebar-menu active-nav" id="homeButton">
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
                            <!-- End -->


                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>



                            <li class="item">

                                <a href="<?php echo URLROOT . '/managers/viewmanagerprofile'?>" class="nav_link" data-content='menu'>
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

    <div class="profile-container">
        <?php if ($data['users']) : ?>
            <?php $user = $data['users']; ?>

            <img class="profile-image" src="<?php echo URLROOT; ?>/uploads/profile/<?php echo basename($user->profile_picture); ?>" alt="Profile Image">

            <div class="profile-field">
                <label for="name">Name:</label>
                <span id="name"><?php echo $user->name; ?></span>
            </div>

            <div class="profile-field">
                <label for="email">Email:</label>
                <span id="email"><?php echo $user->email; ?></span>
            </div>

            <div class="profile-field">
                <label for="address">Address:</label>
                <span id="address"><?php echo $user->address; ?></span>
            </div>

            <div class="profile-field">
                <label for="role">Role:</label>
                <span id="role"><?php echo $user->role_name; ?></span>
            </div>

            <div class="profile-field">
                <label for="nic">NIC:</label>
                <span id="nic"><?php echo $user->nic; ?></span>
            </div>
            <?php if ($user->role_id != 1) : ?>
            
            <!-- Delete Profile Button -->
            <form action="<?php echo URLROOT; ?>/managers/deleteprofile/<?php echo $user->user_id; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this profile?');">
                <button type="submit" class="delete-button">Delete Profile</button>
            </form>

        

        <!-- Role Change Form -->
        <form class="role-change-form" action="<?php echo URLROOT; ?>/managers/updateuserrole/<?php echo $user->user_id; ?>" method="POST" id="roleChangeForm">
            <label for="role">Choose a role:</label>
            <select id="role" name="role">
                
                <option value="2" <?php echo ($user->role_id == 2) ? 'disabled' : ''; ?>>Inventory Manager</option>
                <option value="3" <?php echo ($user->role_id == 3) ? 'disabled' : ''; ?>>Receptionist</option>
                <option value="4" <?php echo ($user->role_id == 4) ? 'disabled' : ''; ?>>Chef</option>
            </select>
            <br>
            <input type="submit" value="Change">
        </form>

        <!-- Success Alert -->
        <div id="successAlert" class="alert" style="display:none;">
            User role changed successfully!
        </div>
        <?php endif; ?>

        <?php else : ?>
            <p>No user data available.</p>
        <?php endif; ?>
        
    </div>

    <!-- JavaScript to show success alert -->
    <script>
        document.getElementById('roleChangeForm').addEventListener('submit', function () {
            alert("User role changed successfully!");
            document.getElementById('successAlert').style.display = 'block';
        });
    </script>

</body>

</html>
