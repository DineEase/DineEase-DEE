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
<style>
    /* Reset default margin and padding for elements */
    /* Reset default margin and padding for elements */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
    }

    /* Style the profile container */
    .profile-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .user-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-header h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .heroimage {
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }

    .buttons {
        text-align: center;
        margin-bottom: 20px;
    }

    button.update,
    button.cancel,
    button.change-btn {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s, transform 0.3s;
    }

    button.cancel {
        background-color: #ccc;
    }

    .upload-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .upload-container h2 {
        font-size: 20px;
        color: #000;
        margin-bottom: 10px;
    }

    .file-input {
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        display: inline-block;
    }

    .important-message {
        color: #ff0000;
        font-size: 14px;
        margin-top: 10px;
    }

    .loyalty-container {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .loyalty-container h2 {
        font-size: 20px;
        color: #000;
        margin-bottom: 10px;
    }

    .loyalty-points {
        font-size: 22px;
        font-weight: bold;
        color: #4CAF50;
    }

   
    .profilecard {
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
    }

    .card-body table {
        width: 100%;
    }

    .profdetails {
        font-weight: bold;
        font-size: 16px;
    }

    .change-password {
        margin-top: 20px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .change-password label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .change-password input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .change-password input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        margin-top: 10px;
    }

    button.update:hover,
    button.cancel:hover,
    button.change-btn:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }

    .change-password input[type="submit"]:hover {
        background-color: #45a049;
    }

    @media screen and (max-width: 480px) {
        .profile-container {
            padding: 10px;
        }
    }

    .main-profile-div{
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        top: 7vh;
    
    }

</style>

<body><div class= main-profile-div>
    
    iv class="container">
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
                                  <button class="button-sidebar-menu " id="reservationButton">
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
                                  <button class="button-sidebar-menu active-nav" id="reservationButton">
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
              <div class="profile-container">
                  <div class="user-header">
                      <h2>User Profile</h2>
                      <img class="heroimage" src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar">
                  </div>
                  <div class="buttons">
                      <button class="update"><i class="fa-solid fa-square-pen"></i> Update</button>
                      <button class="cancel">Cancel</button>
                  </div>
    
                  <div class="upload-container">
                      <h2>Upload New Profile Picture:</h2>
                      <label for="file-upload" class="file-input">
                          <input type="file" id="file-upload" accept=".jpg" class="profile-pic">
                          <p class="important-message">* Only .jpg files will be accepted</p>
                      </label>
                  </div>
    
                  <div class="loyalty-container">
                      <h2>Loyalty Points</h2>
                      <p>Your current loyalty points: <span class="loyalty-points">250</span></p>
                  </div>
    
                  <div class="profilecard">
                      <div class="card-body">
                          <table>
                              <tr>
                                  <td>
                                      <p class="profdetails">User Name</p>
                                  </td>
                                  <td>:</td>
                                  <td>MR Eve Perera</td>
                              </tr>
                              <tr>
                                  <td>
                                      <p class="profdetails">Address</p>
                                  </td>
                                  <td>:</td>
                                  <td>222/1, Saman Mawatha, East</td>
                              </tr>
                              <tr>
                                  <td>
                                      <p class="profdetails">Contact Number</p>
                                  </td>
                                  <td>:</td>
                                  <td>0715714175</td>
                              </tr>
                              <tr>
                                  <td>
                                      <p class="profdetails">Email</p>
                                  </td>
                                  <td>:</td>
                                  <td>eve@gmail.com</td>
                                  <td><button class="change-btn">Change</button></td>
                              </tr>
                          </table>
                      </div>
                  </div>
    
                  <form action="/action_page.php" class="change-password">
                      <h2>Change User Name & Password</h2>
                      <label for="usrname">Username</label>
                      <input type="text" id="usrname" name="usrname" required>
                      <label for="old-psw">Old Password</label>
                      <input type="password" id="old-psw" name="old-psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                      <label for="new-psw">New Password</label>
                      <input type="password" id="new-psw" name="new-psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                      <label for="confirm-psw">Confirm New Password</label>
                      <input type="password" id="confirm-psw" name="confirm-psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                      <input type="submit" value="Submit">
                  </form>
              </div>  
          </div>
      </div>
    div>
</div class= main-profile-div>
    <script src="<?php echo URLROOT; ?>/js/jquery-3.7.1.js"></script> 
    <script src="<?php echo URLROOT; ?>/js/customer.js"></script>
</body>

</html>