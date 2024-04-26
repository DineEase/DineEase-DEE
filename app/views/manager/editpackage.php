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
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    textarea {
        height: 100px;
    }

    button[type="submit"] {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

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

    .package-image {
        width: 300px;
        /* adjust the width as needed */
        height: auto;
        /* maintain aspect ratio */
        border-radius: 10px;
        /* add rounded corners */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* add a subtle shadow */
        /* You can add more styles here */
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
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/reports" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            lab_profile
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reports</span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/reservations" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu  " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            book_online
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reservations</span>
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
        <div class="discount-details">
            <h2>Package Details</h2>
            <img class="package-image" src="<?php echo URLROOT; ?>/uploads/package/<?php echo basename($data['package']->image); ?>" alt="Package Image">
            <p><strong>Package ID:</strong> <?php echo $data['package']->packageID; ?></p>
            <p><strong>Package Name:</strong> <?php echo $data['package']->packageName; ?></p>
            <p><strong>TAX:</strong> <?php echo $data['package']->tax; ?></p>
            <p><strong>Capacity:</strong><?php echo $data['package']->capacity; ?>%</p>
            <p><strong>Description:</strong> <?php echo $data['package']->description; ?></p>

        </div>
        <h1>Edit Package</h1>
        <form action="<?php echo URLROOT; ?>/managers/editpackage/" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="packageID" value="<?php echo $data['package']->packageID; ?>">
            <div>
                <label for="packagename">Package Name:</label>
                <input type="text" id="name" name="packageName" value="<?php echo $data['package']->packageName; ?>"required>
                <span class="error"><?php echo $data['packagename_err']; ?></span>
            </div>
            <div>
                <label for="tax">VAT or TAX:</label>
                <input type="number" id="tax" name="tax" min="0" value="<?php echo $data['package']->tax; ?>"required>
                <span class="error"><?php echo $data['vat_err']; ?></span>
            </div>
            
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"required><?php echo $data['package']->description; ?> </textarea>
                <span class="error"><?php echo $data['description_err']; ?></span>
            </div>
            <div>
                <button type="button" id="imageButton" onclick="openFilePicker()">Edit Image</button>
                <input type="file" name="imagePath" accept="image/*" style="display: none;" id="imageInput" onchange="previewImage(event)">
                <br>
                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 300px; max-height: 300px;">
            </div>

            <button type="submit">Save Changes</button>
        </form>
    </div>
<script>
    function openFilePicker() {
    document.getElementById('imageInput').click();
}

function previewImage(event) {
    var imagePreview = document.getElementById('imagePreview');
    var imageInput = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function() {
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
    }

    if (imageInput) {
        reader.readAsDataURL(imageInput);
    }
}
</script>
</body>

</html>