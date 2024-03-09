<!-- category.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="time"],
        select {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50; /* Green color for the home button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 5px;
            margin-left: 20px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">

        <header>
            <h1>Category Management</h1>
            <a href="<?php echo URLROOT; ?>/managers/index" style="color: white;">Home</a>
        </header>

        <script>
            function validateForm() {
                var startTime = document.getElementById('start_time').value;
                var endTime = document.getElementById('end_time').value;

                // Convert start time and end time to Date objects for comparison
                var startDate = new Date('1970-01-01T' + startTime + 'Z');
                var endDate = new Date('1970-01-01T' + endTime + 'Z');

                // Check if start time is greater than end time
                if (startDate > endDate) {
                    alert('Start time cannot be greater than end time.');
                    return false; // Prevent form submission
                }

                return true; // Allow form submission
            }
        </script>

        <h1>Update Category Time</h1>

        <!-- Display the form -->
        <form method="post" action="<?php echo URLROOT; ?>/managers/updatetimecategories" onsubmit="return validateForm()">
            <label for="category">Select Category:</label>
            <select name="category_ID" id="category" required>
                <?php foreach ($data['categories'] as $category) : ?>
                    <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
                <?php endforeach; ?>
            </select>

            <br>

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" id="start_time" required>

            <br>

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" id="end_time" required>

            <br>

            <input type="submit" value="Update Time">
        </form>

        <?php if (!empty($data['start_time_error'])) : ?>
            <p class="error-message"><?php echo $data['start_time_error']; ?></p>
        <?php endif; ?>
        
        <?php if (!empty($data['end_time_error'])) : ?>
            <p class="error-message"><?php echo $data['end_time_error']; ?></p>
        <?php endif; ?>
        
        <?php if (!empty($data['time_diff_err'])) : ?>
    <p class="error-message"><?php echo $data['time_diff_err']; ?></p>
<?php endif; ?>

        <h1>Manually Hide Category</h1>
<form method="post" action="<?php echo URLROOT; ?>/managers/hidecategory">
    <label for="category">Select Category:</label>
    <select name="category_ID" id="category" required>
        <?php foreach ($data['categories'] as $category) : ?>
            <?php if ($category->hidden_status == 0) : ?>
                <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Hide Category">
</form>
<h1>Manually Show Category</h1>
<form method="post" action="<?php echo URLROOT; ?>/managers/showcategory">
    <label for="category">Select Category:</label>
    <select name="category_ID" id="category" required>
        <?php foreach ($data['categories'] as $category) : ?>
            <?php if ($category->hidden_status == 1) : ?>
                <option value="<?php echo $category->category_ID; ?>"><?php echo $category->category_name; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Show Category">
</form>
    </div>
</body>
</html>
