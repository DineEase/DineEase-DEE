<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/manager-style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
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
        max-width: 900px;
        margin-top: 20px;
        margin: 20px auto;
        background-color: #fff;
        padding: 50px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .add-table-link {
        display: inline-block;
        margin-bottom: 10px;
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .add-table-link:hover {
        background-color: #0056b3;
    }


        /* Styling for filter form */
        #filterForm {
            margin-bottom: 20px;
        }

        /* Styling for table */
        #tableData {
            width: 100%;
            border-collapse: collapse;
        }

        #tableData th, #tableData td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #tableData th {
            background-color: #f2f2f2;
        }

        #tableData tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <title><?php echo SITENAME; ?></title>
</head>

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
                        <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>">
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
                            <a href="<?php echo URLROOT; ?>/managers/viewtables" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu active-nav" id="reservationButton">
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

                            <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu " id="reservationButton">
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
    <form id="filterForm" method="post" action="<?php echo URLROOT; ?>/managers/viewtables">
        <label for="packageFilter">Filter by Package:</label>
        <select id="packageFilter" name="packageID">
            <option value="">All Packages</option>
            <?php foreach ($data['packages'] as $package) : ?>
                <?php
                // Check if the current package matches the selected package ID
                $selected = ($package->packageID == $_POST['packageID']) ? 'selected' : '';
                ?>
                <option value="<?php echo $package->packageID; ?>" <?php echo $selected; ?>><?php echo $package->packageName; ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <a href="<?php echo URLROOT; ?>/managers/addtable" class="add-table-link">Add Table</a>
    <table id="tableData">
    <thead>
        <tr>
            <th>Table Name</th>
            <th>Capacity</th>
            <th>Package Name</th>
            <th>Delete</th>
            <th>Visibility</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['tables'] as $table) : ?>
            <tr id="table_<?php echo $table->tableID; ?>">
                <td><?php echo $table->table_name; ?></td>
                <td><?php echo $table->capacity; ?></td>
                <td><?php echo $table->packageName; ?></td>
                <td>
                    <form id="deleteForm_<?php echo $table->tableID; ?>" method="post" action="<?php echo URLROOT; ?>/managers/deletetable">
                        <input type="hidden" name="table_id" value="<?php echo $table->tableID; ?>">
                        <a href="#" onclick="deleteTable(<?php echo $table->tableID; ?>);">Delete</a>
                    </form>
                </td>
                <td>
                    <?php if ($table->hidden == 0) : ?>
                        Visible
                        <button onclick="toggleVisibility(<?php echo $table->tableID; ?>, 1);">Hide</button>
                    <?php else : ?>
                        Hidden
                        <button onclick="toggleVisibility(<?php echo $table->tableID; ?>, 0);">Show</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>

    <script>
        function deleteTable(tableID) {
        var formID = 'deleteForm_' + tableID;
        document.getElementById(formID).submit();
    }
        // JavaScript to filter the table dynamically using AJAX
        document.getElementById('packageFilter').addEventListener('change', function() {
            document.getElementById("filterForm").submit();
            var packageID = this.value;
            var selectedPackageID = packageID; // Save the selected package ID

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Clear previous table data
                    document.getElementById("tableData").innerHTML = "<tr><td colspan='3'>Loading...</td></tr>";

                    // Update table with filtered data
                    document.getElementById("tableData").innerHTML = this.responseText;

                    // Set the selected option back after updating the table data
                    document.getElementById("packageFilter").value = selectedPackageID;
                }
            };
            xhttp.open("POST", "<?php echo URLROOT; ?>/managers/viewtables", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("packageID=" + packageID);

        });
        function toggleVisibility(tableID, visibility) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var tableRow = document.getElementById('table_' + tableID);
            if (visibility == 0) {
                tableRow.querySelector('td:last-child').innerHTML = 'Hidden<button onclick="toggleVisibility(' + tableID + ', 0);">Show</button>';
            } else {
                tableRow.querySelector('td:last-child').innerHTML = 'Visible<button onclick="toggleVisibility(' + tableID + ', 1);">Hide</button>';
            }
            window.location.reload();
        }
    };
    xhttp.open("POST", "<?php echo URLROOT; ?>/managers/tablevisibility", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("tableID=" + tableID + "&visibility=" + visibility);
}

    </script>

</body>

</html>