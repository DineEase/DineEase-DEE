<<!DOCTYPE html>
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

        /* .container {
            width: 80%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } */
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="time"],
        select {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            /* Green color for the home button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        
        .add-category-container,
        .buttonGroup {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        

        #newCategory {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #editCategory {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        #newCategoryName {
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
        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 5px;
            margin-left: 20px;
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
                                        <button class="button-sidebar-menu active-nav" id="reservationButton">
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



            <div class="add-category-container">
                <form id="addCategoryForm" action="<?php echo URLROOT; ?>/managers/addmenucategory" method="POST">
                    <label for="newCategory">Add Category:</label>
                    <input type="text" id="newCategory" name="category_name" placeholder="Enter new category">
                    <button type="submit" class="button">Add</button>
                </form>

            </div>
            <?php if (!empty($data['category_name_err'])) : ?>
                <p class="error-message"><?php echo $data['category_name_err']; ?></p>
            <?php endif; ?>
            <div class="edit-category-container">
                <form id="editCategoryForm" action="<?php echo URLROOT; ?>/managers/editmenucategory/" method="POST" onsubmit="return validateForm0()">
                    <label for="editCategory">Select Category to Edit:</label>
                    <select id="editCategory" name="category_id" onchange="updateActionURL()">
                        <option value="" disabled selected>Select a category</option>
                        <?php foreach ($data['categories'] as $category) : ?>
                            <option value="<?php echo $category->category_ID; ?>">
                                <?php echo $category->category_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="newCategoryName">New Category Name:</label>
                    <input type="text" id="newCategoryName" name="category_name" placeholder="Enter new category name">
                    <button type="submit" class="button">Edit</button>
                </form>
                <?php if (!empty($data['category_edit_name_err'])) : ?>
                    <p class="error-message"><?php echo $data['category_edit_name_err']; ?></p>
                <?php endif; ?>
                <script>
                    function updateActionURL() {
                        var selectedCategoryId = document.getElementById("editCategory").value;
                        var form = document.getElementById("editCategoryForm");
                        form.action = "<?php echo URLROOT; ?>/managers/editmenucategory/" + selectedCategoryId;
                    }

                    function validateForm0() {
                        var selectedCategoryId = document.getElementById("editCategory").value;
                        if (!selectedCategoryId) {
                            alert("Please select a category before submitting the form.");
                            return false; // Prevent form submission
                        }
                        return true; // Allow form submission
                    }
                </script>

                <script>
                    function validateForm() {
                        var startTime = document.getElementById('start_time').value;
                        var endTime = document.getElementById('end_time').value;

                        // Convert start time and end time to Date objects for comparison
                        var startDate = new Date('1970-01-01T' + startTime + 'Z');
                        var endDate = new Date('1970-01-01T' + endTime + 'Z');

                        // Check if start time is greater than end time
                        if (startDate > endDate) {
                            alert('Start time cannot be greater than end time.');
                            return false; // Prevent form submission
                        }

                        return true; // Allow form submission
                    }
                </script>

                <h1>Update Category Time</h1>

                <!-- Display the form -->
                <form method="post" action="<?php echo URLROOT; ?>/managers/updatetimecategories" onsubmit="return validateForm()">
                    <label for="category">Select Category:</label>
                    <select name="category_ID" id="category" required>
                        <?php foreach ($data['categories'] as $category) : ?>
                            <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <br>

                    <label for="start_time">Start Time:</label>
                    <input type="time" name="start_time" id="start_time" required>

                    <br>

                    <label for="end_time">End Time:</label>
                    <input type="time" name="end_time" id="end_time" required>

                    <br>

                    <input type="submit" value="Update Time">
                </form>

                <?php if (!empty($data['start_time_error'])) : ?>
                    <p class="error-message"><?php echo $data['start_time_error']; ?></p>
                <?php endif; ?>

                <?php if (!empty($data['end_time_error'])) : ?>
                    <p class="error-message"><?php echo $data['end_time_error']; ?></p>
                <?php endif; ?>

                <?php if (!empty($data['time_diff_err'])) : ?>
                    <p class="error-message"><?php echo $data['time_diff_err']; ?></p>
                <?php endif; ?>

                <h1>Manually Hide Category</h1>
                <form method="post" action="<?php echo URLROOT; ?>/managers/hidecategory">
                    <label for="category">Select Category:</label>
                    <select name="category_ID" id="category" required>
                        <?php foreach ($data['categories'] as $category) : ?>
                            <?php if ($category->hidden_status == 0) : ?>
                                <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="Hide Category">
                </form>
                <h1>Manually Show Category</h1>
                <form method="post" action="<?php echo URLROOT; ?>/managers/showcategory">
                    <label for="category">Select Category:</label>
                    <select name="category_ID" id="category" required>
                        <?php foreach ($data['categories'] as $category) : ?>
                            <?php if ($category->hidden_status == 1) : ?>
                                <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="Show Category">
                </form>
            </div>
    </body>

    </html>