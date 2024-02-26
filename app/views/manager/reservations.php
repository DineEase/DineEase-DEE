<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Table and Package</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Add Capacity and Package for a New Table</h1>
    
    <form action="<?php echo URLROOT; ?>/managers/addtable" method="post">
        <label for="packageDropdown">Select Package:</label>
        <select id="packageDropdown" name="packageID">
            <?php
                foreach ($data['packages'] as $package) {
                    echo "<option value=\"{$package->packageID}\">{$package->packageName}</option>";
                }
            ?>
        </select>

        <label for="capacityInput">Enter Capacity (Numbers Only):</label>
        <input type="number" id="capacityInput" name="capacity" pattern="\d+" required>

        <input type="submit" value="Add">
    </form>
</body>
</html>
