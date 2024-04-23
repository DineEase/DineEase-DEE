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

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        font-size: 3rem;
        margin: 2rem 0;
    }

    .editmenu {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }


    .imagePart img {
        margin-top: 20px;
        width: 350px;
        height: 400px;
        border-radius: 1rem;
        object-fit: cover;
        border: 5px solid #2c3e50;
    }

    .imagePart span {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.5rem 1.5rem;
        border-radius: 0.5rem;
        background-color: #000000;
        color: #ffffff;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .NamePart input,
    .NamePart select {
        width: 100%;
        padding: 1rem;
        font-size: 1.2rem;
        border: none;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .invalid-feedback {
        color: #ff0000;
        /* Red color for error messages */
        font-size: 1rem;
        margin-top: 5px;
        display: block;
    }

    .buttons button {
        color: #ffffff;
        background-color: #030303;
        outline: none;
        border: none;
        font-size: 1.5rem;
        padding: 1rem 2rem;
        margin-right: 0.7rem;
        border-radius: 0.5rem;
        cursor: pointer;
    }

    .imgbuttons button {
        color: #ffffff;
        background-color: #030303;
        outline: none;
        border: none;
        font-size: 1.5rem;
        padding: 1rem 2rem;
        margin-top: 1rem;
        margin-right: 0.7rem;
        margin-left: 5rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        cursor: pointer;
    }

    .menubuttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .buttons,
    .menubuttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1rem;
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
        <div class="editmenu">
            <div class="others">
                <div class="imagePart">
                    <img src="<?php echo URLROOT . '/uploads/' . basename($data['imagePath']); ?>" alt="Menu Item Image" />
                    <div class="imgbuttons">
                        <form action="<?php echo URLROOT; ?>/managers/editMenuitem/<?php echo $data['itemID']; ?>" method="post" enctype="multipart/form-data" id="menuForm">
                            <button type="button" id="imageButton">Edit Image</button>
                            <input type="file" name="imagePath" accept="image/*" style="display: none;" id="imageInput" onchange="previewImage(event)">
                    </div>
                </div>
               
                <div class="NamePart">
                    <label for="category">Select Category:</label>
                    <select id="category" name="category" required>
                        <?php foreach ($data['menucategory'] as $category) : ?>
                            <?php $selected = ($category->category_ID == $data['category_ID']) ? 'selected' : ''; ?>
                            <option value="<?php echo $category->category_ID; ?>" <?php echo $selected; ?>>
                                <?php echo $category->category_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <span>Name:</span> <?php echo htmlspecialchars($data['itemName']); ?>
                    <input type="text" name="itemName" class="<?php echo (!empty($data['itemName_err'])) ? 'is-invalid' : '' ?>" placeholder="Name" required value="<?php echo $data['itemName']; ?>" />
                    <span class="invalid-feedback"> <?php echo $data['itemName_err'] ?> </span>
                    <span>Price(Small):</span> <?php echo htmlspecialchars($data['pricesmall']); ?>
                    <input type="text" name="pricesmall" placeholder="Price(small)" value="<?php echo htmlspecialchars($data['pricesmall']); ?>" />
                    <span class="invalid-feedback"> <?php echo $data['price_err'] ?> </span>
                    <span>Price(Regular):</span> <?php echo htmlspecialchars($data['priceregular']); ?>
                    <input type="text" name="priceregular" placeholder="Price(Regular)" class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : '' ?>" required value="<?php echo htmlspecialchars($data['priceregular']); ?>" />
                    <span class="invalid-feedback"> <?php echo $data['price_err'] ?> </span>
                    <span>Price(Large):</span> <?php echo htmlspecialchars($data['pricelarge']); ?>
                    <input type="text" name="pricelarge" placeholder="Price(Large)"value="<?php echo htmlspecialchars($data['pricelarge']); ?>" />
                    <span class="invalid-feedback"> <?php echo $data['price_err'] ?> </span>
                    <span>Average Prepare Time MINS:</span> <?php echo htmlspecialchars($data['averageTime']); ?>
                    <input type="text" name="averageTime" placeholder="Time" class="<?php echo (!empty($data['averageTime_err'])) ? 'is-invalid' : '' ?>" required value="<?php echo htmlspecialchars($data['averageTime']); ?>" />
                    <span class="invalid-feedback"> <?php echo $data['averageTime_err'] ?> </span>
                    <span>Description:</span>
                    <textarea name="description" placeholder="Description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : '' ?>" required value="<?php echo htmlspecialchars($data['description']); ?>" ></textarea>
                    <span class="invalid-feedback"> <?php echo $data['description_err'] ?> </span>





                    <div class="buttons">
                        <button type="submit">Save Changes</button>
                        <button type="button" id="cancelButton">Cancel</button>
                        <button type="button" id="deleteButton" onclick="deleteMenuAlert(<?php echo $data['itemID']; ?>)">Delete</button>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <script>
        document.getElementById('imageButton').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });

        function previewImage(event) {
            var input = event.target;
            var preview = document.querySelector('.imagePart img');
            var reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        }





        function deleteMenuAlert(itemID) {
            var confirmDelete = confirm("Are you sure you want to delete this menu?");
            if (confirmDelete) {
                // Redirect to the delete endpoint on the server
                window.location.href = "<?php echo URLROOT; ?>/managers/deleteMenuitem/" + itemID;
            }
        }
    </script>
    <script>
        // Get the cancel button element by its ID
        var cancelButton = document.getElementById('cancelButton');

        // Add click event listener to the cancel button
        cancelButton.addEventListener('click', function(event) {
            // Redirect to the index page when the button is clicked
            window.location.href = '<?php echo URLROOT; ?>/managers/menu';
        });
    </script>

</body>

</html>