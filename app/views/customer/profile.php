<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/profile.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title><?php echo SITENAME; ?></title>
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
                        <hr class='separator'>
                        <ul class="menu_items">
                            <div class="menu_title menu_menu"></div>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/index" class="nav_link nav_link_switch" data-content='home'>
                                    <button class="button-sidebar-menu " id="homeButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Dashboard</span>
                                    </button>
                                </a>
                            </li>
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
                                    <button class="button-sidebar-menu" id="reservationButton">
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
                                    <button class="button-sidebar-menu active-nav" id="reservationButton">
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
                <div id="overlay-profile" class="overlay-profile"></div>

                <div class="profile-container">

                    <div id="change-password-div" class="change-password-div">
                        <form action="/uploadUserImage" class="change-password">
                            <h2>Change User Name & Password</h2>
                            <label for="old-psw">Old Password</label>
                            <input type="password" id="old-psw" name="old-psw" pattern="" title="" required>
                            <label for="new-psw">New Password</label>
                            <input type="password" id="new-psw" name="new-psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            <label for="confirm-psw">Confirm New Password</label>
                            <input type="password" id="confirm-psw" name="confirm-psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            <input type="submit" value="Submit">
                        </form>
                    </div>
                    <div class="user-header">
                        <h2>User Profile</h2>
                        <img class="heroimage" src="<?php echo URLROOT ?>/img/profilePhotos/<?php echo $_SESSION['profile_picture'] ?>" alt="Avatar">
                    </div>
                    <div class="buttons">
                        <button class="update" id="update-dp"><i class="fa-solid fa-square-pen"></i> Update</button>
                    </div>
                    <div id="overlay-profile" class="overlay-profile"></div>
                    <div class="profilecard">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>
                                        <p class="profdetails">User Name</p>
                                    </td>
                                    <td>:</td>
                                    <td><?php echo $_SESSION['user_name'] ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="profdetails">Email Address</p>
                                    </td>
                                    <td>:</td>
                                    <td><?php echo $_SESSION['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="profdetails">Contact Number</p>
                                    </td>
                                    <td>:</td>
                                    <td><?php echo $_SESSION['mobile_no'] ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="profdetails"></p>
                                    </td>
                                    <td></td>
                                    <td><button id="change-user-password" class="change-btn">Change Password</button></td>
                                    <td><button id="change-user-details" class="change-btn">Change Details</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="upload-container" id="upload-container">
                        <h2>Upload New Profile Picture:</h2>
                        <hr>
                        <form action="uploadUserImage" method="post" enctype="multipart/form-data">
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
        <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
        <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
        <script src="<?php echo URLROOT; ?>/js/user-profile.js"></script>

</body>

</html>