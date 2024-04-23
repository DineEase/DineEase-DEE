<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/receptionist-styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title><?php echo SITENAME; ?></title>

    <style>
        .menus-chef-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 80%;
            margin: auto;
            gap: 20px;
            padding-top: 30px;
        }

        .item-chef-menu {
            width: 200px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .item-chef-menu:hover {
            transform: translateY(-10px);
        }

        .item-chef-menu img {
            width: 100%;
            height: auto;
            border-radius: 12px 12px 0 0;
        }

        .item-chef-menu .info {
            padding: 15px;
        }

        .item-chef-menu .price-chef-menu {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px !important;
            margin-bottom: 5px !important;
            color: var(--brandgreen);
        }

        .Time-chef-menu {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .item-chef-menu .title-chef-menu {
            font-size: 20px;
            margin-top: 4px;
            font-weight: bold;
            margin-bottom: 5px !important;
        }

        .item-chef-menu span {
            display: inline-block;
            padding: 3px 20px;
            background-color: var(--brandgreen);
            color: #fff;
            border-radius: 10px;
            margin-top: 10px;
        }

        .search-chef-menu {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .search-chef-menu input {
            height: 40px;
            width: 300px;
            border-radius: 20px;
            padding: 10px;
            border: none;
        }

        .menu-card {
            width: 150px;
            padding: 15px;
            border: 2px solid var(--brandgreen);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 0 auto;
            margin-top: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .menu-card:hover {
            transform: scale(1.05);
        }

        .create-menu-link {
            text-decoration: none;
            color: var(--brandgreen);
            font-weight: bold;
            font-size: 14px;
            display: block;
            transition: color 0.3s ease;
        }

        .menu-card:hover .create-menu-link {
            color: var(--brandgreen-dark);
        }

        .plus-symbol {
            margin-right: 6px;
            font-weight: bold;
        }

        .buttons-chef-menu {
            display: flex;
            justify-content: center;
            margin-top: 2px;
            margin-bottom: 4px;
            justify-content: space-between;
            padding-left: 4px;
            padding-right: 4px;

        }

        .button.item-button-chef-menu {
            margin: 3 3px;
            text-align: center;

        }

        .button.item-button-chef-menu a {
            text-decoration: none;
            color: white;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button.item-button-chef-menu a:hover {
            background-color: #45a049;
        }

        .center-text {
            text-align: center;
        }

        .customer-menu-view {
            display: flex;
            flex-direction: column;
        }

        .menu-view-head {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: right;
            margin-right: 80px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .menu-view-header-bar {
            background-color: #f5f5f5;
            width: 100%;
            border-radius: 10px;
            position: sticky;
            top: 6%;
        }

        .menu-view-filters {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 20px;
            width: 100%;
        }

        .menu-categories {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid var(--brandgreen);
            border-radius: 10px;
            padding: 4px;
            gap: 5px;
        }

        .category-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background-color: var(--brandgreen);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 180px;
            height: 3em;
        }

        .category-button:hover {
            background-color: var(--brandgreen-dark);
        }

        .menu-container-div-out {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 15px;
            height: 50%;
        }

        .menu-container-div {
            padding: 20px;
            gap: 15px;
        }
    </style>

</head>

<body>
    <div class="container">
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
                            <span class="material-symbols-outlined topbar-shoping-cart" value="0">
                                shopping_cart_off
                            </span>
                            <span class="material-symbols-outlined material-symbols-outlined-topbar  topbar-notifications">notifications </span>
                            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                            <img src="<?php echo URLROOT ?>/img/profilePhotos/<?php echo $_SESSION['profile_picture'] ?>" alt="profile-photo" class="profile" />
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
                            <a href="<?php echo URLROOT ?>/customers/dashboard" class="nav_link" data-content='dashboard'>
                                    <button class="button-sidebar-menu" id="reservationButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reservation </span>
                                    </button>
                                </a>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/reservation" class="nav_link" data-content='reservation'>
                                    <button class="button-sidebar-menu " id="reservationButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                book_online
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reservation </span>
                                    </button>
                                </a>
                            </li>

                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/menu" class="nav_link" data-content='menu'>
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
                                <a href="<?php echo URLROOT ?>/customers/review" class="nav_link" data-content='menu'>
                                    <button class="button-sidebar-menu active-nav" id="reservationButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                reviews
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reviews </span>
                                    </button>
                                </a>
                            </li>
                            <!-- End -->


                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>



                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/profile" class="nav_link" data-content='menu'>
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
        <div class="body-template">
            <div id="content">
                <div class="review-container">
                    <div class="tabset">
                        <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                        <label for="tab1">All Reviews</label>
                        <input type="radio" name="tabset" id="tab2" aria-controls="add">
                        <label for="tab2">My Reviews</label>

                        <div class="tab-panels review-tp">
                            <section id="view" class="tab-panel .review-tabs review-tp">
                                <div class="view-all-reviews-container review-cont">
                                    <div class="menu-view-filters">
                                        <div class="menu-categories">
                                            <button class="category-button active-category" data-category-id="all">All</button>
                                            <button class="category-button" data-category-id="1">Desserts & Drinks</button>
                                            <button class="category-button" data-category-id="2">Main Courses</button>
                                            <button class="category-button" data-category-id="3">Appetizers & Sides</button>
                                            <button class="category-button" data-category-id="4">Salads & Soups</button>
                                            <button class="category-button" data-category-id="5">Breakfast & Brunch</button>
                                            <button class="category-button" data-category-id="6">International Cuisine</button>
                                        </div>
                                    </div>
                                    <div class="menu-view-head">


                                    </div>
                                    <div class="menu-box">
                                        <div class="menu-items">
                                            <div id="menu-container" class="menu-container-div-out">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-pagination-container">
                                        <div class="view-pagination">
                                            <button class="view-pagination-button " id="prev-page">Previous</button>
                                            <span class="view-pagination-text" id="page-info"></span>
                                            <button class="view-pagination-button" id="next-page">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section id="add" class="tab-panel .review-tabs review-tp">
                                <div class="view-my-reviews-container review-cont">

                            

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>