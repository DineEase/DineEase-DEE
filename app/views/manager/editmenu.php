<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
    <?php require APPROOT . '/views/manager/topbar.php'; ?>
    <style>
        body {
            background-color: #ecf0f1; /* Lighter background color */
            color: #2c3e50; /* Dark font color */
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
        }

        h3 {
            font-size: 3rem;
            margin: 2rem 0;
            
        }

        .editmenu {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        

        .imagePart img {
            width: 350px;
            height: 400px;
            border-radius: 1rem;
            object-fit: cover;
            border: 5px solid #000000; /* Black border */
        }

        .imagePart span {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            background-color: #000000;
            color: #ffffff; /* White font color */
            font-size: 1.2rem;
            cursor: pointer;
        }

        .NamePart input,
        .NamePart select {
            width: 100%;
            padding: 1rem;
            font-size: 1.2rem;
            border: 2px solid #000000; /* Black border */
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            box-sizing: border-box;
        }
        .invalid-feedback {
            color: #ff0000;
            /* Red color for error messages */
            font-size: 1rem;
            margin-top: 5px;
            display: block;
        }
        .buttons button {
            color: #ffffff;
            background-color: #000000; /* Black button color */
            outline: none;
            border: none;
            font-size: 1.5rem;
            padding: 1rem 2rem;
            margin-right: .7rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .buttons button:hover {
            background-color: #2c3e50; /* Darker background color on hover */
        }

        .menubuttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .buttons,
        .menubuttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="editmenu">

        <div class="header">
            <h3>Edit Menu</h3>
        </div>

        <div class="others">
            <div class="imagePart">
                <img src="<?php echo URLROOT . '/uploads/' . basename($data['imagePath']); ?>" alt="Menu Item Image" />
                <div class="buttons">
                    <form action="<?php echo URLROOT; ?>/managers/editMenuitem/<?php echo $data['itemID']; ?>"
                        method="post" enctype="multipart/form-data" id="menuForm">
                        <button type="button" id="imageButton">Edit Image</button>
                        <input type="file" name="imagePath" accept="image/*" style="display: none;" id="imageInput"
                            onchange="previewImage(event)">
                </div>
            </div>

            <div class="NamePart">
                <label for="category">Select Category:</label>
                <select id="category" name="category" required>
                    <?php foreach ($data['menucategory'] as $category) : ?>
                        <?php $selected = ($category->category_ID == $data['category_ID']) ? 'selected' : ''; ?>
                        <option value="<?php echo $category->category_ID; ?>" <?php echo $selected; ?>>
                            <?php echo $category->category_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <span>Name:</span> <?php echo htmlspecialchars($data['itemName']); ?>
                <input type="text" name="itemName"
                    class="<?php echo (!empty($data['itemName_err'])) ? 'is-invalid' : '' ?>" placeholder="Name"
                    required value="<?php echo $data['itemName']; ?>" />
                <span class="invalid-feedback"> <?php echo $data['itemName_err'] ?> </span>
                <span>Price LKR:</span> <?php echo htmlspecialchars($data['price']); ?>
                <input type="text" name="price" placeholder="Price" required
                    value="<?php echo htmlspecialchars($data['price']); ?>" />
                <span>Average Prepare Time MINS:</span><?php echo htmlspecialchars($data['averageTime']); ?>
                <input type="text" name="averageTime" placeholder="Time"
                    class="<?php echo (!empty($data['averageTime_err'])) ? 'is-invalid' : '' ?>" required
                    value="<?php echo htmlspecialchars($data['averageTime']); ?>" />
                <span class="invalid-feedback"> <?php echo $data['averageTime_err'] ?> </span>

                <div class="buttons">
                    <button type="submit">Save Changes</button>
                    <button type="button" id="cancelButton">Cancel</button>
                    <button type="button" id="deleteButton" onclick="deleteMenuAlert(<?php echo $data['itemID']; ?>)">Delete</button>

                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('imageButton').addEventListener('click', function () {
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

       

        

        function deleteMenuAlert(itemID) {
        var confirmDelete = confirm("Are you sure you want to delete this menu?");
        if (confirmDelete) {
            // Redirect to the delete endpoint on the server
            window.location.href = "<?php echo URLROOT; ?>/managers/deleteMenuitem/" + itemID;
        }
    }
    </script>
    <script>
        // Get the cancel button element by its ID
        var cancelButton = document.getElementById('cancelButton');

        // Add click event listener to the cancel button
        cancelButton.addEventListener('click', function (event) {
            // Redirect to the index page when the button is clicked
            window.location.href = '<?php echo URLROOT; ?>/managers/menu';
        });
    </script>

</body>

</html>
