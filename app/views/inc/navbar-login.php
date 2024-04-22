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
                <li class="nav-item"><button class="no-style-button " onclick="showSite('home');">Home</button></li>
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