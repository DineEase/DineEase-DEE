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
    /* Add your CSS styles here */
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .add-user-button,
    .search-button {
        padding: 10px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        margin-top: 15px;
    }

    .add-user-button:hover,
    .search-button:hover {
        background-color: #2980b9;
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

    .buttonGroup {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    button[type="reset"] {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        padding: 8px;
    }

    button[type="reset"]:hover {
        background-color: #c0392b;
    }

    .home-link {
        padding: 10px;
        background-color: #2ecc71;
        /* Change the background color as per your design */
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
        margin-top: 15px;
    }

    .home-link:hover {
        background-color: #27ae60;
        /* Change the background color on hover as per your design */
    }

    td.name-cell a {
        text-decoration: none;
        /* Remove default underline */
        color: #3498db;
        /* Set the default text color for names */
        transition: color 0.3s;
        /* Add transition for smooth color change */
    }

    td.name-cell a:hover {
        text-decoration: underline;
        /* Add underline on hover */
        color: #2980b9;
        /* Change text color on hover */
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
                                    <button class="button-sidebar-menu active-nav" id="homeButton">
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
            <form action="<?php echo URLROOT; ?>/managers/searchemployeebyname" method="GET">
                <input type="text" name="searchQuery" class="search-input" placeholder="Search by name">
                <button type="submit" class="search-button">Search</button>
            </form>

            <form id="roleFilterForm" action="<?php echo URLROOT; ?>/managers/filterbyrole" method="GET">
                <label for="role">Choose a role:</label>
                <select id="role" name="role" onchange="submitForm()">
                    <option value="All Users">All Users</option>
                    <option value="Inventory Manager">Inventory Manager</option>
                    <option value="Receptionist">Receptionist</option>
                    <option value="Chef">Chef</option>
                </select>
            </form>
        </div>

        <div class="buttonGroup">
            <a href="<?php echo URLROOT; ?>/managers/addUsers" class="add-user-button">Add New User</a>
            <a href="<?php echo URLROOT; ?>/managers/searchUsers" class="add-user-button">Promote Customer</a>
            
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Role</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr>
                        <td class="name-cell">
                            <?php echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user['user_id'] . '">' . (isset($user['name']) ? $user['name'] : $user->name) . '</a>'; ?>
                        </td>
                        <td><?php echo isset($user['email']) ? $user['email'] : $user->email; ?></td>
                        <td><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : $user->mobile_no; ?></td>
                        <td><?php echo isset($user['role_name']) ? $user['role_name'] : $user->role_name; ?></td>
                        <td><?php echo isset($user['address']) ? $user['address'] : $user->address; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!empty($data['nonactiveusers'])) : ?>
            <h2>Non-Activated Users</h2>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Role</th>
                        <th>Address</th>
                        <th>Activate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['nonactiveusers'] as $user) : ?>
                        <tr>
                            <td class="name-cell">
                                <?php echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user['user_id'] . '">' . (isset($user['name']) ? $user['name'] : $user->name) . '</a>'; ?>
                            </td>
                            <td><?php echo isset($user['email']) ? $user['email'] : $user->email; ?></td>
                            <td><?php echo isset($user['mobile_no']) ? $user['mobile_no'] : $user->mobile_no; ?></td>
                            <td><?php echo isset($user['role_name']) ? $user['role_name'] : $user->role_name; ?></td>
                            <td><?php echo isset($user['address']) ? $user['address'] : $user->address; ?></td>
                            <td><?php echo '<a href="' . URLROOT . '/managers/manuallyactivateemployee/' . $user['user_id'] . '">Activate</a>'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <script>
        function setSelectedRole() {
            var selectedRole = document.getElementById("role").value;
            localStorage.setItem("selectedRole", selectedRole);
        }

        function submitForm() {
            setSelectedRole();
            var selectedRole = document.getElementById("role").value;

            if (selectedRole === "All Users") {
                window.location.href = "<?php echo URLROOT; ?>/managers/getUsers";
            } else {
                document.getElementById("roleFilterForm").submit();
            }
        }

        function setInitialSelectedRole() {
            var selectedRole = localStorage.getItem("selectedRole");
            if (selectedRole) {
                document.getElementById("role").value = selectedRole;
            }
        }

        window.onload = setInitialSelectedRole;
    </script>

</body>

</html>