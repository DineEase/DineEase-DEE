<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-main">
    <?php require APPROOT . '/views/inc/navbar-login.php'; ?>
    <div class="hero">
        <div class="hero-content">
        </div>
        <div class="hero-image">
            <div class="login-container">
                <div class="login-card">
                    <h2>Login Form</h2>
                    <form>
                        <label for="login-username">Mobile No.</label>
                        <input type="text" id="login-username" placeholder="Enter your username">

                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" placeholder="Enter your password">

                        <button type="submit">Login</button>
                    </form>
                    <div class="login-switch">Don't have an account? <a href="#" onclick="loginSwitchCard()">Register here</a></div>
                </div>

                <div class="login-card" style="display: none;">
                    <h2>Register Form</h2>
                    <form action="<?php echo URLROOT; ?>/users/register" method="post"  >
                        <label for="register-fullname">Full Name</label>
                        <input type="text" id="register-fullname" placeholder="Enter your full name">

                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" placeholder="Enter your email">

                        <label for="register-new-password">New Password</label>
                        <input type="password" id="register-new-password" placeholder="Enter your new password">

                        <button type="submit">Register</button>
                    </form>
                    <div class="login-switch">Already have an account? <a href="#" onclick="loginSwitchCard()">Login here</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>