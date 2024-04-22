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
        margin: 0;
        padding: 0;
        /* box-sizing: border-box; */
        font-family: "Poppins", sans-serif;
        background-color: #f5f5f5;
        transition: all 0.5s ease;
        overflow-x: hidden;
    }

    /* Style for the menu details container */
.menu-details-container {
    
    margin: 20px auto;
    width: 80%;
}

/* Style for the menu details section */
.menu-details {
    display: flex;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
}

/* Style for the menu details image */
.menu-details-image {
    flex: 1;
    padding: 20px;
}

.menu-details-image img {
    max-width: 100%;
    height: auto;
}

/* Style for the menu details info */
.menu-details-info {
    flex: 2;
    padding: 20px;
}

/* Style for the menu details rows */
.menu-details-row {
    margin-bottom: 10px;
}

/* Style for the menu details label */
.menu-details-label {
    font-weight: bold;
}

/* Style for the menu details value */
.menu-details-value {
    margin-left: 10px;
}

/* Style for the menu details prices */
.menu-details-prices {
    display: flex;
    flex-wrap: wrap;
}

/* Style for the menu details price */
.menu-details-price {
    margin-right: 10px;
    background-color: #f0f0f0;
    padding: 5px 10px;
    border-radius: 5px;
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
                    <hr class='separator'>
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
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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
    <div class="menu-details-container">
    <div class="menu-details">
        <div class="menu-details-image">
            <img src="<?php echo URLROOT . '/uploads/' . basename($data['imagePath']); ?>" alt="Menu Item Image" />
        </div>
        <div class="menu-details-info">
            <div class="menu-details-row">
                <label class="menu-details-label" for="category">Category:</label>
                <span class="menu-details-value"><?php echo htmlspecialchars($data['category']); ?></span>
            </div>
            <div class="menu-details-row">
                <label class="menu-details-label" for="itemName">Name:</label>
                <span class="menu-details-value"><?php echo htmlspecialchars($data['itemName']); ?></span>
            </div>
            <div class="menu-details-row">
                <label class="menu-details-label" for="prices">Prices:</label>
                <div class="menu-details-prices">
                    <?php foreach ($data['sizes'] as $key => $size): ?>
                        <span class="menu-details-price"><?php echo ucfirst($size) . ": LKR:" . $data['prices'][$key]; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="menu-details-row">
                <label class="menu-details-label" for="averageTime">Average Prepare Time MINS:</label>
                <span class="menu-details-value"><?php echo htmlspecialchars($data['averageTime']); ?></span>
            </div>
            <div class="menu-details-row">
                <label class="menu-details-label" for="description">Description:</label>
                <span class="menu-details-value"><?php echo htmlspecialchars($data['description']); ?></span>
            </div>
        </div>
    </div>
</div>


    

</body>

</html>