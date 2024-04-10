<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/receptionist-styles.css">
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
                                    <button class="button-sidebar-menu " id="reservationButton">
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
                                    <button class="button-sidebar-menu active-nav" id="reservationButton">
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
                <div class="review-container">
                    <div class="testimonials">
                        <div class="inner">
                            <h1>Reviews</h1>
                            <div class="border"></div>
                            <div class="row">


                                <div id="add-review-button" class="add-review-button" onclick="toggleReviewForm()">+</div>

                                <!-- Add Review Pop-up Card -->
                                <div id="add-review-popup" class="add-review-popup">
                                    <div class="add-review-card">
                                        <h2>Add a Review</h2>
                                        <form action="<?php echo URLROOT; ?>/customers/review" method="post">
                                            <label for="rating">Rating:</label>
                                            <select id="rating" name="rating" required>
                                                <option value="1">1 (Poor)</option>
                                                <option value="2">2 (Fair)</option>
                                                <option value="3">3 (Average)</option>
                                                <option value="4">4 (Good)</option>
                                                <option value="5">5 (Excellent)</option>
                                            </select>

                                            <label for="comment">Your Comment:</label>
                                            <textarea id="comment" name="comment" rows="4" required></textarea>

                                            <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">

                                            <button type="submit" class="submit-button">Submit Review</button>
                                        </form>
                                        <div class="close-button" onclick="toggleReviewForm()">X</div>
                                    </div>
                                </div>

                                <?php if (!empty($data['reviews'])) : ?>
                                    <?php foreach ($data['reviews'] as $review) : ?>
                                        <div class="col">
                                            <div class="testimonial">
                                                <div class="name"><?php echo $_SESSION['user_name']; ?></div>
                                                <div class="stars">
                                                    <?php for ($i = 0; $i < $review->rating; $i++) : ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <p class="comment-preview">
                                                    <?php echo substr($review->comment, 0, 100); ?> <!-- Display the first 100 characters -->
                                                    <?php if (strlen($review->comment) > 100) : ?>
                                                        <span id="more-<?php echo $review->reviewID; ?>" class="more">...<br><button onclick="toggleComment(<?php echo $review->reviewID; ?>)">View More</button></span>
                                                        <span id="full-comment-<?php echo $review->reviewID; ?>" class="full-comment" style="display: none;"><?php echo substr($review->comment, 100); ?></span>
                                                    <?php endif; ?>
                                                </p>
                                                <form action="<?php echo URLROOT; ?>/customers/deleteReview/<?php echo $review->reviewID; ?>" method="post">
                                                    <input type="hidden" name="remove_review_id" value="<?php echo $review->reviewID; ?>">
                                                    <button type="submit" class="menu-remove-button" onclick="return confirm('Are you sure you want to remove this review?');" >Remove Review</button>
                                                </form>

                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>No reviews available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>