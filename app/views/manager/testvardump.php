<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Cards and Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 200px;
            min-height: 200px;
            background-color: #e6f7e9; /* Light green */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            margin: 0;
            text-align: center;
            color: #333;
        }

        .card p {
            margin: 5px 0;
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        .customer-card {
            width: calc(40% - 20px); /* Adjust width to fit 2 cards in a row */
        }

        .food-card {
            width: calc(20% - 20px); /* Adjust width to fit 5 cards in a row */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2>Total Sales</h2>
            <p>LKR:<?php echo $data['totalsales']->{'SUM(amount)'}; ?></p>
        </div>
        <div class="card">
            <h2>Total Orders</h2>
            <p><?php echo $data['totalorders']->{'COUNT(orderItemID)'}; ?></p>
        </div>
        <div class="card">
            <h2>Total Customers</h2>
            <p><?php echo $data['totalcustomers']->{'COUNT(user_id)'}; ?></p>
        </div>
        <div class="card">
            <h2>Total Menus</h2>
            <p><?php echo $data['totalmenus']->{'COUNT(itemID)'}; ?></p>
        </div>
        <div class="card">
            <h2>Best Selling Menu Item</h2>
            <p><?php echo $data['bestsellingmenuitem']->itemName; ?></p>
            <p>Total Quantity: <?php echo $data['bestsellingmenuitem']->total_quantity; ?></p>
            <!-- Space for menu image -->
            <img src="<?php echo $data['bestsellingmenuitem']->imagePath ?>" alt="Menu Image" style="width: 100px; height: 100px;">
        </div>
        <div class="card">
            <h2>Most Used Package</h2>
            <p><strong>Package Name:</strong> <?php echo $data['mostusedpackage']->packageName; ?></p>
            <p><strong>Total Usage:</strong> <?php echo $data['mostusedpackage']->total_usage; ?></p>
        </div>
        <div class="card customer-card">
            <h2>Top 5 Customers</h2>
            <ul>
                <?php foreach ($data['top5customers'] as $customer) : ?>
                    <li><?php echo $customer->name; ?> - Total Reservations: <?php echo $customer->total_reservations; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card food-card">
            <h2>Best Reviewed Food</h2>
            <p>Name: <?php echo $data['bestreviewedfood']->itemName; ?></p>
            <p>Average Rating: <?php echo $data['bestreviewedfood']->average_rating; ?></p>
        </div>

        <!-- Card for Least Reviewed Food -->
        <div class="card food-card">
            <h2>Least Reviewed Food</h2>
            <p>Name: <?php echo $data['leastreviewedfood']->itemName; ?></p>
            <p>Average Rating: <?php echo $data['leastreviewedfood']->average_rating ?? 'N/A'; ?></p>
        </div>

    </div>


</body>

</html>
<?php
var_dump($data);
?>
