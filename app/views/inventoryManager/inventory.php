<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public//css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">

    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/inventorymanager-styles.css">
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
                <label for="tab1"> Inventory List</label>
                <input type="radio" name="tabset" id="tab2" aria-controls="add">
                <label for="tab2">Add GRN</label>

                <div class="tab-panels">
                    <section id="view" class="tab-panel">
                        <div class="mbody">
                            <div class="container3">
                                <h2 class="invh2">Inventory List</h2>

                                <div class="top-section">
                                    <div class="inventorysearch-bar">
                                        <input class="invinput" type="text" id="searchInput" placeholder="Search..."
                                            oninput="searchInventory()">
                                        <div id="searchErrorMessage" style="display: none;">No entries found.</div>
                                    </div>
                                    <div class="iventoryfilter-bar">
                                        <button class="invbutton" onclick="filterFunction()"> Filter </button>
                                        <button class="invbutton" onclick="clearAllFilters()">Clear All</button>
                                    </div>
                                </div>
                                <div class="invtable-container">
                                    <table class="invtable" id="inventoryTable">
                                        <thead>
                                            <tr>
                                                <th>Inventory Name
                                                    <div class="filter-container">
                                                        <div class="dropdown">
                                                            <button class="dropbtn"
                                                                onclick="toggleDropdown('inventoryName')"> &#9662;
                                                            </button>
                                                            <div class="dropdown-content" id="inventoryNameOptions">

                                                                <button class="apply-filter-btn"
                                                                    data-column="inventoryName"
                                                                    onclick="applyFilter('inventoryName')">Apply</button>
                                                                <button class="clear-filter-btn"
                                                                    data-column="inventoryName"
                                                                    onclick="clearFilter('inventoryName')">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Category
                                                    <div class="filter-container">
                                                        <div class="dropdown">
                                                            <button class="dropbtn"
                                                                onclick="toggleDropdown('category')">&#9662; </button>
                                                            <div class="dropdown-content" id="categoryOptions">
                                                                <!-- Options will be populated dynamically -->
                                                                <button class="apply-filter-btn" data-column="category"
                                                                    onclick="applyFilter('category')">Apply</button>
                                                                <button class="clear-filter-btn" data-column="category"
                                                                    onclick="clearFilter('category')">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Batch No</th>
                                                <th>Quantity</th>
                                                <th>Expire Date
                                                    <div class="filter-container">
                                                        <div class="dropdown">
                                                            <button class="dropbtn"
                                                                onclick="toggleDropdown('expireDate')">&#9662;</button>
                                                            <div class="dropdown-content" id="expireDateOptions">

                                                                <label for="startDate">Start Date:</label>
                                                                <input type="date" id="startDate" name="startDate"
                                                                    class="datepicker">

                                                                <label for="endDate">End Date:</label>
                                                                <input type="date" id="endDate" name="endDate"
                                                                    class="datepicker">

                                                                <button class="apply-filter-btn"
                                                                    data-column="expireDate"
                                                                    onclick="applyDateFilter()">Apply</button>
                                                                <button class="clear-filter-btn"
                                                                    data-column="expireDate"
                                                                    onclick="clearDateFilter()">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Remaining shelf life</th>
                                                <th>Unit Cost</th>
                                                <th>ROQ Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        //error_log("Inventory list: " . print_r($data['inventorylist'], true));
                                            foreach ($data['inventorylist'] as $item) {
                                                echo '<tr>';
                                                echo '<td>' . $item->inventoryName . '</td>';
                                                echo '<td>' . $item->categoryName . '</td>';
                                                echo '<td>' . $item->batchCode . '</td>';
                                                echo '<td>' . $item->quantity . ' ' . $item->units . '</td>';
                                                echo '<td>' . $item->expireDate . '</td>';
                                                echo '<td>' . $item->shelfLife . '</td>';
                                                echo '<td>' . $item->unitCost . '</td>';
                                                echo '<td>' . $item->roqLevel . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="add" class="tab-panel">
                        <div class="mbody">
                            <div class="container3">
                                <h2 class="mh2">Good Receive Note</h2>
                                <form class="grnform" id="grnForm"
                                    action="<?php echo URLROOT; ?>/InventoryManagers/addgrn" method="POST">
                                    <div class="grnright-side">
                                        <label class="grnlabel" for="creationDate">Creation Date</label>
                                        <input class="grninput" type="date" id="creationDate" name="creationDate"
                                            required readonly>

                                        <label class="grnlabel" for="category">Category:</label>
                                        <select class="grnselect" id="category" name="category" required>
                                            <option value="categoryName">Select Category</option>

                                        </select>

                                        <label class="grnlabel" for="inventoryName">Inventory Name:</label>
                                        <select class="grnselect" id="inventoryName" name="inventoryName" required>
                                            <option value="">Select Inventory</option>

                                        </select>
                                        <input type="hidden" id="selectedInventoryItem" value="1">

                                        <label class="grnlabel" for="units">Units:</label>
                                        <input class="grnselect" type="text" id="units" name="units" min="0"
                                            placeholder="Units" required readonly>

                                        <label class="grnlabel" for="expireDate">Expire Date:</label>
                                        <input class="grninput" type="date" id="expireDate" name="expireDate" required>
                                    </div>

                                    <div class="grnleft-side">
                                        <label class="grnlabel" for="batchCode">Batch Code</label>
                                        <input class="grninput" type="text" id="batchCode" name="batchCode"
                                            value="<?php echo isset($data['batchCode']) ?>" required readonly>

                                        <label class="grnlabel" for="quantity">Quantity:</label>
                                        <input class="grninput" type="number" id="quantity" name="quantity" min="0"
                                            placeholder="Enter quantity" required>

                                        <label class="grnlabel" for="roqLevel">ROQ Level:</label>
                                        <input class="grninput" type="number" id="roqLevel" name="roqLevel" min="0"
                                            placeholder="ROQ Level" readonly required>

                                        <label class="grnlabel" for="unitCost">Unit Cost:</label>
                                        <input class="grninput" type="number" id="unitCost" name="unitCost" min="0"
                                            placeholder="Enter value per unit" required>

                                        <label class="grnlabel" for="totalCost">Total Cost:</label>
                                        <input class="grninput" type="number" id="totalCost" name="totalCost" min="0"
                                            required readonly>
                                    </div>
                                    <div>
                                        <button class="grnbutton" type="submit">Enter Stock</button>
                                        <button class="grnbutton" type="button" onclick="clearForm()">Clear All</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

            // Function to handle search input
            function searchInventory() {
                var searchInput = document.getElementById("searchInput").value.toLowerCase();
                var inventoryRows = document.querySelectorAll("#inventoryTable tbody tr");

                if (inventoryRows.length === 0) {
                    // If inventory list is empty, display message
                    document.getElementById("searchErrorMessage").textContent = "Inventory list is empty.";
                    document.getElementById("searchErrorMessage").style.display = "block";
                    return;
                }

                document.getElementById("searchErrorMessage").style.display = "none";

                // Loop through each inventory row to check for matches in the inventoryName column
                let foundMatch = false;
                inventoryRows.forEach(row => {
                    const inventoryNameCell = row.querySelector("td:first-child");
                    const inventoryName = inventoryNameCell.textContent.toLowerCase();
                    if (inventoryName.includes(searchInput)) {
                        row.style.display = "";
                        foundMatch = true;
                    } else {
                        row.style.display = "none";
                    }
                });

                if (!foundMatch) {
                    document.getElementById("searchErrorMessage").textContent = "No matching entries found.";
                    document.getElementById("searchErrorMessage").style.display = "block";
                }
            }

            function toggleDropdown(columnName) {
                var dropdownContent = document.getElementById(columnName + "Options");
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    // Hide other dropdowns
                    hideAllDropdowns();
                    // Show the category dropdown
                    dropdownContent.style.display = "block";
                    // Fetch categories and populate dropdown only if not already populated
                    if (columnName === 'category' && !dropdownContent.hasAttribute("data-populated")) {
                        getCategories()
                            .then(categories => populateCategoryDropdown(categories))
                            .catch(error => {
                                console.error("Error fetching and populating categories:", error);
                                alert("Failed to fetch categories. Please try again later.");
                            });
                    }
                }
            }

            function getCategories() {
                return fetch("<?php echo URLROOT; ?>/inventoryManagers/fetchCategories")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data || !Array.isArray(data)) {
                            throw new Error('Invalid response format');
                        }
                        return data; // Return the parsed JSON data
                    })
                    .catch(error => {
                        console.error('Error fetching categories:', error);
                        throw error; // Propagate the error further
                    });
            }

            function populateCategoryDropdown(categories) {
                const categoryDropdown = document.getElementById('categoryOptions');
                categoryDropdown.innerHTML = ''; // Clear existing options
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id; // Assuming your category object has 'id' and 'name' properties
                    option.textContent = category.name;
                    categoryDropdown.appendChild(option);
                });
            }

            function hideAllDropdowns() {
                var dropdowns = document.querySelectorAll('.dropdown-content');
                dropdowns.forEach(function (dropdown) {
                    dropdown.style.display = "none";
                });
            }



        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById("unitCost").addEventListener("input", calculateTotalCost);
                document.getElementById("quantity").addEventListener("input", calculateTotalCost);
                 // Assign the selected inventory ID to the hidden input
                            // Event listener for category dropdown change
                
                function updateBatchCode(nameid) {
                    const selectedCategory = document.getElementById("category").value;
                    console.log("updatebatchcode selectedCategory",nameid);
                    fetch(`<?php echo URLROOT; ?>/inventoryManagers/fetchBatchCode?category=${selectedCategory}&inventoryNameID=${nameid}`)

                        .then(response => response.json())
                        
                        .then(data => {
                            var batchCode = data.batchCode;
                            document.getElementById("batchCode").value = batchCode;
                            
                        })
                        .catch(error => console.error("Error fetching batch code:", error));
                }
                // Function to fetch inventory details by ID
                function fetchInventoryDetails(inventorynameID) {
                    fetch(`<?php echo URLROOT; ?>/inventoryManagers/fetchInventoryDetails/${inventorynameID}`)
                        .then((response) => response.json())
                        .then((inventoryDetails) => {
                            console.log(inventoryDetails);
                            document.getElementById("roqLevel").value = inventoryDetails.roqLevel;
                            document.getElementById("units").value = inventoryDetails.units;
                            console.log()
                        })
                        .catch((error) => console.error("Error fetching inventory details:", error));
                }
                function fetchCategories() {
                    fetch("<?php echo URLROOT; ?>/inventoryManagers/fetchCategories")
                        .then((response) => response.json())
                        .then((categories) => {
                            const categorySelect = document.getElementById("category");
                            categorySelect.innerHTML = '<option value="">Select Category</option>';

                            categories.forEach((category) => {
                                const option = document.createElement("option");
                                option.value = category.categoryID;
                                option.text = category.categoryName;
                                categorySelect.appendChild(option);
                            });
                        })
                        .catch((error) => console.error("Error fetching categories:", error));
                }
                // function fetchInventoryByCategory(categoryID) {
                //     fetch(`<?php echo URLROOT; ?>/inventoryManagers/fetchInventoryByCategory/${categoryID}`)
                //         .then((response) => response.json())
                //         .then((inventories) => {
                //             document.getElementById("inventoryName").innerHTML = "";
                //             console.log(inventories);

                //             inventories.forEach((inventory) => {

                //                 const option = document.createElement("option");
                //                 option.value = inventory.inventorynameID;
                //                 option.text = inventory.inventoryName;
                //                 document.getElementById("inventoryName").appendChild(option);
                //             });
                //             // Get the selected inventory ID from the first option in the dropdown
                //             var selectedInventoryID = document.getElementById("inventoryName").options[0].value;
                //             var selectedInventoryItem = document.getElementById("selectedInventoryItem");
                //             selectedInventoryItem.value = selectedInventoryID;
                            
                //             console.log("selectedInventoryID",selectedInventoryID);
                //             if (selectedInventoryID) {
                //                 fetchInventoryDetails(selectedInventoryID);
                //                 updateBatchCode(selectedInventoryID);

                //             }

                //         })
                //         .catch((error) => console.error("Error fetching inventories:", error));
                // }
    function fetchInventoryByCategory(categoryID) {
    fetch(`<?php echo URLROOT; ?>/inventoryManagers/fetchInventoryByCategory/${categoryID}`)
        .then((response) => response.json())
        .then((inventories) => {
            var inventorySelect = document.getElementById("inventoryName");
            inventorySelect.innerHTML = ""; // Clear existing options

            inventories.forEach((inventory) => {
                const option = document.createElement("option");
                option.value = inventory.inventorynameID;
                option.text = inventory.inventoryName;
                inventorySelect.appendChild(option);
            });

            // Get the selected inventory ID from the first option in the dropdown
            var selectedInventoryID = inventorySelect.options[0].value;
            var selectedInventoryItem = document.getElementById("selectedInventoryItem");
            selectedInventoryItem.value = selectedInventoryID;

            // Fetch inventory details and update batch code
            if (selectedInventoryID) {
                fetchInventoryDetails(selectedInventoryID);
                updateBatchCode(selectedInventoryID);
            }
        })
        .catch((error) => console.error("Error fetching inventories:", error));
}

document.getElementById("category").addEventListener("change", function () {
    var selectedCategoryID = this.value;
    if (selectedCategoryID) {
       // clearPopulatingFields();
        fetchInventoryByCategory(selectedCategoryID);
    }
});

                // document.getElementById("category").addEventListener("change", function () {
                //     var selectedCategoryID = this.value;
                //     if (selectedCategoryID) {
                      
                //         //clearPopulatingFields();
                //         fetchInventoryByCategory(selectedCategoryID);
                //         //updateBatchCode(selectedInventoryID);
                //     }
                // });
                // Load categories on page load
                fetchCategories();

                
                //updateBatchCode(selectedInventoryID);

                setCurrentDate("creationDate");

                setMinDate("expireDate");

                function clearPopulatingFields() {
                    document.getElementById("inventoryName").innerHTML = '<option value="">Select Inventory</option>';
                    document.getElementById("roqLevel").value = '';
                    document.getElementById("units").value = '';
                }


                // expiredate min
                function setMinDate(expireDate) {
                    const inputField = document.getElementById(expireDate);
                    const currentDate = getCurrentDate();
                    inputField.setAttribute("min", currentDate);
                }

                // Function to get current date in YYYY-MM-DD format
                function getCurrentDate() {
                    const now = new Date();
                    const year = now.getFullYear();
                    const month = String(now.getMonth() + 1).padStart(2, "0");
                    const day = String(now.getDate()).padStart(2, "0");
                    return `${year}-${month}-${day}`;
                }
                

                
                

                // Event listener for inventory dropdown change
                document.getElementById("inventoryName").addEventListener("change", function () {
                    var selectedInventoryID = this.value;
                    if (selectedInventoryID) {
                        
                        //clearPopulatingFields();
                        fetchInventoryDetails(selectedInventoryID); // Pass the selectedInventoryID to fetchInventoryDetails
                        updateBatchCode(selectedInventoryID);
                    }
                });

                // Load categories 
                
                
                // Load inventories by category
                

                

                

                

                function setCurrentDate(creationDate) {
                    const inputField = document.getElementById(creationDate);
                    const currentDate = getCurrentDate();
                    inputField.value = currentDate;
                }

                // Calculate total cost based on unit cost and quantity
                function calculateTotalCost() {
                    console.log("Function called")
                    var unitCostInput = document.getElementById("unitCost");
                    var quantityInput = document.getElementById("quantity");
                    var totalCostInput = document.getElementById("totalCost");
                    var unitCost = parseFloat(unitCostInput.value);
                    var quantity = parseFloat(quantityInput.value);

                    if (!isNaN(unitCost) && !isNaN(quantity)) {
                        const totalCost = unitCost * quantity;
                        totalCostInput.value = totalCost.toFixed(2);
                    } else {
                        totalCostInput.value = "";
                    }
                }


            });
            function clearForm() {
                document.getElementById("grnForm").reset();
            }
        </script>

</body>

</html>