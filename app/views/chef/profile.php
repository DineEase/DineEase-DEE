<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/toastr.css ">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title><?php echo SITENAME; ?></title>
</head>
<style>
    /* Modern look for input fields */
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
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/chefs/index" class="nav_link " onclick="changeContent('home')">
                                    <button class="button-sidebar-menu ">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Dashboard </span>
                                    </button>
                                </a>
                            </li>

                            <li class="item">
                                <a href="<?php echo URLROOT ?>/chefs/order" class="nav_link" onclick="changeContent('order')">
                                    <button class="button-sidebar-menu ">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                list_alt
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Orders </span>
                                    </button>
                                </a>
                            </li>
                            <!-- End -->

                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/chefs/profile" class="nav_link">
                                    <button class="button-sidebar-menu active-nav">
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
            <?php flash('password_error'); ?>
            <?php flash('password_success'); ?>
            <div id="content">
                <div id="overlay-profile" class="overlay-profile"></div>

                <div class="profile-container">
                    <!-- //TODO: Add the form to change user details -->
                    <div id="change-password-div" class="change-password-div">
                        <form action="<?php echo URLROOT; ?>/profiles/changePassword" class="change-password" method="post">
                            <h2>Change User Name & Password</h2>
                            <label for="old-psw">Old Password</label>
                            <input type="password" id="old-psw" name="old-psw" required>
                            <label for="new-psw">New Password</label>
                            <input type="password" id="new-psw" name="new-psw" required>
                            <label for="confirm-psw">Confirm New Password</label>
                            <input type="password" id="confirm-psw" name="confirm-psw" required>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                    <div class="user-header">
                        <h2>User Profile</h2>
                        <img class="heroimage" src="<?php echo URLROOT ?>/img/profilePhotos/<?php echo $_SESSION['profile_picture'] ?>" alt="Avatar">
                    </div>
                    <div class="buttons">
                        <button id="change-user-password" class="change-btn"><i class="fa-solid fa-lock"></i> Change Password</button>
                        <button class="update" id="update-dp"><i class="fa-solid fa-square-pen"></i> Update Picture</button>
                    </div>
                    <!-- //TODO: Add the form to change user Details -->

                    <!-- //TODO  Delete the old images when an new image is uploaded -->
                    <div id="overlay-profile" class="overlay-profile"></div>
                    <div class="profilecard">
                        <div class="card-body">
                            <form action="<?php echo URLROOT; ?>/profiles/updateUserDetails" method="post">
                                <table>
                                    <tr>
                                        <td>
                                            <p class="profdetails">User Name</p>
                                        </td>
                                        <td>:</td>
                                        <td><input type="text" name="user_name" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="profdetails">Email Address</p>
                                        </td>
                                        <td>:</td>
                                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="profdetails">Contact Number</p>
                                        </td>
                                        <td>:</td>
                                        <td><input type="text" name="mobile_no" value="<?php echo htmlspecialchars($_SESSION['mobile_no']); ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <button type="button" id="change-user-details" class="change-btn">Change Details</button>
                                        <button type="button" id="cancel-user-details" class="change-btn" style="display:none;">Cancel</button>
                                        <input type="submit" id="update-user-details" class="change-btn" value="Update Details" style="display:none;">

                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="upload-container" id="upload-container">
                        <h2>Upload New Profile Picture:</h2>
                        <hr>
                        <form action="<?php echo URLROOT ?>/profiles/uploadUserImage" method="post" enctype="multipart/form-data">
                            <label for="file-upload" class="file-input">
                                <input type="file" class="uploadb-file-input" id="file-upload" name="photo" accept=".jpg, .jpeg, .png" required>
                                <span id="file-name" class="uploadb-file-name"></span>
                            </label>
                            <button type="submit" id="upload-dp-btn" class="upload-btn button-disabled">Upload Photo</button>
                        </form>
                    </div>

                    <div class="loyalty-container">
                        <h2>Loyalty Points</h2>
                        <p>Your current loyalty points: <span class="loyalty-points">250</span></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <!-- <script src="<?php echo URLROOT; ?>/js/customer.js"></script> -->
    <script src="<?php echo URLROOT; ?>/js/user-profile.js"></script>
    <script src="<?php echo URLROOT; ?>/js/toastr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling success messages
            <?php if (isset($_SESSION['ppsuccess_message'])) : ?>
                toastr.success('<?php echo $_SESSION['ppsuccess_message']; ?>');
                <?php unset($_SESSION['ppsuccess_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['pwsuccess_message'])) : ?>
                toastr.success('<?php echo $_SESSION['pwsuccess_message']; ?>');
                <?php unset($_SESSION['pwsuccess_message']); ?>
            <?php endif; ?>

            // Handling general error notifications
            <?php if (isset($_SESSION['error_message'])) : ?>
                toastr.error('<?php echo $_SESSION['error_message']; ?>');
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            // Handling specific error notifications for password change
            <?php if (isset($_SESSION['password_error'])) : ?>
                toastr.error('<?php echo $_SESSION['password_error']; ?>');
                <?php unset($_SESSION['password_error']); ?>
            <?php endif; ?>

            // Handling multiple errors stored in an array
            <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) : ?>
                <?php foreach ($_SESSION['errors'] as $error) : ?>
                    toastr.error('<?php echo $error; ?>');
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        });

        document.getElementById('change-user-details').addEventListener('click', function() {
            var mobileInput = document.querySelector('input[name="mobile_no"]');
            var emailInput = document.querySelector('input[name="email"]');
            var userName = document.querySelector('input[name="user_name"]');
            userName.readOnly = false;
            emailInput.readOnly = false;
            mobileInput.readOnly = false;

            mobileInput.addEventListener('input', function(e) {
                var nonNumericRemoved = this.value.replace(/\D/g, '');
                if (nonNumericRemoved.length > 10) {
                    nonNumericRemoved = nonNumericRemoved.substr(0, 10);
                }
                this.value = nonNumericRemoved;
            });

            document.getElementById('update-user-details').style.display = 'inline';
            document.getElementById('cancel-user-details').style.display = 'inline';
            document.getElementById('change-user-details').style.display = 'none';
        });
        document.getElementById('cancel-user-details').addEventListener('click', function() {
            var mobileInput = document.querySelector('input[name="mobile_no"]');
            var emailInput = document.querySelector('input[name="email"]');
            var userName = document.querySelector('input[name="user_name"]');
            userName.readOnly = true;
            emailInput.readOnly = true;
            mobileInput.readOnly = true;

            document.getElementById('update-user-details').style.display = 'none';
            document.getElementById('cancel-user-details').style.display = 'none';
            document.getElementById('change-user-details').style.display = 'inline';
        });
    </script>

</body>

</html>