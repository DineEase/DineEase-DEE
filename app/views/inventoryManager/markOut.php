<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">

    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <div class="tabset">
                <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                <label for="tab1">Kitchen Requests</label>
                <input type="radio" name="tabset" id="tab2" aria-controls="add">
                <label for="tab2">Kitchen Issue</label>

                <div class="tab-panels">
                    <section id="view" class="tab-panel">
                        <div class="mbody">
                            <div class="container3">
                                <h2 class="mh2">Inventory Request from the kitchen</h2>
                                <table class="invtable" id="kitchenTable">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Requested Inventory</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['kitchenrequest'] as $item) : ?>
                                            <tr>
                                                <td><?php echo $item->categoryName->categoryName; ?></td>
                                                <td><?php echo $item->Inventoryname->inventoryName; ?></td>
                                                <td><?php echo $item->quantity; ?></td>
                                                <td class="mtd">
                                                    <button type="button" class="mbutton2" onclick="toggleAction(this)">
                                                        <a href='<?php echo URLROOT; ?>/InventoryManagers/changerequest/<?php echo $item->requestID; ?>'>Requested</a>

                                                    </button>
                                                    <button type="button" class="mbutton2" onclick="toggleAction(this)">
                                                        <a href='<?php echo URLROOT; ?>/InventoryManagers/changerequest/<?php echo $item->requestID; ?>'>Denied</a>

                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section id="add" class="tab-panel">
                        <div class="mbody">
                            <div class="container3">
                                <h2 class="mh2">Inventory Issue for the kitchen </h2>
                                <div class="form-section">
                                    <form id="markoutForm" action="<?php echo URLROOT; ?>/InventoryManagers/markOut" method="POST">
                                        <label class="mlabel" for="categoryName">Category:</label>
                                        <select class="mselect" id="categoryName" name="categoryName" onchange="getRequestedInventories()">
                                            <option value="">Select Category</option>
                                            <?php foreach ($data['kitchenrequestnames'] as $item) : ?>
                                                <option value="<?php echo $item->categoryID; ?>">
                                                    <?php echo $item->categoryName->categoryName; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="inventory-container">
                                            <!-- <label class="mlabel" for="inventoryName">Inventory:</label> -->

                                        </div>
                                        <button class="addbutton" type="submit">Transfer</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            //markout - row add


            function deleteRow(button) {
                const row = button.closest("tr");
                row.remove();
            }

            function toggleAction(button) {
                button.innerText = "Transferred";
                // if (button.innerText === "Transferred") {
                //     button.innerText = "Unavailable";
                //     button.classList.remove("transferred"); // Optionally, you can add classes to style the button differently based on its state
                //     button.classList.add("unavailable");
                // } else {
                //     button.innerText = "Transferred";
                //     button.classList.remove("unavailable");
                //     button.classList.add("transferred");
                // }
            }

            function getRequestedInventories() {
                const selectedCategory = document.getElementById("categoryName").value;
                if (selectedCategory !== "") {
                    fetch(`<?php echo URLROOT; ?>/inventoryManagers/getInventoriesRequested?categoryName=${selectedCategory}`)
                        .then(response => response.json())
                        //console.log(response);
                        .then(inventories => {
                            console.log('Response from server:', inventories);
                            const inventoryContainer = document.getElementById("inventory-container");
                            inventoryContainer.innerHTML = ""; // Clear previous content
                            inventories.forEach(inventory => {
                                // Create elements for item and quantity input
                                const itemLabel = document.createElement("label");
                                itemLabel.textContent = inventory.Inventoryname.inventoryName + ": ";
                                const quantityInput = document.createElement("input");
                                quantityInput.type = "number";
                                quantityInput.min = "1";
                                quantityInput.name = `quantity[${inventory.inventoryName}]`; // Use inventory ID as input name
                                console.log(inventory.inventoryName);
                                console.log(quantityInput.name);
                                quantityInput.placeholder = "Quantity";
                                // Append elements to the container
                                inventoryContainer.appendChild(itemLabel);
                                inventoryContainer.appendChild(quantityInput);
                                inventoryContainer.appendChild(document.createElement("br")); // Add line break
                            });
                        })
                        .catch(error => console.error("Error fetching inventories:", error));
                } else {
                    // Clear the inventory container if no category is selected
                    document.getElementById("inventory-container").innerHTML = "";
                }
            }


            //     function addRow() {
            //         getrequestedInventories();
            //     const tableBody = document.querySelector("#inventoryTable tbody");
            //     const newRow = document.createElement("tr");
            //     newRow.innerHTML = `
            //         <td>
            //             <select class="mselect inventory-dropdown" name="inventoryName[]" style="margin-bottom: 30px;">
            //                 <!-- Options dynamically populated -->
            //             </select>
            //         </td>
            //         <td>
            //             <input class="minput" type="number" name="quantity[]" min="1" placeholder="Quantity" required>
            //         </td>
            //         <td>
            //             <button type="button" class="mdelete-icon" onclick="deleteRow(this)">
            //                 <i class="fa fa-trash"></i>
            //             </button>
            //         </td>
            //     `;
            //     tableBody.appendChild(newRow);

            //     // Fetch requested inventories when a new row is added

            // }

            function updatekitchenrequestStatus(inventoryName, status) {
                $.ajax({
                    url: 'inventoryManagers/updatekitchenrequestStatus',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        inventoryName: inventoryName,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Kitchen Request status updated successfully.');
                        } else {
                            console.error('Failed to update kitchen request status:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request failed:', error);
                    }
                });
            }
        </script>
</body>

</html>