<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kitchen staff</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/kitchen-staff.css">
    <style>
        .status.preparing{
  padding: 2px 4px;
  background: #8de02c;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}
.status.queue{
  padding: 2px 4px;
  background: #e9b10a;
  color: var(--white);
  border-radius: 4px;
  font-size: 14px;
  font-weight: 500;
}</style>
</head>

<body>
    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">

        </div>
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <!-- Your card content goes here -->
        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Recent Orders</h2>

                </div>

                <table>
                    <thead>
                        <tr>
                            <td>Order ID</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($data['orders'] as $order) : ?>
                            <tr>
                                <td><?php echo $order->orderID; ?></td>
                                <td>
                                    <span class="status <?php echo strtolower($order->status); ?>">
                                        <?php echo ucfirst(strtolower($order->status)); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <!-- ================= complete orders ================ -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>completed orders</h2>
                </div>

                <table>
                    <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="<?php echo URLROOT ?>/public/img/kitchenstaff/tick.jpg" alt=""></div>
                        </td>
                        <?php foreach ($data['comorders'] as $comorder) : ?>
                            <td>
                                <h4>Order:<?php echo $comorder->orderID; ?><br> <span><?php echo $comorder->status; ?></span></h4>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>