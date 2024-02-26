<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Orders</title>
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
    <a class="create-menu-button" href="<?php echo URLROOT; ?>/chefs/getcompletedorders">
        Go to Completed Orders
    </a>
    <button id="logout-btn" onclick="logout()">Logout</button>

    <?php foreach ($data['orders'] as $order) : ?>
        <div class="order-tile">
            <p>Order ID: <?php echo $order->orderID; ?></p>
            <p>Customer Name: <?php echo $order->customer_name; ?></p>
            <p>Menu Name: <a href="<?php echo URLROOT ?>/chefs/viewmenu/<?php echo $order->menuID; ?>"><?php echo $order->itemName; ?></a></p>
            <p>Status: <?php echo $order->status; ?></p>
            <p>Date/Time: <?php echo $order->ordTime; ?></p>
            <div class="status-bar" onclick="updateOrderStatus(<?php echo $order->orderID; ?>, '<?php echo $order->status; ?>')">
                Click to Update Status
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        // JavaScript function to update order status
        function updateOrderStatus(orderID, currentStatus) {
            var newStatus;

            // Determine the next status based on the current status
            if (currentStatus === 'Queue') {
                newStatus = 'Preparing';
            } else if (currentStatus === 'Preparing') {
                newStatus = 'Completed';
            } else {
                // If the current status is 'completed', reset to 'queue'
                newStatus = 'Queue';
            }

            // Use AJAX to send a request to the server to update the status
            // For simplicity, I'll just redirect to the updateOrderStatus route
            window.location.href = "/DineEase-DEE/chefs/updateOrderStatus/" + orderID + "/" + newStatus;
        }

        // JavaScript function for logout
        function logout() {
            // Redirect to the logout route or perform any other necessary logout actions
            window.location.href = "<?php echo URLROOT ?>/users/logout";
        }
    </script>
</body>
</html>
