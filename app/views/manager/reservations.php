
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/manager-style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <title><?php echo SITENAME; ?></title>

    <style>
        /* Overall page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.refund-details {
    margin-top: 20px;
}

.reservation-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.reservation-item {
    display: flex;
    flex-direction: column;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}

.reservation-info {
    flex: 1;
}

.reservation-actions {
    margin-top: 10px;
}

.acceptedit, .denyedit {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.acceptedit {
    background-color: #4CAF50;
    color: white;
}

.denyedit {
    background-color: #f44336;
    color: white;
}

       
    </style>
</head>
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
                

<?php
if (!empty($data['refundrequestreservations'])) {
    //var_dump($data['reservationdetails']);
    // If there are reservations, show the notification icon
    echo '<span class="material-symbols-outlined material-symbols-outlined-topbar">notifications_unread (' . count($data['refundrequestreservations']) . ')</span>';
} else {
    // If there are no reservations, don't show the notification icon
    echo '<span class="material-symbols-outlined material-symbols-outlined-topbar">notifications </span>';
}
?>


                    <?php
                    $user_id = $_SESSION['user_id'];
                    $profile_picture_url = URLROOT . '/uploads/profile/' . basename($_SESSION['profile_picture']);
                    ?>
                    Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                    <a href="<?php echo URLROOT . '/managers/viewmanagerprofile' ?>">
                        <img src="<?php echo $profile_picture_url; ?>" alt="profile-photo" class="profile" />
                    </a>
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
                                <a href="<?php echo URLROOT ?>/managers/dashboard" class="nav_link nav_link_switch" data-content='home'>
                                    <button class="button-sidebar-menu " id="homeButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                dashboard
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Dashboard</span>
                                    </button>
                                </a>
                            </li>
                    <li class="item">
                        <a href="<?php echo URLROOT ?>/managers/getUsers" class="nav_link nav_link_switch" data-content='home'>
                            <button class="button-sidebar-menu " id="homeButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        manage_accounts
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Users</span>
                            </button>
                        </a>
                    </li>
                    <li class="item">
                        <a href="<?php echo URLROOT ?>/managers/menu" class="nav_link" data-content='reservation'>
                            <button class="button-sidebar-menu " id="reservationButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        restaurant_menu
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Menus </span>
                            </button>
                        </a>
                    </li>


                    <li class="item">
                        <a href="<?php echo URLROOT; ?>/managers/updatetimecategories" class="nav_link" data-content='menu'>
                            <button class="button-sidebar-menu" id="reservationButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        category
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Categories </span>
                            </button>
                        </a>
                    </li>
                    <li class="item">
                        <a href="<?php echo URLROOT; ?>/managers/packages" class="nav_link" data-content='menu'>
                            <button class="button-sidebar-menu" id="reservationButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        Package
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Packages </span>
                            </button>
                        </a>
                    </li>
                    <li class="item">
                        <a href="<?php echo URLROOT; ?>/managers/viewtables" class="nav_link" data-content='menu'>
                            <button class="button-sidebar-menu" id="reservationButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        Table_Restaurant
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Tables </span>
                            </button>
                        </a>
                    </li>
                    <li class="item">
                        <a href="<?php echo URLROOT; ?>/managers/handlediscounts" class="nav_link" data-content='menu'>
                            <button class="button-sidebar-menu" id="reservationButton">
                                <span class="navlink_icon">
                                    <span class="material-symbols-outlined ">
                                        sell
                                    </span>
                                </span>
                                <span class="button-sidebar-menu-content">Discounts</span>
                            </button>
                        </a>
                    </li>
                    <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/reports" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            lab_profile
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reports</span>
                                </button>
                            </a>
                        </li>
                        <li class="item">
                            <a href="<?php echo URLROOT; ?>/managers/reservations" class="nav_link" data-content='menu'>
                                <button class="button-sidebar-menu active-nav " id="reservationButton">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            book_online
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">Reservations</span>
                                </button>
                            </a>
                        </li>
                    <!-- End -->


                </ul>
                <hr class='separator'>

                <ul class="menu_items">
                    <div class="menu_title menu_user"></div>



                    <li class="item">

                        <a href="<?php echo URLROOT . '/managers/viewmanagerprofile' ?>" class="nav_link" data-content='menu'>
                            <button class="button-sidebar-menu" id="reservationButton">
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

<body>
<div class="container">
    <h1>Refund Requested Reservations</h1>
    <div class="refund-details">
        <?php if (empty($data['refundrequestreservations'])) : ?>
            <p>No refund requested reservations found.</p>
        <?php else : ?>
            <div class="reservation-list">
                <?php foreach ($data['refundrequestreservations'] as $reservation) : ?>
                    <div class="reservation-item">
                        <div class="reservation-info">
                            <div><strong>Reservation ID:</strong> <?php echo $reservation->reservationID; ?></div>
                            <div><strong>Order ID:</strong> <?php echo $reservation->orderID; ?></div>
                            <div><strong>Reservation Date:</strong> <?php echo $reservation->date; ?></div>
                            <div><strong>Reservation Start Time:</strong> <?php echo $reservation->reservationStartTime; ?></div>
                            <div><strong>Reservation End Time:</strong> <?php echo $reservation->reservationEndTime; ?></div>
                            <div><strong>Number of People:</strong> <?php echo $reservation->numOfPeople; ?></div>
                            <div><strong>Requested Date:</strong> <?php echo $reservation->refund_date; ?></div>
                            <div><strong>Total Amount:</strong> <?php echo $reservation->amount; ?></div>
                            <div><strong>Refund Amount:</strong> <?php echo $reservation->refund_amount; ?></div>
                            <div><strong>Reason:</strong> <?php echo $reservation->reason; ?></div>
                            <div><strong>Refund Status:</strong> <?php echo $reservation->status; ?></div>
                        </div>
                        <div class="reservation-actions">
                            <a href="<?php echo URLROOT; ?>/managers/acceptrefundrequest/<?php echo $reservation->reservationID; ?>" class="acceptedit">Accept Refund</a>
                            <a href="<?php echo URLROOT; ?>/managers/denyrefundrequest/<?php echo $reservation->reservationID; ?>" class="denyedit">Deny Refund</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html> 