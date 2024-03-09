<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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

        #categoryFilterForm,
        .add-category-container,
        .buttonGroup {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #categoryFilter {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }

        #newCategory {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .button {
            padding: 10px;
            background-color: #2ecc71; /* Green color for buttons */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px; /* Space between buttons */
        }

        .button:hover {
            background-color: #27ae60; /* Darker green on hover */
        }

        .home-button {
            margin-top: 15px;
        }

        .menu-tiles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .item-chef-menu {
            width: 48%; /* Two menus in a row with a small gap */
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .image-box-chef-menu {
        width: 100%;
        height: 200px; /* Set a fixed height for all images */
        overflow: hidden;
        border-radius: 8px 8px 0 0;
    }

    .image-box-chef-menu img {
        width: 100%;
        height: 100%; /* Make the image fill the container */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        display: block;
        margin: 0 auto; /* Center the image */
    }

        .bottom-chef-menu {
            padding: 10px;
        }

        .title-chef-menu {
            font-size: 18px;
            margin: 10px;
        }

        .price-chef-menu,
        .average-prepare-time-chef-menu {
            margin: 5px 10px;
        }

        .buttons-chef-menu {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: transparent;
        }

        .button a {
            text-decoration: none;
            color: #fff;
        }

        .button:hover {
            background-color: #27ae60; /* Darker green on hover */
        }
        .create-menu-button {
    background-color: #3498db; /* Light blue color for the Create Menu button */
}
.create-menu-button:hover {
    background-color: #2980b9; /* Darker blue on hover */
}
.category-set-time-container {
    margin-top: 20px;
    text-align: center;
}
.error-message {
    color: red;
    font-weight: bold;
    margin-top: 5px;
    margin-left: 20px; /* Adjust the left margin as needed */
    display: block; 
}


    </style>
</head>

<body>

    <header>
        <h1>Menu Management Dashboard</h1>
    </header>

    <div class="container">
        <div class="search-container">
            <form action="<?php echo URLROOT; ?>/managers/searchmenubyname" method="GET">
                <input type="text" name="searchQuery" class="search-input" placeholder="Search by name">
                <button type="submit" class="search-button">Search</button>
            </form>
            <form id="categoryFilterForm" action="<?php echo URLROOT; ?>/managers/filtermenubycategory" method="GET">
                <label for="categoryFilter">Filter by Category:</label>
                <select id="categoryFilter" name="categoryFilter" onchange="filterMenuByCategory(this.value)">
                    <option value="">All Categories</option>
                    <?php foreach ($data['categories'] as $category) : ?>
                        <?php
                        $selected = ($category->category_ID == $_GET['categoryFilter']) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $category->category_ID; ?>" <?php echo $selected; ?>>
                            <?php echo $category->category_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <div class="add-category-container">
            <form id="addCategoryForm" action="<?php echo URLROOT; ?>/managers/addmenucategory" method="POST">
                <label for="newCategory">Add Category:</label>
                <input type="text" id="newCategory" name="category_name" placeholder="Enter new category">
                <button type="submit" class="button">Add</button>
            </form>
            
        </div>
        <?php if (!empty($data['category_name_err'])) : ?>
                <p class="error-message"><?php echo $data['category_name_err']; ?></p>
            <?php endif; ?>
            <div class="edit-category-container">
    <form id="editCategoryForm" action="<?php echo URLROOT; ?>/managers/editmenucategory/" method="POST" onsubmit="return validateForm()">
        <label for="editCategory">Select Category to Edit:</label>
        <select id="editCategory" name="category_id" onchange="updateActionURL()">
            <option value="" disabled selected>Select a category</option>
            <?php foreach ($data['categories'] as $category) : ?>
                <option value="<?php echo $category->category_ID; ?>">
                    <?php echo $category->category_name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="newCategoryName">New Category Name:</label>
        <input type="text" id="newCategoryName" name="category_name" placeholder="Enter new category name">
        <button type="submit" class="button">Edit</button>
    </form>
    <?php if (!empty($data['category_edit_name_err'])) : ?>
        <p class="error-message"><?php echo $data['category_edit_name_err']; ?></p>
    <?php endif; ?>
    <script>
        function updateActionURL() {
            var selectedCategoryId = document.getElementById("editCategory").value;
            var form = document.getElementById("editCategoryForm");
            form.action = "<?php echo URLROOT; ?>/managers/editmenucategory/" + selectedCategoryId;
        }

        function validateForm() {
            var selectedCategoryId = document.getElementById("editCategory").value;
            if (!selectedCategoryId) {
                alert("Please select a category before submitting the form.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>


</div>

<div class="category-set-time-container">
<a href="<?php echo URLROOT; ?>/managers/updatetimecategories" class="button category-set-time-button">Hide Show Categories</a>
</div>



        <div class="buttonGroup">
            <a href="<?php echo URLROOT; ?>/managers/index" class="button home-button">Home</a>
            <a href="<?php echo URLROOT; ?>/managers/submitMenuitem" class="button create-menu-button">Create Menu</a>
        </div>

        <div class="menu-tiles">
            <?php
            foreach ($data['menu'] as $menuitem) {
                echo '<div class="item-chef-menu">';
                echo '<div class="image-box-chef-menu">';
                echo '<img src="' . URLROOT . '/uploads/' . basename($menuitem->imagePath) . '" alt="Menu Item Image">';
                echo '</div>';
                echo '<div class="bottom-chef-menu">';
                echo '<p class="title-chef-menu">' . $menuitem->itemName . '</p>';
                echo '<p class="price-chef-menu">Price: LKR:' . $menuitem->price . '</p>';
                echo '<p class="average-prepare-time-chef-menu">Average Prepare Time:Min' . $menuitem->averageTime . '</p>';
                echo '<p class="average-prepare-time-chef-menu">Category:' . $menuitem->category_name . '</p>';
                echo '<div class="buttons-chef-menu">';

                if ($menuitem->hidden == 0) {
                    // If menu item is hidden, show "Show" button
                    echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/showMenuitem/' . $menuitem->itemID . '"onclick="showAlertShow()">Show</a></span>';
                } else {
                    // If menu item is shown, show "Hide" button
                    echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/hideMenuitem/' . $menuitem->itemID . '"onclick="showAlertHide()">Hide</a></span>';
                }

                echo '<span class="button item-button-chef-menu"><a href="' . URLROOT . '/managers/editMenuitem/' . $menuitem->itemID . '">Edit</a></span>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script>
        <?php if (isset($data['new_category_added']) && $data['new_category_added']) : ?>
            alert("New category added!");
            window.location.href = "<?php echo URLROOT; ?>/managers/menu";
        <?php endif; ?>
    </script>

    <!-- JavaScript function to handle category filter -->
    <script>
        function filterMenuByCategory(categoryID) {
            // Check if "All Categories" is selected
            if (categoryID === "") {
                // Redirect to the same page without the categoryFilter parameter
                window.location.href = "<?php echo URLROOT; ?>/managers/menu";
            } else {
                // Encode the category ID before adding it to the URL
                var encodedCategoryID = encodeURIComponent(categoryID);

                // Redirect to the same page with the selected category as a query parameter
                window.location.href = "<?php echo URLROOT; ?>/managers/filtermenubycategory?categoryFilter=" + encodedCategoryID;
            }
        }
    </script>
    <script>
    function showAlertShow() {
        alert("Menu is shown to Customers");
    }
</script>
<script>
    function showAlertHide() {
        alert("Menu is hidden from Customers");
    }
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log(<?php echo json_encode($data['menu']); ?>);
            <?php if (empty($data['menu'])) : ?>
                alert("No items available.");
                window.location.href = "<?php echo URLROOT; ?>/managers/menu";
            <?php endif; ?>
        });
    </script>

</body>

</html>
