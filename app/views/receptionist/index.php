<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/common.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/swal.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/toastr.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/receptionist-styles.css">
    <title><?php echo SITENAME; ?></title>
    <style>
        
        .dashboard-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 97.6%;
            padding: 20px;
            height: 60px;
        }

        .receptionist-dashboard-container {
            display: flex;
            flex-direction: column;
            padding: 5px;
        }

        .rdh-item {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 30%;
            height: 100%;
        }

        .rdh-date-picekr {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .rdh-date-picekr span {
            cursor: pointer;
        }

        .rdh-date-picekr input {
            padding: 5px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: x-large;
        }

        .dashboard-content {
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 25px;
        }

        .receptionist-dashboard-container table {
            /* width: 100%; */
            height: 100%;
            border-collapse: collapse;
            /* border: var(--brandgreen) solid 4px; */
            border-radius: 10px;
        }

        .receptionist-dashboard-container table tr {
            height: 50px;
        }

        .receptionist-dashboard-container table tr td {
            border: var(--brandgreen) solid 1px;
            text-align: center;
            padding: 5px;
        }

        tr td:not(:first-child) {
            width: 12vh;
        }


        .receptionist-dashboard-container table tr td:nth-child(1) {
            width: 12vh !important;
        }


        .view-slot-button {
            background-color: gray;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .view-slot-button:hover {
            background-color: darkgray;
        }

        .dashboard-content {
            display: flex;
            flex-direction: column;
            height: 29vh;
            padding: 22px;
        }

        .dashboard-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 97.6%;
            height: 60px;
            padding: 20px;
            padding-bottom: 0;
        }

        .reservation-full-view-table {
            border: 4px solid var(--brandgreen);


        }
    </style>
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
                                    <button class="button-sidebar-menu active-nav">
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
                                    <button class="button-sidebar-menu">
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
            <div class="receptionist-dashboard-container">

                <?php
                if (isset($data['input']['date'])) {
                    $selectedDate = $data['input']['date'];
                } else {
                    $selectedDate = date('Y-m-d');
                }
                ?>

                <?php
                if (isset($data['suite'])) {
                    $selectedSuite = $data['suite'];
                } else {
                    $selectedSuite = 1;
                }
                ?>
                <!-- TODO #82 Reservation grids active status does not show -->
                <!-- <?php '<pre></pre>' . var_dump($data) . '</pre>' ?> -->




                <div class="dashboard-head">
                    <div class="rdh-item">
                        <div class="buttonset-container">
                            <button class="buttonset-button" onclick="changeSuiteFilter(this);" data-package-id="0">All</button>
                            <?php
                            foreach ($data['packages'] as $package) {
                                echo '<button class="buttonset-button" onclick="changeSuiteFilter(this);" data-package-id="' . $package->packageID . '">' . $package->packageName . '</button>';
                            }
                            ?>
                            <form id="suiteAndDateFilterForm" action="Index" method="post">
                                <input type="number" id="suiteFilter" name="suite" value="<?php echo $selectedSuite ?>" hidden />

                        </div>
                    </div>
                    <div class="rdh-item">
                        <div class="rdh-date-picekr buttonset-container">

                            <span onclick="changeDate(-1)"><i class="fa-solid fa-caret-left"></i></span>
                            <input type="date" name="date" id="date-picker" value="<?php echo $selectedDate; ?>" />
                            <span onclick="changeDate(1)"><i class="fa-solid fa-caret-right"></i></span>
                            </form>
                        </div>
                    </div>
                    <div class="rdh-item">
                        <div class="buttonset-container">
                            <button class="view-slot-button">Scheduled</button>
                            <button class="view-slot-button active-reservation">Arrived</button>
                            <button class="view-slot-button completed-reservation">Completed</button>
                        </div>
                    </div>
                </div>
                <div class="dashboard-content">

                    <div class="reservation-full-view-table">
                        <table class="table-fixed">
                            <?php
                            // Example PHP logic to demonstrate dynamic content
                            for ($time = $data['reservationsStartTime']; $time < $data['reservationsEndTime']; $time++) {
                            ?>
                                <tr>
                                    <td><?= $time ?></td>
                                    <?php
                                    if ($data['reservations']) {
                                        foreach ($data['reservations'] as $reservation) {
                                            $slot = date("G", strtotime($reservation->reservationStartTime));

                                            if ($slot == $time) {
                                                echo '<td><button class="view-slot-button' .
                                                    ($reservation->hasArrived == 1 && $reservation->status != "Completed" ? " active-reservation" : "") .
                                                    ($reservation->status == "Completed" ? " completed-reservation" : "") .
                                                    '" data-reservation-id="' . $reservation->reservationID .
                                                    '" data-reservation-time="' . $reservation->reservationStartTime .
                                                    '" data-customer-name="' . htmlspecialchars($reservation->customerName) .
                                                    '" onclick="slotPopup(this);" name="slot-button">' . $reservation->reservationID . '</button></td>';                                                // echo '<td><button class="view-slot-button ' .echo *$reservation->hasArrived ==1)?"active-reservation":" "; .'  " data-reservation-id="' . $reservation->reservationID . '" data-reservation-time="' . $reservation->reservationStartTime . '" data-customer-name="' . $reservation->customerName . '" onclick="slotPopup(this);" name="slot-button">' . $reservation->reservationID . '</button></td>';
                                            }
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/receptionist.js"></script>
    <script src="<?php echo URLROOT; ?>/js/swal.js"></script>
    <script src="<?php echo URLROOT; ?>/js/toastr.js"></script>


    <script>
        // let data = (function() {
        //     let _value = '';
        //     return {
        //         get value() {
        //             return _value;
        //         },
        //         set value(val) {
        //             _value = val;
        //             console.log(`Value changed to: ${_value}`);
        //             doSomethingOnChange();
        //         }
        //     };
        // })();

        // function doSomethingOnChange() {
        //     console.log('The value was changed!');
        // }

        function successMessageNotification(message) {
            toastr.success(message);
        }

        function errorMessageNotification(message) {
            toastr.error(message);
        }

        function slotPopup(element) {
            let reservationID = element.getAttribute('data-reservation-id');
            let customerName = element.getAttribute('data-customer-name');
            let reservationTime = element.getAttribute('data-reservation-time');
            let selectedDate = document.getElementById('date-picker').value;

            function isDayPassed(selectedDate) {
                let today = new Date().toISOString().slice(0, 10);
                return selectedDate < today;
            }

            function isTimePassed(selectedDate, reservationTime) {
                let today = new Date().toISOString().slice(0, 10);
                let currentTime = new Date();
                let currentHour = currentTime.getHours();

                if (selectedDate < today) {
                    return true;
                } else if (selectedDate === today) {
                    let reservationHour = parseInt(reservationTime.split(':')[0]);
                    return reservationHour + 1 <= currentHour;
                }
                return false;
            }

            let datePassed = isDayPassed(selectedDate);
            let timePassed = isTimePassed(selectedDate, reservationTime);

            $.ajax({
                type: "POST",
                url: "getReservationMarkedArrivedStatus",
                data: {
                    reservationID: reservationID
                },
                success: function(response) {
                    if (response == 1) {
                        swal({
                            title: "Reservation Details",
                            text: "Reservation ID: " + reservationID + "\nCustomer Name: " + customerName,
                            icon: "info",
                            buttons: {
                                close: {
                                    text: "Close",
                                    value: null,
                                    visible: true,
                                    className: "swal-close-btn",
                                }
                            }
                        });
                    } else {
                        if (datePassed || timePassed) {
                            swal({
                                title: "Reservation Details",
                                text: "Reservation ID: " + reservationID + "\nCustomer Name: " + customerName,
                                icon: "info",
                                buttons: {
                                    close: {
                                        text: "Close",
                                        value: null,
                                        visible: true,
                                        className: "swal-close-btn",
                                    }
                                }
                            });
                        } else {
                            // handle mark arrived and cancel reservation logic for chef and filtering
                            swal({
                                title: "Reservation Details",
                                text: "Reservation ID: " + reservationID + "\nCustomer Name: " + customerName,
                                icon: "info",
                                buttons: {
                                    close: {
                                        text: "Close",
                                        value: null,
                                        visible: true,
                                        className: "swal-close-btn",
                                    },
                                    markArrived: {
                                        text: "Mark Arrived",
                                        value: "Mark Arrived",
                                        visible: true,
                                        className: "swal-mark-arrived-btn",
                                        closeModal: true
                                    },
                                    cancelReservation: {
                                        text: "Cancel Reservation",
                                        value: "Cancel Reservation",
                                        visible: true,
                                        className: "swal-cancel-btn  alert-danger ",
                                        closeModal: true
                                    }
                                }
                            }).then((value) => {
                                switch (value) {
                                    case "Mark Arrived":
                                        $.ajax({
                                            type: "POST",
                                            url: "markArrived",
                                            data: {
                                                reservationID: reservationID
                                            },
                                            success: function(response) {
                                                if (response == 1) {
                                                    toastr.success("Reservation " + reservationID + " marked arrived");
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);
                                                } else {
                                                    console.log(response);
                                                    toastr.error("Failed to mark reservation as arrived");
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);
                                                }
                                            }
                                        });
                                        break;
                                    case "Cancel Reservation":
                                        $.ajax({
                                            type: "POST",
                                            url: "cancelLateReservation",
                                            data: {
                                                reservationID: reservationID
                                            },
                                            success: function(response) {
                                                if (response == 1) {
                                                    toastr.success('Reservation ' + reservationID + ' cancelled successfully');
                                                    setTimeout(function() {
                                                        location.reload();
                                                    }, 2000);
                                                } else {
                                                    toastr.error("Failed to cancel reservation");
                                                    // setTimeout(function() {
                                                    //     location.reload();
                                                    // }, 2000);
                                                }
                                            }
                                        });
                                        break;
                                }
                            });
                        }
                    }

                }
            });
        }
    </script>
</body>

</html>