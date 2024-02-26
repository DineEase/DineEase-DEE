<style>
    .top-bar {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 100;
            position: relative;

        }

        .logo-name h1 {
            margin-left: 20px;
            font-size: 25px;

        }

        .logo img {
            height: 50px;
            margin-left: 20px;
            /* Add some margin to the left to separate it from the edge */
        }

        .user-info {
            display: flex;
            align-items: center;
            font-size: 18px;
        }

        .user-name {
            margin-left: 10px;
            font-weight: bold;
            text-decoration: none;
            /* Remove underline */
            color: #fff;
            /* Set text color to white */
            transition: color 0.3s ease;
            /* Add transition for smooth effect */
        }

        .user-name a {
            text-decoration: none;
            /* Remove underline */
            color: #fff;
            /* Set text color to white */
            transition: color 0.3s ease;
            /* Add transition for smooth effect */
        }

        .user-name a:hover {
            color: #27ae60;
            /* Change text color on hover */
        }


        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
            border: 2px solid #fff;
            /* Add border to make it stand out */
            transition: border-color 0.3s ease, transform 0.3s ease;
            /* Add transition for smooth effect */
        }

        .profile-image:hover {
            border-color: #27ae60;
            /* Change border color on hover */
            transform: scale(1.2);
            /* Increase size on hover */
        }
        </style>

<div class="top-bar">
        <div class="logo">
            <a href="<?php echo URLROOT ?>/managers/index">
                <img src="<?php echo URLROOT ?>/public/img/login/dineease-logo.svg" alt="Logo">
            </a>
        </div>
        <div class="logo-name">
            <h1>DineEase</h1>
        </div>
        <div class="user-info">
            Hello, &nbsp; <?php echo ucfirst($_SESSION['role']) ?> <span class="user-name"> &nbsp; | &nbsp;
                <?php
                $user_id = $_SESSION['user_id'];
                $profile_picture_url = URLROOT . '/uploads/profile/' . basename($_SESSION['profile_picture']);
                $user_name = $_SESSION['user_name'];
                echo '<a href="' . URLROOT . '/managers/viewprofile/' . $user_id . '">' . $user_name . '</a>';
                ?>
            </span>
            <a href="<?php echo URLROOT . '/managers/viewprofile/' . $user_id ?>">
                <img class="profile-image" src="<?php echo $profile_picture_url; ?>" alt="Profile Image">
            </a>
        </div>
    </div>