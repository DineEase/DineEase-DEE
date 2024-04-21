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
        background-color: #f5f5f5;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .menu-list {
        list-style: none;
        padding: 0;
    }

    .menu-item {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .menu-item h3 {
        margin: 0;
        color: #333;
    }

    .menu-item p {
        margin: 5px 0;
        color: #666;
    }

    .discount-form {
        margin-top: 20px;
    }

    .discount-form label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    .discount-form input[type="number"] {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .discount-form button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .discount-form button:hover {
        background-color: #45a049;
    }

    .error {
        color: #ff0000;
        /* Red color for error messages */
        font-size: 14px;
        /* Font size for error messages */
        margin-top: 5px;
        /* Margin to separate error messages from the input fields */
    }
</style>

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
                    Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?><span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
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
                            <button class="button-sidebar-menu" id="homeButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined">
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
                        <a href="<?php echo URLROOT; ?>/managers/addtable" class="nav_link" data-content='menu'>
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
    <h1>Discounts</h1>

    <h2>Menu-wise Discounts</h2>
    <a href="<?php echo URLROOT; ?>/managers/viewdiscounteditems">View Current Discounts</a>
    <form class="discount-form" action="<?php echo URLROOT; ?>/managers/addmenudiscounts" method="POST">
        <label for="menu-discount">Select Menu:</label>

        <select name="menu_id" id="menu-discount">
            <?php foreach ($data['menus'] as $menu) : ?>
                <?php $menuID = $menu->itemID; ?>
                <?php $isDiscounted = false; ?>
                <?php foreach ($data['discountedmenus'] as $discountedMenu) : ?>
                    <?php if ($menuID == $discountedMenu->category_menu_id) : ?>
                        <?php $isDiscounted = true; ?>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($isDiscounted) : ?>
                    <option value="<?php echo $menuID; ?>" disabled><?php echo $menu->itemName; ?></option>
                <?php else : ?>
                    <option value="<?php echo $menuID; ?>"><?php echo $menu->itemName; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <?php if (!empty($data['menu_ID_err'])) : ?>
            <span class="error"><?php echo $data['menu_dis_err']; ?></span>
        <?php endif; ?>

        <label for="menu-discount-value">Enter Discount (%):</label>
        <?php if (!empty($data['discount_err'])) : ?>
            <span class="error"><?php echo $data['discount_err']; ?></span>
        <?php endif; ?>
        <input type="number" name="menu_dis" id="menu-discount-value" min="0" step="1" placeholder="Enter discount percentage" required>
        <?php if (!empty($data['menu_start_date_err'])) : ?>
            <span class="error"><?php echo $data['menu_start_date_err']; ?></span>
        <?php endif; ?>
        <label for="start-date">Start Date:</label>
        <input type="date" name="menu_start_date" id="start-date" min="<?php echo date('Y-m-d'); ?>">
        <?php if (!empty($data['menu_end_date_err'])) : ?>
            <span class="error"><?php echo $data['menu_end_date_err']; ?></span>
        <?php endif; ?>
        <label for="end-date">End Date:</label>
        <input type="date" name="menu_end_date" id="end-date" min="<?php echo date('Y-m-d'); ?>">
        <button type="submit">Apply Discount</button>
    </form>


    <?php

    if ($data['checktotaldiscount']) {
    echo '<h2>Total Price-wise Discounts</h2>';
    echo '<p>A total discount is already available. You cannot add another total discount.</p>';
    echo '<a href="' . URLROOT . '/managers/viewtotaldiscount">Click here to edit total discount</a>.</p>';
} else {
    // Display the form to add a total discount
    echo '<h2>Total Price-wise Discounts</h2>';
    echo '<form class="discount-form" action="' . URLROOT . '/managers/addtotaldiscount" method="POST">';
    echo '<label for="total-discount">Enter Discount (%):</label>';
    if (!empty($data['discount_err'])) {
        echo '<span class="error">' . $data['discount_err'] . '</span>';
    }
    echo '<input type="number" name="total_discount" id="total-discount" min="0" step="1" placeholder="Enter discount percentage" required>';
    if (!empty($data['menu_start_date_err'])) {
        echo '<span class="error">' . $data['menu_start_date_err'] . '</span>';
    }
    echo '<label for="start-date">Start Date:</label>';
    echo '<input type="date" name="menu_start_date" id="start-date" min="' . date('Y-m-d') . '" required>';
    if (!empty($data['menu_end_date_err'])) {
        echo '<span class="error">' . $data['menu_end_date_err'] . '</span>';
    }
    echo '<label for="end-date">End Date:</label>';
    echo '<input type="date" name="menu_end_date" id="end-date" min="' . date('Y-m-d') . '" required>';
    echo '<button type="submit">Apply Discount</button>';
    echo '</form>';
}
?>

    <h2>Category-wise Discounts</h2>
    <form class="discount-form" action="<?php echo URLROOT; ?>/managers/addcategorydiscounts" method="POST">
        <label for="category-discount">Select Category:</label>
        <select name="category_id" id="category-discount">
            <?php foreach ($data['categories'] as $category) : ?>
                <?php $categoryID = $category->category_ID; ?>
                <?php $isDiscounted = false; ?>
                <?php foreach ($data['discountedcategories'] as $discountedcategory) : ?>
                    <?php if ($categoryID == $discountedcategory->category_menu_id) : ?>
                        <?php $isDiscounted = true; ?>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if ($isDiscounted) : ?>
                    <option value="<?php echo $categoryID; ?>" disabled><?php echo $category->category_name; ?></option>
                <?php else : ?>
                    <option value="<?php echo $categoryID; ?>"><?php echo $category->category_name; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <label for="category-discount-value">Enter Discount (%):</label>
        <?php if (!empty($data['discount_err'])) : ?>
            <span class="error"><?php echo $data['discount_err']; ?></span>
        <?php endif; ?>
        <input type="number" name="category_discount" id="category-discount-value" min="0" step="1" placeholder="Enter discount percentage">
        <?php if (!empty($data['menu_start_date_err'])) : ?>
            <span class="error"><?php echo $data['menu_start_date_err']; ?></span>
        <?php endif; ?>
        <label for="start-date">Start Date:</label>
        <input type="date" name="menu_start_date" id="start-date" min="<?php echo date('Y-m-d'); ?>">
        <?php if (!empty($data['menu_end_date_err'])) : ?>
            <span class="error"><?php echo $data['menu_end_date_err']; ?></span>
        <?php endif; ?>
        <label for="end-date">End Date:</label>
        <input type="date" name="menu_end_date" id="end-date" min="<?php echo date('Y-m-d'); ?>">
        <button type="submit">Apply Discount</button>
    </form>
</div>

<script>

</script>
</body>

</html>