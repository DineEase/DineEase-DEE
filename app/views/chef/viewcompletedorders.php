<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Completed Orders</title>
    <!-- Include any necessary stylesheets or scripts here -->
    <style>
        .order-tile {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }

        .status-bar {
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            padding: 5px;
            text-align: center;
        }

        /* Add some style for the logout button */
        #logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Chef Orders</h2>

    <!-- Add the logout button -->
    <a class="create-menu-button" href="<?php echo URLROOT; ?>/chefs/index">
        Go to ongoing Orders
    </a>
    <button id="logout-btn" onclick="logout()">Logout</button>

    <?php foreach ($data['orders'] as $order) : ?>
        <div class="order-tile">
            <p>Order ID: <?php echo $order->orderID; ?></p>
            <p>Customer Name: <?php echo $order->customer_name; ?></p>
            <p>Menu Name: <a href="<?php echo URLROOT ?>/chefs/viewmenu/<?php echo $order->menuID; ?>"><?php echo $order->itemName; ?></a></p>
            <p>Status: <?php echo $order->status; ?></p>
            <p>Date/Time: <?php echo $order->ordTime; ?></p>
        </div>
    <?php endforeach; ?>

    
<script>
        // JavaScript function for logout
        function logout() {
            // Redirect to the logout route or perform any other necessary logout actions
            window.location.href = "<?php echo URLROOT ?>/users/logout";
        }
    </script>
</body>
</html>
