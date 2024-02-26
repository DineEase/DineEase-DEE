<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <?php require APPROOT . '/views/manager/topbar.php'; ?>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }

        .imagePart {
            margin-bottom: 15px;
        }

        .imagePart img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            display: block;
        }

        .buttonGroup {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; /* Adjust the margin as needed */
}

button[type="submit"],
button[type="reset"],
.home-link {
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"] {
    background-color: #3498db;
    color: #fff;
}

button[type="reset"] {
    background-color: #e74c3c;
    color: #fff;
}

.home-link {
    background-color: #2ecc71;
    color: #fff;
}

.buttonGroup button:hover,
.home-link:hover {
    filter: brightness(90%); /* Add a hover effect, adjust as needed */
}

    </style>
</head>
<body>

<header>
    <h1>Restaurant Manager Dashboard</h1>
    <p>Welcome, <?php echo  $_SESSION['user_name'] ?></p>
</header>

<div class="container">
    <form action="<?php echo URLROOT; ?>/managers/addUsers" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters" required>

        <label for="role">Role Type:</label>
        <select id="role" name="role" required>
            <!--<option value="1">Manager</option> -->
            <option value="2">Inventory Manager</option>
            <option value="3">Receptionist</option>
            <option value="4">Chef</option>
        </select>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <span class="error"><?php echo isset($data['email_err']) ? $data['email_err'] : ''; ?></span>

        <label for="joined_date">Joined Date:</label>
        <input type="date" id="joined_date" name="joined_date" max="<?php echo date('Y-m-d'); ?>" required>

        <label for="nic">NIC:</label>
        <input type="text" id="nic" name="nic" required>
        <span class="error"><?php echo isset($data['nic_err']) ? $data['nic_err'] : ''; ?></span>

        <label for="mobile_number">Mobile Number:</label>
        <input type="tel" id="mobile_number" name="mobile_number" pattern="[0-9]{10}" title="Please enter a valid 10-digit mobile number" required>
        <span class="error"><?php echo isset($data['mobile_no_err']) ? $data['mobile_no_err'] : ''; ?></span>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        <span class="error"><?php echo isset($data['dob_err']) ? $data['dob_err'] : ''; ?></span>

        <!-- Input for profile picture -->
        <div class="imagePart">
            <button type="button" id="imageButton">Add Image</button>
            <input type="file" name="imagePath" accept="image/*" style="display: none;" id="imageInput" onchange="previewImage(event)">
            <img src="" alt="Image Preview">
        </div>

        <div class="buttonGroup">
            <button type="submit">Add User</button>
            <button type="reset">Reset Form</button>
            <a href="<?php echo URLROOT; ?>/managers/index" class="home-link">Home</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('imageButton').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });

    function previewImage(event) {
        var input = event.target;
        var preview = document.querySelector('.imagePart img');
        var reader = new FileReader();

        reader.onload = function () {
            preview.src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>
