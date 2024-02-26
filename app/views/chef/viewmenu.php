<!-- menu.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerstyle.css">
    <style>
        /* Add your CSS styles here for better presentation */
        .item-chef-menu {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .bottom-chef-menu {
            padding: 10px;
        }

        .image-box-chef-menu img {
            max-width: 100%;
            height: auto;
        }

        .title-chef-menu {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .price-chef-menu {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .average-prepare-time-chef-menu {
            font-size: 14px;
            color: #777;
        }

        .buttons-chef-menu {
            margin-top: 10px;
        }

        .button.item-button-chef-menu {
            display: inline-block;
            margin-right: 5px;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button.item-button-chef-menu a {
            color: #fff;
            text-decoration: none;
        }

        /* New "Create New Menu" button styles */
        .create-menu-button {
            display: block;
            margin: 10px 0;
            padding: 8px 12px;
            border: 2px solid #3498db;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-menu-button:hover {
            background-color: #2980b9;
        }
    </style>
    <title>Menus</title>
</head>
<body>

<!-- Your existing HTML structure -->

<!-- Content Area -->
<div class="content">
    <!-- New "Create New Menu" button -->
    

    <?php
    foreach ($data['menu'] as $menuitem) {
        echo '<div class="item-chef-menu">';
        echo '<div class="bottom-chef-menu">';
        echo '<div class="image-box-chef-menu">';
        echo '<img src="' . URLROOT . '/uploads/' . basename($menuitem->imagePath) . '" alt="Menu Item Image">';
        echo '</div>';
        echo '<p class="title-chef-menu">' . $menuitem->itemName . '</p>';
        echo '<p class="price-chef-menu">LKR' . $menuitem->price . '</p>';
        echo '<p class="average-prepare-time-chef-menu">Min' . $menuitem->averageTime . '</p>';
        echo '<div class="buttons-chef-menu">';
    }
        
    ?>
</div>


</body>
</html>
