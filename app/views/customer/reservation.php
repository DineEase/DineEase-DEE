<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
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
                            <span class="material-symbols-outlined material-symbols-outlined-topbar ">notifications </span>
                            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
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
                                <a href="<?php echo URLROOT ?>/customers/index" class="nav_link nav_link_switch" data-content='home'>
                                    <button class="button-sidebar-menu " id="homeButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Dashboard</span>
                                    </button>
                                </a>
                            </li>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/reservation" class="nav_link" data-content='reservation'>
                                    <button class="button-sidebar-menu active-nav" id="reservationButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                book_online
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reservation </span>
                                    </button>
                                </a>
                            </li>

                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/menu" class="nav_link" data-content='menu'>
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
                                <a href="<?php echo URLROOT ?>/customers/review" class="nav_link" data-content='menu'>
                                    <button class="button-sidebar-menu" id="reservationButton">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                reviews
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reviews </span>
                                    </button>
                                </a>
                            </li>
                            <!-- End -->


                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>



                            <li class="item">
                                <a href="<?php echo URLROOT ?>/customers/profile" class="nav_link" data-content='menu'>
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



                            <!-- <li class="item">
                            <a href="<?php echo URLROOT ?>/customers/profile" class="nav_link nav_link_switch" data-content='profile'>
                                <button class="button-sidebar-menu">
                                    <span class="navlink_icon">
                                        <span class="material-symbols-outlined ">
                                            account_circle
                                        </span>
                                    </span>
                                    <span class="button-sidebar-menu-content">My Account </span>
                                </button>
                            </a>
                        </li> -->
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
        <div class="body-template">
            <div id="content">
                <div class="reservation-container">
                    <div class="tabset">
                        <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                        <label for="tab1">View Reservations</label>
                        <input type="radio" name="tabset" id="tab2" aria-controls="add">
                        <label for="tab2">Add Reservation</label>

                        <div class="tab-panels">
                            <section id="view" class="tab-panel">
                                <div class="content read">
                                    <h2>View Reservations</h2>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td>Reservation ID</td>
                                                <td>Date</td>
                                                <td>Start Time</td>
                                                <td>End Time</td>
                                                <td>No of People</td>
                                                <td>Amount</td>
                                                <td>Status</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($data['reservations'] as $index => $reservation) { ?>
                                                <tr>
                                                    <td><?php echo $index + 1 ?></td>
                                                    <td><?php echo $reservation->reservationID ?></td>
                                                    <td><?php echo $reservation->date ?></td>
                                                    <td><?php echo $reservation->reservationStartTime  ?></td>
                                                    <td><?php echo $reservation->reservationEndTime  ?></td>
                                                    <td><?php echo $reservation->numOfPeople ?></td>
                                                    <td>Tobecalculated</td>
                                                    <td><?php echo $reservation->status ?></td>
                                                    <td class="actions">
                                                        <a href="<?php echo URLROOT; ?>/Customers/cancelReservation/<?php echo $reservation->reservationID ?>" class="trash <?php echo ($reservation->status == 'Cancelled' ? 'disabled-button' : ''); ?>" onclick="return confirm('Are you sure you want to cancel this reservation?');"><i class="fas fa-trash fa-xs"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>
                                    <div class="pagination">

                                        <a href="#"><i class="fas fa-angle-double-left fa-sm"></i></a>
                                        <a href="#"><i class="fas fa-angle-double-right fa-sm"></i></a>
                                    </div>
                                </div>
                            </section>
                            <section id="add" class="tab-panel">
                                <div class="add-reservation-container">
                                    <div class="reservation-container-fluid">
                                        <div class=" text-center ">
                                            <div class="card">
                                                <h2 id="heading" class="text-center">Reserve Slot</h2>
                                                <form id="msform" class="msform-container" action="<?php echo URLROOT; ?>/customers/addReservation" method="post">
                                                    <div class="prog">
                                                        <ul id="progressbar">
                                                            <li class="active" id="package"><strong>Package</strong></li>
                                                            <li id="rd"><strong>Reservation Details</strong></li>
                                                            <li id="availability"><strong>Availability</strong></li>
                                                            <li id="confirm"><strong>Payment</strong></li>
                                                        </ul>
                                                    </div>
                                                    <fieldset>
                                                        <div class="form-card">
                                                            <div class="row fixed-height-row-reservation">
                                                                <div>
                                                                    <h3 class="fs-title">Select the package:</h3>
                                                                </div>
                                                                <div class="plan-deets">
                                                                    <div class="plan">
                                                                        <div class="inner">
                                                                            <span class="pricing">
                                                                                <span>
                                                                                    3% <small>TAX</small>
                                                                                </span>
                                                                            </span>
                                                                            <p class="title">Ethereal Lounge T1</p>
                                                                            <p class="info">A serene escape where sophistication and tranquility unite, offering curated cocktails and a menu of culinary delights.</p>
                                                                            <ul class="features">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="plan">
                                                                        <div class="inner">
                                                                            <span class="pricing">
                                                                                <span>
                                                                                    5% <small>TAX</small>
                                                                                </span>
                                                                            </span>
                                                                            <p class="title">Sapphire Lounge T2</p>
                                                                            <p class="info">A celestial retreat, sparkling with opulence. Indulge in carefully crafted beverages and gourmet offerings for an otherworldly experience.</p>
                                                                            <ul class="features">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="plan">
                                                                        <div class="inner">
                                                                            <span class="pricing">
                                                                                <span>
                                                                                    10% <small>TAX</small>
                                                                                </span>
                                                                            </span>
                                                                            <p class="title">Platinum Lounge T3</p>
                                                                            <p class="info">The epitome of luxury, where every detail speaks of excellence. Reserved for connoisseurs who appreciate refined menus and impeccable service.</p>
                                                                            <ul class="features">
                                                                            </ul>

                                                                            <input type="text" hidden id="tableID" name="tableID" value="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="pkg-selection">
                                                                    <div class="radio-inputs">
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID1" value="1" name="packageID" checked  >
                                                                            <span class="name">T1</span>
                                                                        </label>
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID2" value="2" name="packageID">
                                                                            <span class="name">T2</span>
                                                                        </label>
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID3" value="3" name="packageID">
                                                                            <span class="name">T3</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="form-card">
                                                            <div class="row">
                                                                <div class="fixed-height-row-reservation">
                                                                    <h3 class="fs-title">Select Date and No of People:</h3>
                                                                    <div class="dp-container">

                                                                        <!-- <button class="date-slot">17</button> -->
                                                                        <label for="date">Date:</label>
                                                                        <div class="date-slots">
                                                                            <?php
                                                                            $currentDate = strtotime(date("Y-m-d")); // Get the current date in timestamp format
                                                                            for ($i = 0; $i < 15; $i++) {
                                                                                $date = date("Y-m-d", strtotime("+{$i} days", $currentDate)); // Calculate each date
                                                                                $selectedClass = $i == 0 ? "selected" : ""; // Add 'selected' class to today's date
                                                                                echo "<div class='date-slot {$selectedClass}' data-date='{$date}'>" . date('d M', strtotime($date)) . "</div>";
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <input type="hidden" id="selectedDate" name="date" value="<?= date("Y-m-d") ?>">


                                                                        <div class="people-selection">
                                                                            <label for="numOfPeople" class="slots">Number of People:</label>
                                                                            <br>
                                                                            <div class="people-icons">
                                                                                <?php for ($i = 1; $i <= 10; $i++) : ?>
                                                                                    <div class="person-icon" data-value="<?= $i ?>">
                                                                                        <i class="fa-solid fa-person" style="font-size:50px"></i>
                                                                                        <p><?= $i ?></p>
                                                                                    </div>
                                                                                <?php endfor; ?>
                                                                            </div>
                                                                            <input type="hidden" id="numOfPeople" name="numOfPeople" value="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <input type="button" name="next" class="next action-button " value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="form-card">
                                                            <div class="row fixed-height-row-reservation">
                                                                <div>
                                                                    <h3 class="fs-title">Select the Time Slot:</h3>
                                                                </div>

                                                                <div class="availability-table">
                                                                    <div class="av-table">
                                                                        <div class="time-slots">
                                                                            <?php for ($hour = 8; $hour <= 23; $hour++) : ?>
                                                                                <div class="time-slot" data-time="<?= $hour < 10 ? '0' . $hour : $hour ?>:00">
                                                                                    <?= $hour < 10 ? '0' . $hour : $hour ?>:00
                                                                                </div>
                                                                            <?php endfor; ?>
                                                                        </div>
                                                                        <input type="hidden" id="selectedTime" name="reservationStartTime">
                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div> <input type="button" name="next" class="next action-button" value="next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="form-card fixed-height-row-reservation">
                                                            <div class="row ">
                                                                <div class="reservation-summary">
                                                                    <h3 class="fs-title">Thank you for your reservation</h3>
                                                                    <div class="summary-details">
                                                                        <div class="summery-row left">
                                                                            <p>Date: <span id="summary-date"></span></p>
                                                                            <p>No of people: <span id="summary-people"></span></p>
                                                                            <p>Time: <span id="summary-time"></span></p>
                                                                        </div>
                                                                        <div class="summery-row right">
                                                                            <p>Package: <span id="summary-package"></span></p>
                                                                            <p>Table: <span id="summary-table"></span></p>
                                                                            <p class="sum-amount">Total Amount: <span id="total-amount"></span></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="added-items">
                                                                        <div class="menu-items" id="menu-items-list">
                                                                            <!-- Menu items will be added here dynamically -->
                                                                        </div>
                                                                        <button type="button" id="add-item">+ Add Food Item</button>
                                                                    </div>
                                                                    <button id="proceed-to-pay">Proceed to Pay</button>
                                                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                                </div>
                                                            </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>