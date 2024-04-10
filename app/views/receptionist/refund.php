<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/receptionist-styles.css">
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
                                <a href="<?php echo APPROOT ?>/receptionist/refund" class="nav_link" onclick="changeContent('refund')">
                                    <button class="button-sidebar-menu active-nav">
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
                                <a href="<?php echo URLROOT ?>/receptionists/review" class="nav_link" onclick="changeContent('review')">
                                    <button class="button-sidebar-menu">
                                        <span class="navlink_icon">
                                            <span class="material-symbols-outlined ">
                                                reviews
                                            </span>
                                        </span>
                                        <span class="button-sidebar-menu-content">Reviews </span>
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
            <div class="reservation-container">
                <div class="tabset">
                    <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
                    <label for="tab1">View Refund Requests</label>


                    <div class="tab-panels">
                        <section id="view" class="tab-panel">
                            <div class="content read">
                                <h2>View Refund Requests</h2>

                                <table>
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>InvoiceID</td>
                                            <td>CustomerID</td>
                                            <td>Body</td>
                                            <td>price</td>
                                            <td>Date</td>
                                            <td></td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($data['request'] as $request) : ?>

                                            <tr>
                                                <td></td>
                                                <td><?php echo $request->invoiceID;
                                                    ?></td>
                                                <td><?php echo $request->body;
                                                    ?></td>
                                                <td><?php echo $request->price;
                                                    ?></td>
                                                <td><?php echo $request->date; ?></td>

                                                <td class="actions">
                                                    <a href="<?php echo URLROOT ?>/Receptionists/showrefund" class="view"><i class="fa-solid fa-eye"></i></fa-solid></a>
                                                    <a href="<?php echo URLROOT ?>/Receptionists/editrefund/<?php //echo $data['post']->id; 
                                                                                                            ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>

                                                    <a href="<?php echo URLROOT; ?>/Receptionistss/deleterefund/<?php //echo $data['post']->id; 
                                                                                                                ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>


                                <div class="pagination">

                                    <a href="<?php echo URLROOT ?>Receptionists/addrefund""><i class=" fa-solid fa-plus"></i> Add requests </a>
                                    <a href="#"><i class="fas fa-angle-double-left fa-sm"></i></a>
                                    <a href="#"><i class="fas fa-angle-double-right fa-sm"></i></a>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>