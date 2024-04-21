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
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        /* Discount details styles */
        .discount-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .discount-details p {
            margin: 0;
            padding: 5px 0;
        }

        /* Form styles */
        .discount-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .discount-form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        .discount-form input[type="number"],
        .discount-form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .discount-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .discount-form button:hover {
            background-color: #45a049;
        }

        /* Delete button styles */
        #delete-discount {
            background-color: #f44336;
            margin-top: 10px;
        }

        #delete-discount:hover {
            background-color: #d32f2f;
        }

        /* Section heading styles */
       
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

<body>

<div class="container">
    <h1>Discounts</h1>

    <h2>Menu-wise Discounts</h2>

    <!-- Display the discount details -->
    <div class="discount-details">
        <p><strong>Discount ID:</strong> <?php echo $data['discountdetails']->discountID; ?></p>
        <p><strong>Type:</strong> <?php echo $data['discountdetails']->type; ?></p>
        <p><strong>Category/Menu ID:</strong> <?php echo $data['discountdetails']->category_menu_id; ?></p>
        <p><strong>Discount Percentage:</strong> <?php echo $data['discountdetails']->discount_percentage; ?>%</p>
        <p><strong>Start Date:</strong> <?php echo $data['discountdetails']->start_date; ?></p>
        <p><strong>End Date:</strong> <?php echo $data['discountdetails']->end_date; ?></p>
        <p><strong>Item Name:</strong> <?php echo $data['discountdetails']->itemName; ?></p>
    </div>

    <!-- Form for updating the menu-wise discount -->
    <form class="discount-form" action="<?php echo URLROOT; ?>/managers/updatemenudiscounts" method="POST">
        <input type="hidden" name="discount_id" value="<?php echo $data['discountdetails']->discountID; ?>">
        <input type="hidden" name="category_menu_id" value="<?php echo $data['discountdetails']->category_menu_id; ?>">

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
        
        <!-- Delete button -->
        <button type="button" class="delete-discount" data-discount-id="<?php echo $data['discountdetails']->discountID; ?>">Delete</button>
    </form>
</div>
<script>
        // Function to handle deletion
        function deleteDiscount(discountID) {
            // Confirm deletion
            if (confirm("Are you sure you want to delete this discount?")) {
                // Send AJAX request
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page or update UI as needed
                            location.reload(); // Reload the page
                        } else {
                            // Handle error
                            console.error('Error:', xhr.statusText);
                        }
                    }
                };
                xhr.open("POST", "<?php echo URLROOT; ?>/managers/deletediscount", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("discount_id=" + discountID);
            }
        }

        // Add click event listener to delete buttons
        var deleteButtons = document.querySelectorAll('.delete-discount');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Get discount ID from data attribute
                var discountID = button.getAttribute('data-discount-id');
                // Call deleteDiscount function
                deleteDiscount(discountID);
            });
        });
    </script>

</body>

</html>