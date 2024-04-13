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

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        text-align: center;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .search-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .search-input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 5px;
    }

    .search-button {
        padding: 8px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #2980b9;
    }

    #categoryFilterForm,
    .add-category-container,
    .buttonGroup {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #categoryFilter {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
    }

    #newCategory {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .button {
        padding: 10px;
        background-color: #2ecc71;
        /* Green color for buttons */
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 5px;
        /* Space between buttons */
    }

    .button:hover {
        background-color: #27ae60;
        /* Darker green on hover */
    }

    .home-button {
        margin-top: 15px;
    }

    .menu-tiles {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .item-chef-menu {
        width: 48%;
        /* Two menus in a row with a small gap */
        margin-bottom: 20px;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .image-box-chef-menu {
        width: 100%;
        height: 200px;
        /* Set a fixed height for all images */
        overflow: hidden;
        border-radius: 8px 8px 0 0;
    }

    .image-box-chef-menu img {
        width: 100%;
        height: 100%;
        /* Make the image fill the container */
        object-fit: cover;
        /* Maintain aspect ratio and cover the container */
        display: block;
        margin: 0 auto;
        /* Center the image */
    }

    .bottom-chef-menu {
        padding: 10px;
    }

    .title-chef-menu {
        font-size: 18px;
        margin: 10px;
    }

    .price-chef-menu,
    .average-prepare-time-chef-menu {
        margin: 5px 10px;
    }

    .buttons-chef-menu {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: transparent;
    }

    .button a {
        text-decoration: none;
        color: #fff;
    }

    .button:hover {
        background-color: #27ae60;
        /* Darker green on hover */
    }

    .create-menu-button {
        background-color: #3498db;
        /* Light blue color for the Create Menu button */
    }

    .create-menu-button:hover {
        background-color: #2980b9;
        /* Darker blue on hover */
    }

    .category-set-time-container {
        margin-top: 20px;
        text-align: center;
    }

    .error-message {
        color: red;
        font-weight: bold;
        margin-top: 5px;
        margin-left: 20px;
        /* Adjust the left margin as needed */
        display: block;
    }
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
                        <hr class='separator'>
                        <ul class="menu_items">
                            <div class="menu_title menu_menu"></div>
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
        <div class="search-container">
            <form action="<?php echo URLROOT; ?>/managers/searchmenubyname" method="GET">
                <input type="text" name="searchQuery" class="search-input" placeholder="Search by name">
                <button type="submit" class="search-button">Search</button>
            </form>
            <form id="categoryFilterForm" action="<?php echo URLROOT; ?>/managers/filtermenubycategory" method="GET">
                <label for="categoryFilter">Filter by Category:</label>
                <select id="categoryFilter" name="categoryFilter" onchange="filterMenuByCategory(this.value)">
                    <option value="">All Categories</option>
                    <?php foreach ($data['categories'] as $category) : ?>
                        <?php
                        $selected = ($category->category_ID == $_GET['categoryFilter']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $category->category_ID; ?>" <?php echo $selected; ?>>
                            <?php echo $category->category_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>










        <div class="buttonGroup">
            <a href="<?php echo URLROOT; ?>/managers/submitMenuitem" class="button create-menu-button">Create Menu</a>
        </div>

        <div class="menu-tiles">
            <?php
            foreach ($data['menu'] as $menuitem) {
                echo '<div class="item-chef-menu">';
                echo '<div class="image-box-chef-menu">';
                echo '<img src="' . URLROOT . '/uploads/' . basename($menuitem->imagePath) . '" alt="Menu Item Image">';
                echo '</div>';
                echo '<div class="bottom-chef-menu">';
                echo '<p class="title-chef-menu">' . $menuitem->itemName . '</p>';
                echo '<p class="price-chef-menu">Price: LKR:' . $menuitem->price . '</p>';
                echo '<p class="average-prepare-time-chef-menu">Average Prepare Time:Min' . $menuitem->averageTime . '</p>';
                echo '<p class="average-prepare-time-chef-menu">Category:' . $menuitem->category_name . '</p>';
                echo '<div class="buttons-chef-menu">';

                if ($menuitem->hidden == 0) {
                    // If menu item is hidden, show "Show" button
                    echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/showMenuitem/' . $menuitem->itemID . '"onclick="showAlertShow()">Show</a></span>';
                } else {
                    // If menu item is shown, show "Hide" button
                    echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/hideMenuitem/' . $menuitem->itemID . '"onclick="showAlertHide()">Hide</a></span>';
                }

                echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/editMenuitem/' . $menuitem->itemID . '">Edit</a></span>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        <?php if (isset($data['new_category_added']) && $data['new_category_added']) : ?>
            alert("New category added!");
            window.location.href = "<?php echo URLROOT; ?>/managers/menu";
        <?php endif; ?>
    </script>

    <!-- JavaScript function to handle category filter -->
    <script>
        function filterMenuByCategory(categoryID) {
            // Check if "All Categories" is selected
            if (categoryID === "") {
                // Redirect to the same page without the categoryFilter parameter
                window.location.href = "<?php echo URLROOT; ?>/managers/menu";
            } else {
                // Encode the category ID before adding it to the URL
                var encodedCategoryID = encodeURIComponent(categoryID);

                // Redirect to the same page with the selected category as a query parameter
                window.location.href = "<?php echo URLROOT; ?>/managers/filtermenubycategory?categoryFilter=" + encodedCategoryID;
            }
        }
    </script>
    <script>
        function showAlertShow() {
            alert("Menu is shown to Customers");
        }
    </script>
    <script>
        function showAlertHide() {
            alert("Menu is hidden from Customers");
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log(<?php echo json_encode($data['menu']); ?>);
            <?php if (empty($data['menu'])) : ?>
                alert("No items available.");
                window.location.href = "<?php echo URLROOT; ?>/managers/menu";
            <?php endif; ?>
        });
    </script>

</body>

</html>