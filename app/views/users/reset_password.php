<!-- reset_password.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>

    <?php if (!empty($data['error'])) : ?>
        <p style="color: red;"><?php echo $data['error']; ?></p>
    <?php endif; ?>

    <?php if (!empty($data['success'])) : ?>
        <p style="color: green;"><?php echo $data['success']; ?></p>
    <?php else : ?>
        <form action="<?php echo URLROOT; ?>/users/resetPassword/<?php echo $data['token']; ?>" method="post">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Reset Password</button>
        </form>
    <?php endif; ?>
</body>
</html>
