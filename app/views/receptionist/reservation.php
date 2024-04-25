<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">

    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title><?php echo SITENAME; ?></title>
</head>
<style>
    .flex-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
        width: 100%;
        justify-content: space-between;
    }

    .row {
        display: flex;
        flex-direction: row;
        padding: 5px;
        gap: 10px;
    }

    .column {
        display: flex;
        flex-direction: column;
        padding: 5px;
        gap: 10px;
    }

    .half {
        width: 50%;
    }

    .space-between {
        justify-content: space-between;
    }

    .receptionist-dashboard-container {
        display: flex;
        flex-direction: column;
        padding: 5px;
        height: 100ch;
    }

    .completed-reservations-container {
        height: 100vh;
        margin: 0em 10em 0em;
        display: flex;
        justify-content: center;
        gap: 1em;
        /* align-items: center; */
    }

    .order-items-conteainer {
        display: flex;
        width: 100%;
        flex-direction: column;
        gap: 1em;
        padding: 1em;
        margin: 1em;
        background-color: white;
        border-radius: 10px;
        height: 80vh;
        padding: 1em;
        overflow-y: auto;
    }

    .completed-order-item-card {
        display: flex;
        background-color: red;
        border-radius: 10px;
        width: 100%;
        height: 10vh;
    }

    .completed-reservations-container table {
        width: 100%;
    }

    .completed-reservations-container td {
        padding: 1em;
        width: 7em;
    }

    .compleated-order-header {
        display: flex;
        flex-direction: row;
        height: 3em;
        justify-content: space-between;
        align-items: center;
        gap: 1em;
    }

    .completed-order-item-card-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 1em;
        height: 3em;
        background-color: rgb(117, 123, 129);
    }

    .add-reservation-receptionist {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: 1em;
    }

    #ongoingOrders , #completedOrders {
        display: flex;
        flex-direction: column;
        gap: 1em;

    }
</style>

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

                        <ul class="menu_items">
                            <div class="menu_title menu_menu"></div>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/receptionists/index" class="nav_link " onclick="changeContent('home')">
                                    <button class="button-sidebar-menu ">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                home
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Dashboard </span>
                                    </button>
                                </a>
                            </li>
                            <li class="item">
                                <a href="<?php echo APPROOT ?>/receptionist/reservation" class="nav_link" onclick="changeContent('reservation')">
                                    <button class="button-sidebar-menu active-nav">
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
                                <a href="<?php echo URLROOT ?>/receptionists/menu" class="nav_link" onclick="changeContent('menu')">
                                    <button class="button-sidebar-menu">
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
                                <a href="<?php echo URLROOT ?>/receptionists/refund" class="nav_link" onclick="changeContent('refund')">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                currency_exchange
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Refund </span>
                                    </button>
                                </a>
                            </li>

                            <li class="item">
                                <a href="<?php echo URLROOT ?>/receptionists/orders" class="nav_link" onclick="changeContent('order')">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                list_alt
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Orders </span>
                                    </button>
                                </a>
                            </li>
                            <!-- End -->


                        </ul>
                        <hr class='separator'>

                        <ul class="menu_items">
                            <div class="menu_title menu_user"></div>
                            <li class="item">
                                <a href="<?php echo URLROOT ?>/receptionists/profile" class="nav_link">
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
            <div id="content">
                <div class="reservation-container">
                    <div class="tabset">
                        <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                        <label for="tab1">View Reservations</label>
                        <input type="radio" name="tabset" id="tab2" aria-controls="add">
                        <label for="tab2">Add Reservation</label>
                        <input type="radio" name="tabset" id="tab3" aria-controls="ongoing">
                        <label for="tab3">Ongoing Reservations</label>
                        <input type="radio" name="tabset" id="tab4" aria-controls="completed">
                        <label for="tab4">Completed Reservations</label>

                        <div class="tab-panels">
                            <section id="view" class="tab-panel">
                                <div class="content read">
                                    <h2>View Reservations</h2>
                                    <div class="searchnfilter">
                                        <!-- Search Form -->
                                        <div class="filter-reservation">
                                            <form id="reservationFilters" action="<?php echo URLROOT; ?>/receptionists/reservation" method="POST">
                                                <select name="status">
                                                    <option value="">Select Status</option>
                                                    <?php foreach ($data['reservationStatus'] as $status) : ?>
                                                        <option value="<?php echo $status->status ?>" <?php if (strtoupper($data['status']) == $status->status) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $status->status ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- //TODO: add search and filters for reservations view in receptionist -->

                                    <table>
                                        <thead>
                                            <tr>
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
                                                    <td><?php echo $reservation->date ?></td>
                                                    <td><?php echo $reservation->reservationStartTime  ?></td>
                                                    <td><?php echo $reservation->reservationEndTime  ?></td>
                                                    <td><?php echo $reservation->numOfPeople ?></td>
                                                    <td>Rs. <?php echo $reservation->amount ?>.00</td>
                                                    <td><?php echo $reservation->status ?></td>
                                                    <td class="actions">
                                                        <button class="edit-reservation-button" onclick="popViewReservationDetails(this);" data-reservation-id="<?php echo $reservation->reservationID; ?>">View & Edit</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <!-- // TODO #19 : Filters does not apply when the page is reloaded while navigating through pages -->
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
                                <div id="reservation-details-container" class="reservation-details-container">
                                    <div class="rs-container" hidden>
                                        <div class="rs-header">
                                            <h2>Reservation Details</h2>
                                            <div class="rs-header-items">
                                                <div>Order No:&nbsp;<span id="rs-order-id"></span></div>
                                                <div id="rs-order-date-div">Order Date:&nbsp;<span id="rs-order-date">

                                                    </span></div>
                                            </div>
                                        </div>
                                        <div class="rs-content">
                                            <div class="rs-items">

                                            </div>
                                            <div class="rs-details">
                                                <h3> Order Summery</h3>
                                                <table>
                                                    <tr>
                                                        <td class="rs-os-head">Subtotal</td>
                                                        <td id="rs-subtotal">0</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="rs-os-head">Reservation Fees</td>
                                                        <td id="rs-reservation">0</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="rs-os-head">Service Charge</td>
                                                        <td id="rs-service-charge">0</td>
                                                    </tr>

                                                    <tr class="rs-total">
                                                        <td class="rs-os-head-total">Total Amoun : </td>
                                                        <td id="rs-Payable">0</td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="rs-actions">
                                                <table>
                                                    <tr>
                                                        <td class="rs-text-cont" width>
                                                            Want to Refund?: <br /> <input type="button" id="rs-refund" value="Refund Policy">
                                                        </td>
                                                        <td class="rs-button-cont">
                                                            <button class="light-green-btn" id="rs-review" onclick="popAddReviewForTheReservation();" value="">Add Review</button>
                                                        </td>
                                                        <td class="rs-button-cont">
                                                            <button class="danger-btn" id="rs-cancel">Cancel Reservation</button>
                                                        </td>
                                                        <td class="rs-button-cont">
                                                            <button class="" id="rs-close-btn">Close</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- cancel Reservation page -->
                                <div id="reservation-cancel-container" class="reservation-details-container">
                                    <div class="rs-container" hidden>
                                        <div class="rs-header">
                                            <h2>Cancel Reservation</h2>
                                            <div class="rs-header-items">
                                                <div>Order No:&nbsp;<span id="rc-order-id"></span></div>
                                                <div class="rc-cancel-suite">Suite :&nbsp;<span id="rc-order-suite"></span></div>
                                                <div id="rs-order-date-div">
                                                    Order Date:&nbsp;<span id="rc-order-date"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-content">
                                            <div class="rs-details">
                                                <h3>Refund Availability </h3>
                                                <hr>
                                                <div class="review-order-item-container" id="cancel-order-refund-possible">
                                                    <span>You can </span>
                                                    <p></p>
                                                </div>
                                                <div class="review-order-item-container" id="cancel-order-refund-not-possible">
                                                    <span>You cant </span>
                                                    <p></p>
                                                </div>
                                                <div class="review-order-item-container" id="cancel-order-refund-requested">
                                                    <span>You did </span>
                                                    <p></p>
                                                </div>
                                                <div class="review-order-item-container" id="cancel-order-cancelled-no-refund">
                                                    <span>You did but with what cost?</span>
                                                    <p></p>
                                                </div>
                                                <div class="review-order-item-container" id="cancel-order-refund-given">
                                                    <span>mf</span>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="rs-actions">
                                                <table class="rs-review-table">
                                                    <tr>
                                                        <td class="rs-button-cont ">
                                                            <!-- TODO Add confirmation popup for reservation cancellation -->
                                                            <button class="red-btn review" id="rc-submit-cancel">Cancel Reservation</button>
                                                        </td>
                                                        <td class="rs-button-cont add-review">
                                                            <button class="light-green-btn" onclick="closeCancelReservation();" id="rc-close-btn-cancel">Close</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- review popup -->
                                <div id="reservation-review-container" class="reservation-details-container">
                                    <div class="rs-container" hidden>
                                        <div class="rs-header">
                                            <h2>Add Review</h2>
                                            <div class="rs-header-items">
                                                <div>Order No:&nbsp;<span id="rr-order-id"></span></div>
                                                <div>Suite :&nbsp;<span id="rr-order-suite"></span></div>
                                                <div id="rs-order-date-div">
                                                    Order Date:&nbsp;<span id="rr-order-date"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rs-content">
                                            <table>
                                                <tr class="review-star-sets">
                                                    <td>Overall Rating</td>
                                                    <td id="overall-rating-cont">
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo ('<i class="fa-solid fa-star reviewed-star" onclick="setStars(this);" id="overall-rating-cont-star' . $i . '" data-id="overall-rating-cont" value="' . $i . '"></i>');
                                                        }
                                                        ?>
                                                        <input type="hidden" id="overall-rating-cont-input" name="overall-rating" value="5">
                                                    </td>
                                                </tr>
                                                <tr class="review-star-sets">
                                                    <td>Suite Rating</td>
                                                    <td id="suit-rating-cont">
                                                        <?php
                                                        for ($i = 0; $i < 5; $i++) {
                                                            echo ('<i class=" fa-solid fa-star reviewed-star " onclick="setStars(this);" id="suit-rating-cont-star' . $i . '" data-id="suit-rating-cont" value="' . $i . '"></i>');
                                                        }
                                                        ?>
                                                        <input type="hidden" id="suit-rating-cont-input" name="suit-rating-cont" value="5">
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="rs-details">
                                                <h3>Reviw Menu Items</h3>
                                                <hr>
                                                <div class="review-order-item-container" id="review-order-item-container">

                                                </div>
                                            </div>
                                            <div class="rs-actions">
                                                <table class="rs-review-table">
                                                    <tr>
                                                        <textarea class="reviewComment" id="review-comment" type="text" name="comment" value="" placeholder="Enter your comment here"></textarea>
                                                    </tr>
                                                    <tr>
                                                        <td class="rs-button-cont ">
                                                            <button class="light-green-btn review" onclick="submitReviewForReservation();" id="rs-submit-review">Add Review</button>
                                                        </td>
                                                        <td class="rs-button-cont add-review">
                                                            <button class="" id="rs-close-btn-review">Close</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section id="add" class="tab-panel">
                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Add Reservation</h1>
                                            </div>
                                        </div>
                                        <div class="add-reservation-receptionist">

                                            <div class="row">
                                                <label for="reservation_time">Reservation Time : </label>
                                                <input type="datetime-local" id="reservation_time" name="reservation_time">
                                            </div>
                                            <div class="row">
                                                <label for="number_of_guests">Number of People :</label>
                                                <input type="number" id="number_of_guests" name="number_of_guests">
                                            </div>
                                            <button>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section id="ongoing" class="tab-panel">
                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Ongoing Orders</h1>
                                                <div class="row">
                                                    <input type="text" placeholder="Search" />
                                                    <button>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="completed-order-item-card-header">
                                            <table>
                                                <tr>
                                                    <td>Reservation ID</td>
                                                    <td>Customer Name</td>
                                                    <td>table</td>

                                                    <td>Full amount</td>

                                                    <td>Amount Payable</td>
                                                    <td>Status</td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="ongoingOrders">

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section id="completed" class="tab-panel">
                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Compleated Orders</h1>
                                                <div class="row">
                                                    <input type="text" placeholder="Search" />
                                                    <button>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="completed-order-item-card-header">
                                            <table>
                                                <tr>
                                                    <td>Reservation ID</td>
                                                    <td>Customer Name</td>
                                                    <td>table</td>

                                                    <td>Full amount</td>

                                                    <td>Amount Payable</td>
                                                    <td>Status</td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="completedOrders">
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
        <script src="<?php echo URLROOT; ?>/js/receptionist.js"></script>
</body>

</html>