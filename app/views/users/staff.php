<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-main">
    <?php require APPROOT . '/views/inc/navbar-login.php'; ?>
        <div class="staff-login-container">
            <div class="login-card">
                <?php flash('register_success') ?>
                <h2>Staff Login</h2>
                <p>Enter your credentials to login.</p>
                <form action="<?php echo URLROOT; ?>/users/staff" method="post">
                    <div class="input-div">
                        <label for="mobile_no">Mobile Number: <sup class="required">*</sup></label>
                        <input type="text" class="<?php echo (!empty($data['mobile_no_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your mobile no." name="mobile_no" value="<?php echo isset($data['mobile_no']) ? $data['mobile_no'] : ''; ?>">
                        <span class="invalid-feedback"> <?php echo $data['mobile_no_err'] ?> </span>
                    </div>
                        
                    <div class="input-div">
                        <label for="password">Password: <sup class="required">*</sup></label>
                        <input type="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" placeholder="Enter your password" name="password" value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
                        <span class="invalid-feedback"> <?php echo $data['password_err'] ?> </span>
                    </div>

                    <button type="submit">Login</button>
                </form>
                <div class="login-switch">Not a Staff Member? <a href="<?php echo URLROOT ?>/users/Login">Customer Login </a></div>
                <div class="login-switch"><sub>Dine Ease - 2023</sub></div>
            </div>
        </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>