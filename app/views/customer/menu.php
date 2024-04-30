<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <title><?php echo SITENAME; ?></title>
</head>
<style>
    
</style>

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
                            <!-- <span class="material-symbols-outlined topbar-shoping-cart" value="0">
                                shopping_cart_off
                            </span> -->
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
                            <!-- <a href="<?php echo URLROOT ?>/customers/dashboard" class="nav_link" data-content='dashboard'>
                                <button class="button-sidebar-menu" id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            home
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reservation </span>
                                </button>
                            </a> -->
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/reservation" class="nav_link" data-content='reservation'>
                                    <button class="button-sidebar-menu" id="reservationButton">
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
            <div class="view-only-menu">
                <div class="customer-menu-view">
                    <div class="menu-view-header-bar">

                        <div class="menu-view-filters">
                            <div class="menu-categories">
                                <button class="category-button active-category" data-category-id="all">All</button>
                                <button class="category-button" data-category-id="1">Desserts & Drinks</button>
                                <button class="category-button" data-category-id="2">Main Courses</button>
                                <button class="category-button" data-category-id="3">Appetizers & Sides</button>
                                <button class="category-button" data-category-id="4">Salads & Soups</button>
                                <button class="category-button" data-category-id="5">Breakfast & Brunch</button>
                                <button class="category-button" data-category-id="6">International Cuisine</button>
                                <button class="category-button" data-category-id="7">Special</button>
                            </div>
                        </div>
                        <div class="menu-view-head">
                            <div class="search-reservation">
                                <form class="search-form" method="GET" action="">
                                    <input type="text" name="search" placeholder="Search Menu Item" value="" id="search-input">
                                    <button type="submit" id="search-button">Search</button>
                                </form>
                            </div>
                            <div class="menu-filters">
                                <div class="price-filter">
                                    <!-- <div class="card-price-range">
                                    <div class="price-lab">
                                        <label>Min</label>
                                        <p id="min-value">$50</p>
                                    </div>

                                    <div class="range-slider">
                                        <div class="range-fill"></div>

                                        <input type="range" class="min-price" value="100" min="100" max="5000" step="10" />
                                        <input type="range" class="max-price" value="5000" min="100" max="5000" step="10" />
                                    </div>
                                    <div class="price-lab">
                                        <label>max</label>
                                        <p id="max-value">$500</p>
                                    </div>
                                </div> -->
                                </div>
                            </div>
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
                </div>

            </div>
        </div>
    </div>


    <script>
        const URLROOT = "<?php echo URLROOT; ?>";
        var foodReviews = <?php echo json_encode($data['foodReview']); ?>;
    </script>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer-menu.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

</html>