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
                                    <div class="searchnfilter">
                                        <!-- Search Form -->
                                        <div class="search-reservation">
                                            <form class="search-form" method="GET" action="">
                                                <input type="text" name="search" placeholder="Search reservations" value="<?php echo $data['search']; ?>">
                                                <button type="submit">Search</button>
                                            </form>
                                        </div>
                                        <div class="filter-reservation">
                                            <form id="reservationFilters" action="/path/to/filter/action" method="GET">
                                                <select name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="confirmed">Confirmed</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select>
                                                <input type="date" name="startDate">
                                                <input type="date" name="endDate">
                                                <button type="submit">Filter</button>
                                            </form>
                                        </div>
                                    </div>

                                    <table>
                                        <thead>
                                            <tr>
                                                <td>#</td>
                                                <td class="long-td">Date</td>
                                                <td class="long-td">Start Time</td>
                                                <td class="long-td">End Time</td>
                                                <td>No of People</td>
                                                <td class="long-td">Amount</td>
                                                <td class="long-td">Status</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php foreach ($data['reservations'] as $index => $reservation) { ?>
                                                <tr>
                                                    <td><?php echo $index + 1 ?></td>
                                                    <td><?php echo $reservation->date ?></td>
                                                    <td><?php echo $reservation->reservationStartTime  ?></td>
                                                    <td><?php echo $reservation->reservationEndTime  ?></td>
                                                    <td><?php echo $reservation->numOfPeople ?></td>
                                                    <td>Rs. <?php echo $reservation->amount ?>.00</td>
                                                    <td><?php echo $reservation->status ?></td>
                                                    <td class="actions">
                                                        <a href="<?php echo URLROOT; ?>/Customers/cancelReservation/<?php echo $reservation->reservationID ?>" class="trash <?php echo ($reservation->status == 'Cancelled' ? 'disabled-button' : ''); ?>" onclick="return confirm('Are you sure you want to cancel this reservation?');"><i class="fas fa-trash fa-xs"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php
                                            if (count($data['reservations']) < 10) {
                                                for ($i = 0; $i < 10 - count($data['reservations']); $i++) {
                                                    echo "<tr><td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
                                                }
                                            } ?>


                                        </tbody>

                                    </table>
                                    <!-- Pagination Links -->
                                    <div class="pagination-view">
                                        <?php if ($data['page'] > 1) : ?>
                                            <a href="?page=<?php echo $data['page'] - 1; ?>">&laquo;</a>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                                            <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $data['page'] ? 'active' : ''; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        <?php endfor; ?>

                                        <?php if ($data['page'] < $data['totalPages']) : ?>
                                            <a href="?page=<?php echo $data['page'] + 1; ?>">&raquo;</a>
                                        <?php endif; ?>
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
                                                                <!-- <div class="plan-deets">
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
                                                                </div> -->


                                                                <div class="pkg-selection">
                                                                    <div class="radio-inputs">
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID1" value="1" name="packageID" checked>
                                                                            <span class="name">Budget</span>
                                                                        </label>
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID2" value="2" name="packageID">
                                                                            <span class="name">Gold</span>
                                                                        </label>
                                                                        <label class="radio">
                                                                            <input type="radio" id="packageID3" value="3" name="packageID">
                                                                            <span class="name">Platinum</span>
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
                                                                        <!-- <label for="date">Date:</label> -->
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
                                                                                    <div class="person-icon <?= $i == 1 ? 'selected' : '' ?>" data-value="<?= $i ?>">
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
                                                                                <div class="time-slot <?= $hour == 8 ? 'selected' : '' ?>" data-time="<?= $hour < 10 ? '0' . $hour : $hour ?>:00">
                                                                                    <?= $hour < 10 ? '0' . $hour : $hour ?>:00
                                                                                </div>
                                                                            <?php endfor; ?>
                                                                        </div>
                                                                        <input type="hidden" id="selectedTime" name="reservationStartTime" value="08:00">
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
                                                                            <input type="hidden" id="totalAmount" name="amount" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="added-items">
                                                                        <div class="menu-items" id="menu-items-list">
                                                                            <!-- Menu items will be added here dynamically -->
                                                                        </div>
                                                                        <button onclick="popup()" type="button" id="add-food">+ Add Food Items</button>
                                                                        <!-- <button type="button" id="add-item">+ Add Food Item</button> -->
                                                                        <div id="menu-div-purchase" class="menu-div-purchase hide">
                                                                            <div class="customer-menu-view">
                                                                                <div class="menu-view-header-bar">
                                                                                    <div class="menu-view-filters">
                                                                                        <div class="menu-categories">
                                                                                            <div class="category-button active-category" data-category-id="all">All</div>
                                                                                            <div class="category-button" data-category-id="1"><span class="material-symbols-outlined">
                                                                                                    fastfood
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="2"><span class="material-symbols-outlined">
                                                                                                    dinner_dining
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="3"><span class="material-symbols-outlined">
                                                                                                    tapas
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="4"><span class="material-symbols-outlined">
                                                                                                    soup_kitchen
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="5"><span class="material-symbols-outlined">
                                                                                                    rice_bowl
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="6"><span class="material-symbols-outlined">
                                                                                                    outdoor_grill
                                                                                                </span></div>
                                                                                            <div class="category-button" data-category-id="7"><span class="material-symbols-outlined">
                                                                                                    hotel_class
                                                                                                </span></div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="menu-view-head">
                                                                                        <div class="search-reservation hide">
                                                                                            <form class="search-form hide" method="GET" action="">
                                                                                                <input type="text" name="search" placeholder="Search Menu Item" value="" id="search-input">
                                                                                                <button type="submit" id="search-button">Search</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="menu-filters">
                                                                                            <div class="price-filter">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="menu-box">
                                                                                        <div class="menu-items">
                                                                                            <div id="menu-container" class="menu-container-div-out">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="pagination-container">
                                                                                        <div class="pagination-view-only-menu">
                                                                                            <div class="pgbtn" id="prev-page">Previous</div>
                                                                                            <span id="page-info"></span>
                                                                                            <div class="pgbtn" id="next-page">Next</div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button id="proceed-to-pay">Proceed to Pay</button>
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
    <script src="<?php echo URLROOT; ?>/js/customer-reservation.js"></script>
</body>

</html>