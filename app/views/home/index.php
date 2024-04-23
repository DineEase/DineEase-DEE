<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/homepage.css" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
  <title><?php echo SITENAME; ?></title>
</head>

<body>
  <nav>
    <div class="container-main-nav">
      <div class="navbar">
        <div class="navbar-logo">
          <a href="<?php echo URLROOT ?>">
            <img src="<?php echo URLROOT ?>/public/img/login/dineease-logo.svg" alt="DineEase Logo">
          </a>
        </div>
        <div class="title">DineEase</div>
        <div class="navigation">
          <ul class="nav-list">
            <li class="nav-item"><button id="defaultNav" class="no-style-button navbar-active-top" onclick="showSite('home');">Home</button></li>
            <li class="nav-item"><button class="no-style-button" onclick="showSite('special');">Special</button></li>
            <li class="nav-item"><button class="no-style-button" onclick="showSite('client');">Reviews</button></li>
            <li class="nav-item"><button class="no-style-button" onclick="showOuterMenus();">Menus</button></li>
            <li class="nav-item"><button class="no-style-button" onclick="showAvailability();">Availability</button></li>
          </ul>
        </div>
        <div class="nav-login-buttons">
          <a href="<?php echo URLROOT ?>/users/login">
            <button class="btn-nav login text-register">Login</button>
          </a>
          <a href="<?php echo URLROOT ?>/users/register">
            <button class="btn-nav register text-register">Register</button>
          </a>


        </div>
      </div>
    </div>

  </nav>
  <div id="outer-site" class="show">

    <header class="section__container header__container" id="home">
      <div class="header__image">
        <img src="<?php echo URLROOT; ?>/img/homeAssets/header.png" alt="header" />
      </div>
      <div class="header__content">
        <h1><span>Redefining</span><br> The Way You Experience <span>Dining</span>.</h1>
        <p class="section__description">
          From table to taste, DineEase orchestrates a symphony of dining delight, harmonizing reservations, menus, and experiences effortlessly.
        </p>
        <div class="header__btn">
          <button class="btn">Get Started</button>
        </div>
      </div>
    </header>
    <section class="section__container special__container" id="special">
      <h2 class="section__header">Our Special Dish</h2>
      <p class="section__description">
        Each dish promises an unforgettable dining experience, blending
        innovation with tradition to delight your senses.
      </p>
      <div class="special__grid">
        <div class="special__card">
          <img src="<?php echo URLROOT; ?>/img/homeAssets/special-1.png" alt="special" />
          <h4>Chicken Veg Curry</h4>
          <p>
            Diced chicken simmered in aromatic curry sauce with mixed veggies
            like potatoes, cauliflower, and beans for a hearty, flavorful dish.
          </p>
          <div class="special__ratings">
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
          </div>
          <div class="special__footer">
            <p class="price">LKR 1200/=</p>
            <button class="btn">Add to Cart</button>
          </div>
        </div>
        <div class="special__card">
          <img src="<?php echo URLROOT; ?>/img/homeAssets/special-2.png" alt="special" />
          <h4>Chicken Veg Stir-Fry</h4>
          <p>
            Tender chicken strips wok-tossed with a colorful array of fresh
            vegetables in a flavorful blend of spices and sauces.
          </p>
          <div class="special__ratings">
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
          </div>
          <div class="special__footer">
            <p class="price">LKR 1500/=</p>
            <button class="btn">Add to Cart</button>
          </div>
        </div>
        <div class="special__card">
          <img src="<?php echo URLROOT; ?>/img/homeAssets/special-3.png" alt="special" />
          <h4>Chicken Veg Pasta</h4>
          <p>
            Al dente pasta tossed with chicken strips and a mix of vibrant
            vegetables in a creamy garlic herb sauce, offering a delightful
            pasta experience.
          </p>
          <div class="special__ratings">
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
            <span><i class="ri-star-fill"></i></span>
          </div>
          <div class="special__footer">
            <p class="price">LKR 1750/=</p>
            <button class="btn">Add to Cart</button>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container explore__container">
      <div class="explore__image">
        <img src="<?php echo URLROOT; ?>/img/homeAssets/explore.png" alt="explore" />
      </div>
      <div class="explore__content">
        <h1 class="section__header">We Serve Healthy & Tasty Food</h1>
        <p class="section__description">
          Indulge guilt-free with our commitment to serving wholesome and
          delicious meals. Explore a menu curated to balance taste and
          nutrition, ensuring every bite is both satisfying and nourishing.
        </p>
        <div class="explore__btn">
          <button class="btn">
            Explore Story <span><i class="ri-arrow-right-line"></i></span>
          </button>
        </div>
      </div>
    </section>

    <section class="section__container banner__container">
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-reserved-line"></i></span>
        <h4>Place your Reservation</h4>
        <p>
          Seamlessly place your food orders online with just a few clicks. Enjoy
          convenience and efficiency as you can seee the availiablity realtime.
        </p>

      </div>
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-bowl-fill"></i></span>
        <h4>Order Your Food</h4>
        <p>
          Customize your dining experience by choosing from a tantalizing array
          of options. For savory, sweet, or in between craving, find the perfect
          meal to satisfy your appetite.
        </p>

      </div>
      <div class="banner__card">
        <span class="banner__icon"><i class="ri-star-smile-fill"></i></span>
        <h4>Arrive and Enjoy Your Food</h4>
        <p>
          Savor every bite of your meal in a warm and inviting ambiance. Our
          friendly staff ensures a delightful dining experience that leaves you
          smiling.
        </p>

      </div>
    </section>

    <section class="chef" id="chef">
      <img src="<?php echo URLROOT; ?>/img/homeAssets/topping.png" alt="topping" class="chef__bg" />
      <div class="section__container chef__container">
        <div class="chef__image">
          <img src="<?php echo URLROOT; ?>/img/homeAssets/chef.png" alt="chef" />
        </div>
        <div class="chef__content">
          <h2 class="section__header">Cooked By The Best Chefs</h2>
          <p class="section__description">
            Experience culinary excellence crafted by master chefs from around
            the globe. Our team of culinary virtuosos brings together expertise,
            innovation, and passion to create unforgettable dining experiences
            that redefine gastronomy.
          </p>
          <ul class="chef__list">

          </ul>
        </div>
      </div>
    </section>

    <section class="section__container client__container" id="client">
      <h2 class="section__header">What Our Customers Are Saying</h2>
      <p class="section__description">
        Discover firsthand experiences and testimonials from our valued patrons.
        Explore the feedback and reviews that showcase our commitment to
        quality, service, and customer satisfaction.
      </p>
      <div class="client__swiper">
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  DineEase's culinary expertise never fails to impress! Every
                  dish is a masterpiece, bursting with flavor and freshness.
                </p>
                <img src="<?php echo URLROOT; ?>/img/homeAssets/client-1.jpg" alt="client" />
                <h4>Deon Perera</h4>
                <h5>Business Executive</h5>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  I always turn to DineEase for a quick and delicious meal. Their osering and reservation system is too easy and fast. Their
                  efficient service and mouthwatering options never disappoint!
                </p>
                <img src="<?php echo URLROOT; ?>/img/homeAssets/client-2.jpg" alt="client" />
                <h4>Hasitha Gamage</h4>
                <h5>Food Blogger</h5>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="client__card">
                <p>
                  DineEase has become my go-to for all my catering needs. Their
                  attention to detail and exceptional customer service make
                  every event a success.
                </p>
                <img src="assets/client-3.jpg" alt="client" />
                <h4>Antony Gunarathne</h4>
                <h5>Event Planner</h5>
              </div>
            </div>
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <footer class="footer" id="contact">

      <div class="footer__bar">
        Copyright © DineEase Restaurant Reservation System. All rights reserved.
      </div>
    </footer>
  </div>
  <div id="outer-menu">
    <div class="view-only-menu">
      <div class="customer-menu-view">
        <div class="menu-view-header-bar">

          <div class="menu-view-filters">
            <div class="menu-categories">
              <button class="category-button active-category" data-category-id="all">All</button>
              <button class="category-button" data-category-id="1">Desserts & Drinks</button>
              <button class="category-button" data-category-id="2">Main Courses</button>
              <button class="category-button" data-category-id="3">Appetizers & Sides</button>
              <button class="category-button" data-category-id="4">Salads & Soups</button>
              <button class="category-button" data-category-id="5">Breakfast & Brunch</button>
              <button class="category-button" data-category-id="6">International Cuisine</button>
              <button class="category-button" data-category-id="7">Special</button>
            </div>
          </div>
          <div class="menu-view-head">
            <div class="search-reservation">
              <form class="search-form" method="GET" action="">
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
          <div class="view-pagination-container">
            <div class="view-pagination">
              <button class="view-pagination-button " id="prev-page">Previous</button>
              <span class="view-pagination-text" id="page-info"></span>
              <button class="view-pagination-button" id="next-page">Next</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div id="outer-availability">
    aviailability
  </div>
  <script>
    const URLROOT = "<?php echo URLROOT; ?>";
    var foodReviews = <?php echo json_encode($data['foodReview']); ?>;
    var menus = <?php echo json_encode($data['menus']); ?>;
    let itemsPerPage = 18;

  </script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script>
  <script src="<?php echo URLROOT; ?>/js/menu.js"></script>
  <script src="<?php echo URLROOT; ?>/js/homepage.js"></script>
  
  </script>
</body>

</html>