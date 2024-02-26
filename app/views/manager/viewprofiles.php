<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include any necessary stylesheets or scripts here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .header {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
            font-size: 24px;
        }

        .profile-container {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .profile-field {
            margin-bottom: 15px;
        }

        .profile-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-field span {
            display: inline-block;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .role-change-form {
            margin-top: 20px;
            text-align: center;
        }

        .role-change-form label,
        .role-change-form select,
        .role-change-form input[type="submit"] {
            margin-bottom: 10px;
        }

        .home-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        /* Styling for success alert */
        .alert {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>User Profile</h2>
    </div>

    <div class="profile-container">
        <?php if ($data['users']) : ?>
            <?php $user = $data['users']; ?>

            <img class="profile-image" src="<?php echo URLROOT; ?>/uploads/profile/<?php echo basename($user->profile_picture); ?>" alt="Profile Image">

            <div class="profile-field">
                <label for="name">Name:</label>
                <span id="name"><?php echo $user->name; ?></span>
            </div>

            <div class="profile-field">
                <label for="email">Email:</label>
                <span id="email"><?php echo $user->email; ?></span>
            </div>

            <div class="profile-field">
                <label for="address">Address:</label>
                <span id="address"><?php echo $user->address; ?></span>
            </div>

            <div class="profile-field">
                <label for="role">Role:</label>
                <span id="role"><?php echo $user->role_name; ?></span>
            </div>

            <div class="profile-field">
                <label for="nic">NIC:</label>
                <span id="nic"><?php echo $user->nic; ?></span>
            </div>
            <?php if ($user->role_id != 1) : ?>
            
            <!-- Delete Profile Button -->
            <form action="<?php echo URLROOT; ?>/managers/deleteprofile/<?php echo $user->user_id; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this profile?');">
                <button type="submit" class="delete-button">Delete Profile</button>
            </form>

        

        <!-- Role Change Form -->
        <form class="role-change-form" action="<?php echo URLROOT; ?>/managers/updateuserrole/<?php echo $user->user_id; ?>" method="POST" id="roleChangeForm">
            <label for="role">Choose a role:</label>
            <select id="role" name="role">
                
                <option value="2" <?php echo ($user->role_id == 2) ? 'disabled' : ''; ?>>Inventory Manager</option>
                <option value="3" <?php echo ($user->role_id == 3) ? 'disabled' : ''; ?>>Receptionist</option>
                <option value="4" <?php echo ($user->role_id == 4) ? 'disabled' : ''; ?>>Chef</option>
            </select>
            <br>
            <input type="submit" value="Change">
        </form>

        <!-- Success Alert -->
        <div id="successAlert" class="alert" style="display:none;">
            User role changed successfully!
        </div>
        <?php endif; ?>

        <?php else : ?>
            <p>No user data available.</p>
        <?php endif; ?>
        <a href="<?php echo URLROOT; ?>/managers/index" class="home-button">Home</a>
    </div>

    <!-- JavaScript to show success alert -->
    <script>
        document.getElementById('roleChangeForm').addEventListener('submit', function () {
            alert("User role changed successfully!");
            document.getElementById('successAlert').style.display = 'block';
        });
    </script>

</body>

</html>
