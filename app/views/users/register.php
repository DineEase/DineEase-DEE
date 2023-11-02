<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-main">
    <?php require APPROOT . '/views/inc/navbar-login.php'; ?>
    <div class="hero">
        <div class="hero-content">
        </div>
        <div class="hero-image">
            <div class="login-container">
                <div class="login-card">
                    <h2>Create an account?</h2>
                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <label for="name">Name : <sup class="required">*</sup></label>
                        <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your name" value="<?php echo $data['name'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['name_err'] ?> </span>

                        <label for="email">Email : <sup class="required">*</sup></label>
                        <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your email" value="<?php echo $data['email'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['email_err'] ?> </span>

                        <label for="dob">Date of Birth : <sup class="required">*</sup></label>
                        <input type="date" name="dob" class="<?php echo (!empty($data['dob_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your date of birth" value="<?php echo $data['dob'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['dob_err'] ?> </span>

                        <label for="mobile_no">Mobile Number : <sup class="required">*</sup></label>
                        <input type="text" name="mobile_no" class="<?php echo (!empty($data['mobile_no_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your mobile no." value="<?php echo $data['mobile_no'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['mobile_no_err'] ?> </span>

                        <label for="password">Password : <sup class="required">*</sup></label>
                        <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your password" value="<?php echo $data['password'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['password_err'] ?> </span>

                        <label for="confirm_password">Confirm Password : <sup class="required">*</sup></label>
                        <input type="password" name="confirm_password" class="<?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>" placeholder="Enter your confirm password" value="<?php echo $data['confirm_password'] ?>">
                        <span class="invalid-feedback"> <?php echo $data['confirm_password_err'] ?> </span>

                        <button type="submit">Register</button>

                    </form>
                    <div class="login-switch">Already have an account? <a href="<?php echo URLROOT?>/users/login">Login here</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>