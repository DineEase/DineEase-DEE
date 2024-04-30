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

    .item-details {
        width: 18em;
    }

    .item-actions {
        display: flex;
        gap: 1em;
    }

    input[id^="quantity-input"] {
        width: 3em;
        padding-top: 7px;
        padding-bottom: 7px;
    }

    button[id^="add-to-cart-btn"] {
        padding-top: auto;
        width: 8em;
        color: white;
        background-color: var(--brandgreen-dark);
        border-radius: 6px;
        padding: 10px 5px;
        font-size: x-small;

    }

    input#menuSearchEO {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-family: inherit;
        width: 100%;
    }

    button#clearCartButton {
        padding: 1em;
        border-radius: 10px;
    }

    button#closeeditOngoingS {
        padding: 1em;
        border-radius: 10px;
        bottom: 2em;
        position: relative;
        left: 11em;
    }

    .menu-item {
        padding: 17px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        height: 34px;
        border: solid 1px #166c45;
        border-radius: 5px;
        padding-left: 10px;
        padding-right: 10px;
        background-color: white;
        /* height: 37px !important; */
        width: 28em;
        margin: auto;
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
        height: 85vh;
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

    .menu-item:hover {
        background-color: var(--brandgreen);
        color: white;
    }

    .light-green-btn {
        background-color: var(--brandgreen);
        color: white;
        padding: 1em;
        border-radius: 10px;
    }

    .light-green-btn:hover {
        background-color: var(--brandgreen-dark);
    }

    .completed-order-item-card-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 1em;
        height: 3em;
        background-color: var(--brandgreen);
        border-radius: 10px;
        color: white;
        border: 2px solid var(--brandgreen-dark);
    }

    .completed-order-item-card {
        display: flex;
        background-color: #f2f2f2;
        border-radius: 10px;
        width: 100%;
        height: 10vh;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;
    }

    .completed-order-item-card:hover {
        transform: scale(1.01);
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

    #ongoingOrders,
    #completedOrders {
        display: flex;
        flex-direction: column;
        gap: 1em;

    }

    /* Button styling */


    .addItem-to-order-container {
        display: flex;
        flex-direction: column;
        gap: 1em;
        padding: 1em;
        margin: 1em;
        height: 66vh;
        width: 117vh;
    }

    .addItem-to-order-container-input {
        display: flex;
        flex-direction: row;
        gap: 1em;
        align-items: center;

    }

    div#itemsBySearch {
        height: 58vh;
        overflow-y: scroll;
        width: 31em;
        background-color: #bababa70;
        border-radius: 10px;
    }

    div#itemsBySearchEO {
        height: 53vh;
        overflow-y: scroll;
        width: 31em;
        background-color: #bababa70;
        border-radius: 10px;
    }   

    .viewOngoing {
        display: flex;
        flex-direction: column;
        gap: 1em;
        padding: 1em;
        margin: 1em;
        height: 66vh;
        width: 117vh;
    }

    .editOngoingS {
        display: none;
        flex-direction: column;
        gap: 1em;
        padding: 1em;
        margin: 1em;
        height: 66vh;
        width: 117vh;
    }

    select#suite {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-family: inherit;
    }

    .add-reservation-receptionist {
        display: flex;
        flex-direction: row !important;
        justify-content: space-around;
        align-items: center;
        gap: 1em;
        align-content: stretch;

    }

    div#cancelledOrders {
    display: flex;
    gap: 1em;
    flex-direction: column;
}

    .add-reservation-receptionist .row {
        display: flex;
        align-items: center;
    }

    input#number_of_guests {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-family: inherit;
    }

    .added-item {
        display: flex;
        width: 34em;
        padding: 0em;
        margin-top: 4px;
        margin-bottom: 4px;
        align-items: center;
        background-color: azure;
        padding: 5px;
        border-radius: 5px;
    }

    input#menuSearchRADD {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-family: inherit;
        width: 100%;
    }

    #addReservationButton {
        padding: 1em;
        color: white;
        background-color: var(--brandgreen);
        border-radius: 7px;
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
                            <!-- <span class="material-symbols-outlined topbar-shoping-cart" value="0">
                                shopping_cart_off
                            </span> -->
                            <span class="material-symbols-outlined material-symbols-outlined-topbar  topbar-notifications">notifications </span>
                            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp; <?php echo  $_SESSION['user_name'] ?></span>
                            <img src="<?php echo URLROOT ?>/img/profilePhotos/<?php echo $_SESSION['profile_picture'] ?>" alt="profile-photo" class="profile" />
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
                                <a href="<?php echo URLROOT ?>/receptionists/reservation" class="nav_link" onclick="changeContent('reservation')">
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

                            <!-- <li class="item">
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
                            </li> -->
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
                        <input type="radio" name="tabset" id="tab5" aria-controls="cancelled">
                        <label for="tab5">Cancelled Reservations</label>
                        <input type="radio" name="tabset" id="tab6" aria-controls="overdue">
                        <label for="tab6">Overdue Reservations</label>

                        <div class="tab-panels">
                            <section id="view" class="tab-panel">
                                <div class="content read">
                                    <h2>View Reservations</h2>
                                    <!--dsad -->
                                    <div class="searchnfilter">
                                        <!-- Search Form -->
                                        <div class="filter-reservation">
                                            <form id="reservationFilters" action="<?php echo URLROOT; ?>/receptionists/reservation" method="POST">
                                                <select onchange="submitFilters();" name="status">
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
                                                        <button class="edit-reservation-button" onclick="popViewReservationDetails(this);" data-reservation-id="<?php echo $reservation->reservationID; ?>">View Details</button>
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
                                                        <td class="rs-button-cont">
                                                            <button class="" id="rs-close-btn">Close</button>
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
                                                <label for="suite">Reservation Suite:</label>
                                                <select name="suite" id="suite" onchange="setSuite(this.value);">
                                                    <?php foreach ($data['suites'] as $suite) {
                                                        echo '<option value="' . $suite->packageID . '">' . $suite->packageName . '</option>';
                                                    } ?>
                                                </select>
                                                <div>Availability : <span id="availiable-seats"></span> </div>
                                                <input type="hidden" id="reservation_suite" name="reservation_suite" value="1">
                                            </div>
                                            <div class="row">
                                                <label for="number_of_guests">Number of People:</label>
                                                <input type="number" id="number_of_guests" name="number_of_guests" value="1">
                                            </div>
                                        </div>
                                        <div class="menuItems-containerRADD" id="menuItems-containerRADD">
                                            <div class="row">
                                                <div class="column">
                                                    <div class="row">
                                                        <input type="text" id="menuSearchRADD">
                                                    </div>
                                                    <div class="column" id="itemsBySearch">
                                                    </div>
                                                </div>
                                                <div class="column">

                                                    <div class="row">
                                                        <h3>Added Items</h3>
                                                    </div>
                                                    <div class="row">
                                                        <table>
                                                            <tr>
                                                                <td>Item</td>
                                                                <td>Size</td>
                                                                <td>Quantity</td>
                                                                <td>Price</td>
                                                                <td></td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <div class="column" id="added-items-to-reservation">

                                                    </div>
                                                    <div class="row">
                                                        <button id="addReservationButton" onclick="createOrder(); ">Add Reservation</button>

                                                        <button id="clearCartButton" onclick="clearCart();">Clear Cart</button>
                                                        <input type="hidden" id="total-for-cart" name="total" value="0">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                            <section id="ongoing" class="tab-panel">
                                <div id="addItemsToOrder" class="hidden">
                                    <div class="addItem-to-order-container">
                                        <div class="row">
                                            <h3>Add Order Items</h3>
                                        </div>
                                        <hr />
                                        <div class="addItem-to-order-container-input row">

                                            <!-- Items -->
                                            <div id="menuDropdown" class="dropdown">
                                                <input type="text" placeholder="Choose a Menu Item..." id="menuInput">
                                                <div id="dropdownItems" class="dropdown-content">
                                                </div>
                                            </div>

                                            <button id="addButton">Add</button>
                                        </div>
                                        <div class="added-order-items" id="added-order-items">

                                        </div>
                                    </div>
                                </div>
                                <div id="popup-container" class="common-popup-container" style="display: none">
                                    <div class="common-popup">
                                        <button class="common-close-btn">X</button>
                                        <div id="popup-content"></div>
                                    </div>
                                </div>


                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Ongoing Orders</h1>
                                                <div class="row">
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="viewOngoing">
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
                                        <input type="text" id="reloads" value="0" hidden>

                                        <div class="editOngoingS">
                                            <div class="contentEditOnGiongs jcsb">
                                                <div class="row space-between">
                                                    <div class="row">
                                                        OrderNO : <span id="orderNO-editEO"></span>
                                                    </div>
                                                    <div class="row">
                                                        Customer Name : <span id="customerName-editEO"></span>
                                                    </div>
                                                    <div class="row">
                                                        Status : <span id="status-editEO"></span>
                                                    </div>
                                                    <div class="row">
                                                        Table : <span id="tableID-editEO"></span>
                                                    </div>
                                                    <div class="row">
                                                        Amount : <span id="totalAmount-editEO"></span>
                                                    </div>
                                                    <div class="row">
                                                        Amount to Add : <span id="total-for-newly-added">Rs.0.00</span>
                                                    </div>

                                                </div>
                                                <div class="content-EO">
                                                    <div class="row">
                                                        <div class="column">
                                                            <div class="row">
                                                                <input type="text" id="menuSearchEO">
                                                            </div>
                                                            <div class="column" id="itemsBySearchEO">
                                                            </div>
                                                        </div>
                                                        <div class="column">

                                                            <div class="row">
                                                                <h3>Added Items</h3>
                                                            </div>
                                                            <div class="row">
                                                                <table>
                                                                    <tr>
                                                                        <td>Item</td>
                                                                        <td>Size</td>
                                                                        <td>Quantity</td>
                                                                        <td>Price</td>
                                                                        <td></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="column" id="added-items-to-Order">
                                                            </div>
                                                            <div class="row-cart">
                                                                <button class="light-green-btn" onclick="addNewItemsToOrder();">Add Items</button>


                                                                <button id="clearCartButton" onclick="clearCartEO();">Clear Cart</button>
                                                                <input type="hidden" id="total-for-cart" name="total" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row  jcfe">

                                                    <div class="close-button">
                                                        <button class="close-btn" onclick="closeEditOngoingOrder();" id="closeeditOngoingS">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
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
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="viewOngoing">
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
                                </div>
                            </section>
                            <section id="cancelled" class="tab-panel">
                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Cancelled Orders</h1>
                                                <div class="row">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="viewOngoing">
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
                                            <div id="cancelledOrders">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section id="overdue" class="tab-panel">
                                <div class="completed-reservations-container">
                                    <div class="order-items-conteainer">
                                        <div class="compleated-order-header">
                                            <div class="flex-container">
                                                <h1>Overdue Orders</h1>
                                                <div class="row">
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="viewOngoing">
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
                                            <div id="overdueOrders">
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
        <!-- 
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var menuInput = document.getElementById('menuInput');

                // Event listener for the input event
                menuInput.addEventListener('input', function() {
                    alert('You typed something: ' + menuInput.value);
                });
            });
        </script> -->

        <script>
            function submitFilters() {
                document.getElementById('reservationFilters').submit();
            }
        </script>

        <script>
            var packageSizes = <?php echo json_encode($data['capacity']); ?>;
        </script>

        <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
        <script src="<?php echo URLROOT; ?>/js/receptionist.js"></script>
        <script src="<?php echo URLROOT; ?>/js/main.js"></script>

</body>

</html>