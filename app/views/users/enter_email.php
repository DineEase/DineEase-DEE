<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset </title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form class="login-form" action="<?php echo URLROOT; ?>/users/forgotPassword" method="post">
        <h2 class="form-title">Reset password</h2>
        
        <div class="form-group">
            <label>Your email address</label>
            <input type="email" name="email">
        </div>

        <?php if (isset($data['email_err']) && !empty($data['email_err'])) : ?>
            <div class="error-message"><?php echo $data['email_err']; ?></div>
        <?php endif; ?>

        <div class="form-group">
            <button type="submit" name="reset-password" class="login-btn">Submit</button>
        </div>
    </form>
</body>
</html>
