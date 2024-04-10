<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/inventorymanager-styles.css">
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
                            <span class="material-symbols-outlined material-symbols-outlined-topbar ">notifications </span>
                            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                            <img src="<?php echo URLROOT ?>/public/img/login/profilepic.png" alt="profile-photo" class="profile" />
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
                                <a href="<?php echo URLROOT ?>/inventoryManagers/index" class="nav_link" onclick="changeContent('index')">
                                    <button class="button-sidebar-menu ">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Home </span>
                                    </button>
                                </a>
                            </li>

                            <li class="item">
                                <a href="<?php echo URLROOT ?>/inventoryManagers/inventory" class="nav_link">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                inventory_2
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Inventory </span>
                                    </button>
                                </a>
                            </li>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/inventoryManagers/alert" class="nav_link">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                notifications_active
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Alerts </span>
                                    </button>
                                </a>
                            </li>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/inventoryManagers/grn" class="nav_link">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                shopping_cart_checkout
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">GRN </span>
                                    </button>
                                </a>
                            </li>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/inventoryManagers/markOut" class="nav_link">
                                    <button class="button-sidebar-menu active-nav">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                export_notes
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Mark Out </span>
                                    </button>
                                </a>
                            </li>
                            <!-- End -->


                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/inventoryManagers/profile" class="nav_link">
                                    <button class="button-sidebar-menu">
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
        <div class="body-template" id="content">
            <div class="container3">
                <div class="tabs2">
                    <button class="tablinks" onclick="openTab(event, 'tab1')">Inventory Issue</button>
                    <button class="tablinks" onclick="openTab(event, 'tab2')">Leftover Stock</button>
                    <button class="tablinks" onclick="openTab(event, 'tab3')">Inventory Expiry-soon</button>
                </div>

                <div id="tab1" class="tabcontent2">
                    <form class="form2" style="display: block;">
                        <h4>Inventory Issue Update</h4>
                        <label2 for="inventoryName">Inventory ID:</label><br>
                            <input type="text" id="inventoryName" name="inventoryName" style="margin-bottom: 30px;"></br>

                            <label2 for="quantity">Quantity issued:</label2><br>
                            <input type="number" id="quantity" name="quantity" style="margin-bottom: 30px;"><br>

                            <label2 for="batchCode">Batch Code:</label2><br>
                            <input type="text" id="batchCode" name="batchCode" style="margin-bottom: 30px;"><br>

                            <label for="date">Expiry Date:</label><br>
                            <input type="date" id="date" name="date"><br>

                            <div class="form-buttons2">
                                <button type="button" onclick="saveForm()">Save & Close</button>
                                <button type="button" onclick="deleteForm()">Delete</button>
                            </div>
                    </form>
                </div>

                <div id="tab2" class="tabcontent2" style="display: none;">
                    <form class="form2">
                        <h2>Leftover Stock</h2>
                        <label for="date">Date:</label><br>
                        <input type="date" id="date" name="date"><br>

                        <label class="form label2" for="inventoryType">Category: </label>:</label><br>
                        <select id="inventoryType" class="form-select" name="inventoryType">
                            <option value="type1">Vegetables</option>
                            <option value="type2">Fruits</option>
                            <option value="type3">Spices</option>
                            <option value="type3">Meat</option>
                            <option value="type3">Frozen items</option>
                        </select><br>

                        <label for="inventoryName">Inventory Name:</label><br>
                        <input type="text" id="inventoryName" name="inventoryName"><br>

                        <label for="inventoryName">Inventory ID:</label><br>
                        <input type="text" id="inventoryName" name="inventoryName"><br>

                        <label for="remainingQty">Remaining Quantity:</label><br>
                        <input type="number" id="remainingQty" name="remainingQty"><br>

                        <label for="expiryDate">Expiry Date:</label><br>
                        <input type="date" id="expiryDate" name="expiryDate"><br>

                        <label for="batchCode">Batch Code:</label><br>
                        <input type="text" id="batchCode" name="batchCode"><br>

                        <div class="form-buttons2">
                            <button type="button" onclick="saveForm()">Save & Close</button>
                            <button type="button" onclick="deleteForm()">Delete</button>
                        </div>
                    </form>
                </div>

                <div id="tab3" class="tabcontent2" style="display: none;">
                    <h4>Inventory expiry-soon</h4>
                    <table class="data-table">
                        <tr>
                            <th>Category</th>
                            <th>Inventory name</th>
                            <th>Inventory ID 2</th>
                            <th>Batch number</th>
                            <th>Expire date</th>
                            <th>Days remaining</th>
                            <th>ROQ</th>
                        </tr>
                        <tr>
                            <th>Vegetable</th>
                            <th>Carrots</th>
                            <th>3456</th>
                            <th>20</th>
                            <th>12/11/2023</th>
                            <th>Days remaining</th>
                            <th>20</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
        <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>