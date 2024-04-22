<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/public/img/login/favicon.ico">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <title><?php echo SITENAME; ?></title>
    <style>
        .navbar {
            background: #ffffff;
            padding: 15px 40px 15px 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            width: 100vw;
            height: 7vh;
            position: relative;
            box-shadow: 0px 0px 5.92px 0px rgba(0, 0, 0, 0.12);
            border-bottom: solid 1px #57a297;
        }

        .nav-login-buttons {
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            margin-left: 5px;
        }

        .dineease-logo {
            border-radius: 100px;
            flex-shrink: 0;
            width: 30px;
            height: 30px;
            position: relative;
        }

        .title {
            color: var(--brand-black, #12130f);
            text-align: left;
            font: 400 27.62px/35.51px "Poiret One", sans-serif;
            position: relative;
            flex: 1;
        }

        .navigation {
            background: #ffffff;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            position: relative;
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            margin-right: 15px;
        }

        .nav-link {
            font-size: 16px;
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .logout-link {
            font-size: 16px;
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .tab {
            color: var(--brand-black, #12130f);
            text-align: left;
            font: 400 15.78px/23.67px "Roboto", sans-serif;
            position: relative;
        }

        .login {
            background: var(--brand-darkgreen, #166c45);
        }

        .login .text-register {
            background: var(--brand-darkgreen, #5b9279);
        }

        .register {
            background: var(--brand-black, #12130f);
        }

        .register .text-register {
            background: var(--brand-black, #12130f);
        }

        .btn-nav {
            border-radius: 8px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 0px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 100px;
            height: 40px;
            position: relative;
            cursor: pointer;
            transition: box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .btn-nav:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        button.login:hover {
            background-color: #5b9279;
        }

        button.register:hover {
            background-color: #333;
        }

        .text-register {
            border: none;
            color: #ffffff;
            text-align: left;
            font: 500 16px/24px "Roboto", sans-serif;
            position: relative;
            text-decoration: underline none;
        }

        .nav-login-buttons a {
            text-decoration: none;
            color: #ffffff;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            margin-right: 5px;
        }

        .navbar-logo img {
            height: 30px;
            margin-right: 10px;
        }



        #outer-site,
        #outer-menu,
        #outer-availability {
            display: none;
            position: relative;
            top: 4em;
        }

        #outer-menu.show {
            display: block !important;
        }

        .show {
            display: block !important;
        }

        .hide {
            display: none !important;
        }

        .no-style-button {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        .no-style-button:hover {
            text-decoration: underline;
            font-weight: bolder;
        }

        .navbar-active-top {
            color: #166c45;
            font-weight: bolder;
        }
    </style>
</head>

<body>