<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Top Bar Styles */

        .top-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 100;
            position: relative;

        }

        .logo-name h1 {
            margin-left: 20px;
            font-size: 25px;

        }

        .logo img {
            height: 50px;
            margin-left: 20px;
            /* Add some margin to the left to separate it from the edge */
        }

        .user-info {
            display: flex;
            align-items: center;
            font-size: 18px;
        }

        .user-name {
            margin-left: 10px;
            font-weight: bold;
            text-decoration: none;
            /* Remove underline */
            color: #fff;
            /* Set text color to white */
            transition: color 0.3s ease;
            /* Add transition for smooth effect */
        }

        .user-name a {
            text-decoration: none;
            /* Remove underline */
            color: #fff;
            /* Set text color to white */
            transition: color 0.3s ease;
            /* Add transition for smooth effect */
        }

        .user-name a:hover {
            color: #27ae60;
            /* Change text color on hover */
        }


        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
            border: 2px solid #fff;
            /* Add border to make it stand out */
            transition: border-color 0.3s ease, transform 0.3s ease;
            /* Add transition for smooth effect */
        }

        .profile-image:hover {
            border-color: #27ae60;
            /* Change border color on hover */
            transform: scale(1.2);
            /* Increase size on hover */
        }


        /* Left Bar Styles */
        .left-bar {
            width: 200px;
            background-color: #fff;
            /* Change background color to white */
            height: 90vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);

        }

        .left-bar li {
            padding: 20px;
            list-style: none;
            /* Remove default list-style */
        }

        .left-bar a {
            text-decoration: none;
            color: #27ae60;
            /* Set text color to green */
            display: block;
            border-radius: 50%;
            /* Add rounded corners */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Add transition for smooth effect */
            margin-bottom: 10px;
            padding: 10px;
            text-align: center;
            border: 2px solid #27ae60;
            /* Oval border */
        }

        .left-bar a:hover,
        .left-bar a.selected {
            background-color: #27ae60;
            /* Change hover and selected color to dark green */
            color: #fff;
            /* Change text color to white */
        }

        /* Content Area Styles */
        .content {
            margin-left: 200px;
            padding: 20px;
        }
    </style>
    <title>Manager</title>
</head>

<body>



    <div class="top-bar">
        <div class="logo">
            <a href="<?php echo URLROOT ?>/managers/index">
                <img src="<?php echo URLROOT ?>/public/img/login/dineease-logo.svg" alt="Logo">
            </a>
        </div>
        <div class="logo-name">
            <h1>DineEase</h1>
        </div>
        <div class="user-info">
            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp;
                <?php
                $user_id = $_SESSION['user_id'];
                $profile_picture_url = URLROOT . '/uploads/profile/' . basename($_SESSION['profile_picture']);
                $user_name = $_SESSION['user_name'];
                echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user_id . '">' . $user_name . '</a>';
                ?>
            </span>
            <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>">
                <img class="profile-image" src="<?php echo $profile_picture_url; ?>" alt="Profile Image">
            </a>
        </div>
    </div>



    <!-- Left Bar -->
    <div class="left-bar">
        <ul>
            <li><a href="<?php echo URLROOT ?>/managers/getUsers" class="menu-link" id="loadContent">Users</a></li>
            <li><a href="<?php echo URLROOT ?>/managers/menu" class="menu-link" id="loadContent">Menus</a></li>
            <li><a href="<?php echo URLROOT ?>/managers/getpackages" class="menu-link">Tables</a></li>
            <li><a href="discounts.php" class="menu-link">Discounts</a></li>
            <li><a href="reviews.php" class="menu-link">Reviews</a></li>
            <li><a href="<?php echo URLROOT ?>/users/logout" class="menu-link">Logout</a></li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
        <!-- Content of the selected page will be loaded here -->
        <?php
        // Check if a page is selected
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            include("$page.php"); // Load the selected page
        }
        ?>
    </div>
    <script>
        $(document).ready(function() {
            // Function to load content using AJAX
            function loadContent(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        // Update the content area with the loaded content
                        $('.content').html(data);

                        // Highlight the corresponding menu item based on the loaded content
                        highlightMenuItem(url);
                    },
                    error: function(error) {
                        console.error("Error loading content:", error);
                    }
                });
            }

            // Check if a page is selected
            function loadDefaultContent() {
                // Use AJAX to load the content of the default page
                loadContent('<?php echo URLROOT ?>/managers/getUsers');
            }

            // Highlight the initially selected menu item on page load
            loadDefaultContent();

            // Function to highlight the corresponding menu item based on the loaded content
            function highlightMenuItem(url) {
                // Remove the 'selected' class from all menu items
                $('.left-bar a').removeClass('selected');

                // Find the menu item with a matching href
                var matchingMenuItem = $('.left-bar a[href="' + url + '"]');
                if (matchingMenuItem.length === 0) {
                    // If no direct match, try matching using the relative path
                    matchingMenuItem = $('.left-bar a[href="' + url.replace('<?php echo URLROOT ?>', '') + '"]');
                }

                // Add the 'selected' class to the matched menu item
                matchingMenuItem.addClass('selected');
            }

            $('.menu-link').on('click', function(e) {
                // Check if the clicked menu item has an 'id' attribute
                if ($(this).attr('id') === 'loadContent') {
                    e.preventDefault();

                    // Use AJAX to load the content of the selected page
                    loadContent($(this).attr('href'));
                }
            });
        });
    </script>

</body>

</html>