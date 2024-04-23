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
                                    <button class="button-sidebar-menu active-nav">
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
                                    <button class="button-sidebar-menu">
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
            <div class="main-content>
 
 <div class=" container">
                <div class="tabs">
                    <button class="tab" id="viewsTab">Inventory list</button>
                    <button class="tab" id="statsTab">Stats</button>
                </div>
            </div>

            <div class="content" id="viewsContent">
                <div class="search-bar">
                    <input type="text" placeholder="Search..." id="searchInput">
                    <button onclick="searchFunction()" class="button">Search</button>
                </div>
<!--
                <div class="checkboxes">
                    <label><input type="checkbox" name="category" value="Category1"> Category</label>
                    <label><input type="checkbox" name="category" value="Category2"> Inventory Name</label>
                    <label><input type="checkbox" name="category" value="Category3"> Inventory ID</label>
                    <label><input type="checkbox" name="category" value="Category1"> Description</label>
                    <label><input type="checkbox" name="category" value="Category2"> Current Quantity</label>
                    <label><input type="checkbox" name="category" value="Category3"> Value</label>
                    <label><input type="checkbox" name="category" value="Category3"> Date issued</label>
                    <label><input type="checkbox" name="category" value="Category3"> ROQ level</label>

                </div>
-->
                <div class="table-container">
                    <table class="table">
                        <tr class="table-heading">
                            <th>ItemID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>As on Date</th>
                            <th>Expire Date</th>
                            <th>Batch Code</th>
                            <th>Description</th>
                            <th>Cost (LKR)</th>
                            <th>ROQ Level</th>
                            
                            <!--<th>Supplier</th>-->
                        </tr> 
                        <?php
        // Assuming $items is your array of items with keys like 'ItemID', 'ItemName', 'Quantity', 'Supplier'
        foreach ($data['inventory'] as $item) {
            echo '<tr>';
            echo '<td>' . $item->inventoryID . '</td>';
            echo '<td>' . $item->inventoryname . '</td>';
            echo '<td>' . $item->quantitylevel . '</td>';
            echo '<td>' . $item->asondate . '</td>';
            echo '<td>' . $item->expiredate . '</td>';
            echo '<td>' . $item->batchcode . '</td>';
            echo '<td>' . $item->description . '</td>';
            echo '<td>' . $item->cost . '</td>';
            //echo '<td>' . $item->quantityadded . '</td>';
            echo '<td>' . $item->roqlevel . '</td>';
            //echo '<td>' . $item->supplierInfo . '</td>';
            echo '</tr>';
        }
        ?>
                        
                            <!--rest of the table
                            <th>Description</th>
                            <th> Value</th>
                            <th>Date issued</th>
                            <th>ROQ level</th>
                            <th>Edit</th>-->
                       
                        
                            <!--rest of the table
                            <tr>
                 </tr>
                 
                 <td>
                <button onclick="openEditForm()">Edit</button>
                 </td>
</tr>

<div id="editForm" class="form-popup">
<div class="form-container">
 <h2>Edit Details</h2>
 <form>
   <label for="editableField1">Editable Field 1:</label><br>
   <input type="text" id="editableField1" name="editableField1"><br>
   <label for="editableField2">Editable Field 2:</label><br>
   <input type="text" id="editableField2" name="editableField2"><br>
   <label for="nonEditableField1">Non-editable Field 1:</label><br>
   <input type="text" id="nonEditableField1" name="nonEditableField1" readonly><br>
   <label for="nonEditableField2">Non-editable Field 2:</label><br>
   <input type="text" id="nonEditableField2" name="nonEditableField2" readonly><br><br>
   <button type="submit" class="edit-btn">Save</button>
   <button class="close-btn" onclick="closeEditPopup()">Close</button>
 </form>
</div>
</div>-->
                    </table>
                </div>
<!--
                <button class="cat-button" onclick="openForm()">Manage Category</button>

                <div id="categoriesForm" class="form-popup">
                    <div class="form-container">
                        <h3>Manage Categories</h3>
                        <ul id="categoriesList">
                            <li contenteditable="true">Fruits</li>
                            <li contenteditable="true">Vegetable</li>
                            <li contenteditable="true">Meat</li>
                            <li contenteditable="true">Frozen items</li>
                            <li contenteditable="true">Spices</li>
                        </ul>
                        <input type="text" placeholder="Enter new category" id="newCategoryInput">
                        <button class="close-btn" onclick="addCategory()">Add Category</button>
                        <button type="button" class="close-btn" onclick="closeForm()">Close</button>
                    </div>
                </div>
-->

                <div class="content" id="statsContent" style="display: none;">
                    <!-- Content for the Stats tab -->


                    <div class="charts">
                        <div id="chart1" class="chart-container">
                            <!-- Chart 1 description -->
                        </div>
                        <div id="chart2" class="chart-container">
                            <!-- Chart 2 description -->
                        </div>
                    </div>

                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Search...">
                        <!-- Filters and search functionality -->
                        <button onclick="search()">Search</button>
                    </div>

                    <div id="graphRepresentation" class="graph-representation">
                        <!-- Graphical representations based on the search results -->
                    </div>

                    <div class="buttons">
                        <button onclick="printGraphs()">Print</button>
                        <button onclick="exportGraphs()">Export</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
    <script src="<?php echo URLROOT; ?>/js/inventorymanager.js"></script>
    
</body>

</html>