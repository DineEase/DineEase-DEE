<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">

    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <span class="material-symbols-outlined material-symbols-outlined-topbar ">notifications
                            </span>
                            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; |
                                &nbsp; <?php echo $_SESSION['user_name'] ?></span>
                            <img src="<?php echo URLROOT ?>/public/img/login/profilepic.png" alt="profile-photo"
                                class="profile" />
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
                                <a href="<?php echo URLROOT ?>/inventoryManagers/index" class="nav_link"
                                    onclick="changeContent('index')">
                                    <button class="button-sidebar-menu active-nav">
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
                            
                            <!-- <li class="item">
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
                            </li> -->
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
            <div class="tabset">
                <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                <label for="tab1">Dash Board</label>
                <div class="tab-panels">
                    <section id="view" class="tab-panel">
                        <div class="mbody">
                            <div class="container3">
                                <div class="dashtop">
                                    <button id="prev" class="dashmove">Previous<< </button>
                                            <div class="stock-container">
                                                <div class="stock-tile">
                                                    <button class="report">stovk</button>
                                                </div>
                                                <div class="stock-tile">
                                                    <button class="report">Stock</button>
                                                </div>

                                                <div class="stock-tile">
                                                    <button class="report">Report 1</button>Stock 1
                                                </div>

                                                <div class="stock-tile">
                                                    <button class="report">Report 1</button>Stock 1
                                                </div>

                                                <div class="stock-tile">
                                                    <button class="report">Report 1</button>Stock 1
                                                </div>

                                                <div class="stock-tile">
                                                    <button class="report">Report 1</button>Stock 1
                                                </div>

                                            </div>
                                            <button id="next" class="dashmove">>>Next</button>
                                </div>
                            </div>
                        </div>
                        <div class="mbody">
                            <div class="container3">
                                <div class="main-content">
                                    <button id="changeCategory">Change Category</button>
                                    <button id="changeInventory">Change Inventory</button>
                                </div>

                                <div id="changeCategoryModal" class="modal">
                                    <div class="dashcontent">
                                        <span class="close">&times;</span>
                                        <h2>New Category</h2>
                                        <form id="changeCategoryForm">
                                            <label for="categoryName">Category Name:</label>
                                            <input type="text" id="categoryName" name="categoryName">

                                            <label for="categoryCode">Category Code:</label>
                                            <input type="text" id="categoryCode" name="categoryCode">

                                            <button class="save" type="submit" id="saveCategory">Save</button>
                                            <button class="closeModal" type="button" id="closeCategory">Close</button>
                                        </form>
                                    </div>
                                </div>

                                <div id="changeInventoryModal" class="modal">
                                    <div class="dashcontent">
                                        <span class="close">&times;</span>
                                        <h2>New Inventory</h2>
                                        <form id="changeInventoryForm">

                                            <label for="inventoryCategorySelect">Select Category:</label>
                                            <select id="inventoryCategorySelect" name="inventoryCategorySelect">

                                            </select>

                                            <label for="inventoryName">Inventory Name:</label>
                                            <input type="text" id="inventoryName" name="inventoryName">

                                            <label for="inventoryCode">Inventory Code:</label>
                                            <input type="text" id="inventoryCode" name="inventoryCode">

                                            <label for="roqLevel">Inventory RPQ Level:</label>
                                            <input type="text" id="roqLevel" name="roqLevel">

                                            <label for="units">Inventory Units:</label>
                                            <input type="text" id="units" name="units">
                                            <br>
                                            <button class="save" type="submit" id="saveInventory">Save</button>
                                            <button class="closeModal" type="button" id="closeInventory">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="<?php echo URLROOT; ?>/public/js/customer.js"></script> -->

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                let currentIndex = 0;
                const stockContainer = document.querySelector('.stock-container');
                const stockTiles = document.querySelectorAll('.stock-tile');
                const prevButton = document.getElementById('prev');
                const nextButton = document.getElementById('next');

                function updateTiles() {
                    stockContainer.scrollLeft = currentIndex * 110; // Adjust based on the size of your tiles and margin
                }

                prevButton.addEventListener('click', function () {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateTiles();
                    }
                });

                nextButton.addEventListener('click', function () {
                    if (currentIndex < stockTiles.length - 3) {
                        currentIndex++;
                        updateTiles();
                    }
                });

                document.getElementById('changeCategory').addEventListener('click', function () {
                    document.getElementById('changeCategoryModal').style.display = 'block';
                });

                document.getElementById('changeInventory').addEventListener('click', function () {
                    document.getElementById('changeInventoryModal').style.display = 'block';
                });

                // Function to close modals
                function closeModal(modalId) {
                    document.getElementById(modalId).style.display = 'none';
                }

                // Add event listeners to close modals
                document.querySelectorAll('.close').forEach(function (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        closeModal(closeBtn.closest('.modal').id);
                    });
                });

                // Event listener for 'Close' button inside the 'Change Category' modal
                document.getElementById('closeCategory').addEventListener('click', function () {
                    closeModal('changeCategoryModal');
                });

                // Event listener for 'Close' button inside the 'Change Inventory' modal
                document.getElementById('closeInventory').addEventListener('click', function () {
                    closeModal('changeInventoryModal');
                });

                // Close the modals if the user clicks outside the content area
                window.addEventListener('click', function (event) {
                    const categoryModal = document.getElementById('changeCategoryModal');
                    const inventoryModal = document.getElementById('changeInventoryModal');

                    if (event.target == categoryModal) {
                        closeModal('changeCategoryModal');
                    }

                    if (event.target == inventoryModal) {
                        closeModal('changeInventoryModal');
                    }
                });

                // Event listener for form submission (Category form)
                document.getElementById('changeCategoryForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const categoryName = document.getElementById('categoryName').value;
                    const categoryCode = document.getElementById('categoryCode').value;

                    // Validation for category form
                    if (categoryName.trim() === '' || categoryCode.trim() === '') {
                        alert('Please fill in all fields.');
                        return;
                    }

                    // AJAX request to add category
                    fetch('<?php echo URLROOT; ?>/inventoryManagers/addCategory', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            categoryName: categoryName,
                            categoryCode: categoryCode,
                        }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Category added successfully!');
                                closeModal('changeCategoryModal');
                                fetchCategories(); // Refresh categories after adding a new one
                            } else {
                                alert('Error adding category. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while adding the category. Please try again.');
                        });
                });


                // Function to fetch categories
                function fetchCategoriesAndPopulateDropdown() {
                    fetch('<?php echo URLROOT; ?>/inventoryManagers/fetchCategories')
                        .then(response => response.json())
                        .then(data => {
                            const categorySelect = document.getElementById('inventoryCategorySelect');

                            // Clear existing options
                            categorySelect.innerHTML = '';

                            // Add an option for each category
                            data.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.categoryID;
                                option.textContent = `${category.categoryName} (${category.categoryCode})`;
                                categorySelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching categories:', error);
                            alert('An error occurred while fetching categories. Please try again.');
                        });
                }

                // Call the function to fetch categories and populate the dropdown when the page loads
                fetchCategoriesAndPopulateDropdown();

                // Event listener for category dropdown change
                document.getElementById('inventoryCategorySelect').addEventListener('change', function () {
                    const categoryID = this.value;
                    // Call the function to fetch inventory data by category ID
                    fetchInventoryByCategory(categoryID);
                });

                // Event listener for form submission (Inventory form)
                document.getElementById('changeInventoryForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    const categoryID = document.getElementById('inventoryCategorySelect').value;
                    const inventoryName = document.getElementById('inventoryName').value;
                    const inventoryCode = document.getElementById('inventoryCode').value;
                    const roqLevel = document.getElementById('roqLevel').value;
                    const units = document.getElementById('units').value;

                    // Validation for inventory form
                    if (categoryID.trim() === '' || inventoryName.trim() === '' || inventoryCode.trim() === '' || roqLevel.trim() === '' || units.trim() === '') {
                        alert('Please fill in all fields.');
                        return;
                    }

                    // AJAX request to add inventory
                    fetch('<?php echo URLROOT; ?>/inventoryManagers/addInventory', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            categoryID: categoryID,
                            inventoryName: inventoryName,
                            inventoryCode: inventoryCode,
                            roqLevel: roqLevel,
                            units: units
                        }),
                    })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error('Server error. Please try again.');
                            }
                        })
                        .then(data => {
                            // Handle the server response
                            if (data.success) {
                                alert('Inventory added successfully!');
                                // Optionally, you can reset the form after successful submission
                                document.getElementById('changeInventoryForm').reset();
                            } else {
                                alert(`Error adding inventory: ${data.message}`);
                            }
                        })
                        .catch(error => {
                            // Handle any network errors or exceptions
                            console.error('Error:', error);
                            alert('An error occurred while adding the inventory. Please try again.');

                        });
                });
            });

        </script>

</body>

</html>