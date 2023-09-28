<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-main">
    <?php require APPROOT . '/views/inc/navbar-login.php'; ?>
    <div class="hero">
        <div class="hero-content">
        </div>
        <div class="hero-image">
            <div class="login-container">
                <div class="login-card">
                    <h2>Welcome Back!</h2>
                    <p>Enter your credentials to login.</p>
                    <form action="<?php echo URLROOT; ?>/users/login" method="post">
                        <label for="mobile_no">Mobile Number: <sup class="required">*</sup></label>
                        <input type="text" id="mobile_no" class="<?php echo (!empty($data['mobile_no_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your mobile no." value="<?php echo $data['mobile_no'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['mobile_no_err'] ?> </span>

                        <label for="password">Password: <sup class="required">*</sup></label>
                        <input type="password" id="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your password" value="<?php echo $data['password'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['password_err'] ?> </span>

                        <button type="submit">Login</button>
                    </form>
                    <div class="login-switch">Don't have an account? <a href="<?php echo URLROOT?>/users/register">Register here</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>