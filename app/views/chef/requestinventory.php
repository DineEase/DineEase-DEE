<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .quantity-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .quantity-container input {
            margin-right: 10px;
        }

        .deleteBtn {
            padding: 5px 10px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .deleteBtn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<form id="inventoryRequestForm">
    <label for="searchItem">Search Item:</label>
    <input type="text" id="searchItem" oninput="searchItems(this.value)">
    <br>

    <label for="itemSelect" >Select Items:</label>
    <select id="itemSelect" multiple >
    <?php foreach ($data['inventories'] as $inventory) : ?>
        <option value="<?php echo $inventory->inventorynameID; ?>" data-unit="<?php echo $inventory->units; ?>"><?php echo $inventory->inventoryName; ?></option>
        
    <?php endforeach; ?>
    </select>
    
    <br>
    
    <label for="quantityInputs">Quantities:</label>
    <div id="quantityInputs">
        <!-- Quantity inputs will be dynamically added here -->
    </div>
    
    <button type="button" id="addQuantity">Add Quantity</button>
    <br>
    <button type="button" id="submitBtn">Submit Request</button>
</form>
<script>
// Function to update local storage
function updateLocalStorage(itemID, itemName, quantity) {
    try {
        const quantities = JSON.parse(localStorage.getItem('quantities')) || {};
        quantities[itemID] = { itemName: itemName, quantity: parseInt(quantity, 10) };
        localStorage.setItem('quantities', JSON.stringify(quantities));
    } catch (error) {
        console.error('Error updating local storage:', error);
    }
}

// Load quantities from local storage
try {
    const quantities = JSON.parse(localStorage.getItem('quantities')) || {};
    const quantityInputs = document.getElementById('quantityInputs');

    // Populate quantity inputs
    Object.entries(quantities).forEach(([itemID, { itemName, quantity }]) => {
        const option = document.querySelector(`#itemSelect option[value="${itemID}"]`);
        const unit = option.getAttribute('data-unit');
        const label = document.createElement('label');
        label.textContent = `${option.textContent} Quantity (${unit}):`;
        const input = document.createElement('input');
        input.type = 'number';
        input.name = `quantities[${itemID}]`;
        input.value = quantity;
        input.min = '1';
        const deleteButton = createDeleteButton(input);
        quantityInputs.appendChild(label);
        quantityInputs.appendChild(input);
        quantityInputs.appendChild(document.createElement('br'));
        quantityInputs.appendChild(deleteButton);
    });
} catch (error) {
    console.error('Error loading quantities from local storage:', error);
}

// Event listener for quantity input changes
document.getElementById('quantityInputs').addEventListener('input', function(event) {
    const input = event.target;
    const itemID = input.name.match(/\[(.*)\]/)[1]; // Extract item ID from input name
    const itemName = document.querySelector(`#itemSelect option[value="${itemID}"]`).textContent; // Get item name from select menu option
    updateLocalStorage(itemID, itemName, input.value);
});

// Event listener for "Add Quantity" button
document.getElementById('addQuantity').addEventListener('click', function() {
    // Get selected items from the select element
    const selectedItems = Array.from(document.getElementById('itemSelect').selectedOptions);

    // Create quantity input fields for each selected item
    selectedItems.forEach(function(item) {
        const itemID = item.value;
        const itemName = item.text;
        const unit = item.getAttribute('data-unit');

        // Check if item is already added
        if (document.querySelector(`input[name='quantities[${itemID}]']`)) {
            alert(`Quantity for "${itemName}" already exists.`);
            return; // Item already added, skip
        }

        // Create label and input elements for quantity
        const label = document.createElement('label');
        label.textContent = `${itemName} Quantity (${unit}):`;
        const input = document.createElement('input');
        input.type = 'number';
        input.name = `quantities[${itemID}]`; // Use item ID as the key
        input.className = 'quantity';
        input.min = '1'; // Set minimum quantity

        // Append label and input to quantityInputs div
        quantityInputs.appendChild(label);
        quantityInputs.appendChild(input);
        quantityInputs.appendChild(document.createElement('br'));
        const deleteButton = createDeleteButton(input);
        quantityInputs.appendChild(deleteButton);
        // Update local storage with item name and quantity
        updateLocalStorage(itemID, itemName, input.value);
    });
});

// Function to create a delete button
function createDeleteButton(input) {
    if (input.nextSibling && input.nextSibling.classList.contains('deleteBtn')) {
        return;
    }
    
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = 'deleteBtn';
    deleteButton.addEventListener('click', function() {
        const itemID = input.name.match(/\[(.*)\]/)[1];
        const label = input.previousElementSibling;
    if (label && label.tagName === 'LABEL') {
        label.remove(); // Remove the label
    }
    const br = input.nextSibling; // Get the line break
        if (br && br.tagName === 'BR') {
            br.remove(); // Remove the line break
        }
        input.remove(); // Remove the input field
        deleteButton.remove(); // Remove the delete button
        deleteFromLocalStorage(itemID); // Remove the item from local storage
    });
    return deleteButton;
}

// Event listener for delete button clicks
// document.getElementById('quantityInputs').addEventListener('input', function(event) {
//     const input = event.target;
//     if (input.classList.contains('quantity')) {
//         const deleteButton = createDeleteButton(input);
//         input.parentNode.insertBefore(deleteButton, input.nextSibling); // Insert delete button after the input field
//     }
// });

// Function to delete item from local storage
function deleteFromLocalStorage(itemID) {
    const quantities = JSON.parse(localStorage.getItem('quantities')) || {};
    delete quantities[itemID];
    localStorage.setItem('quantities', JSON.stringify(quantities));
}

// Event listener for "Submit Request" button
document.getElementById('submitBtn').addEventListener('click', function() {
    
    const items = [];
    const quantities = JSON.parse(localStorage.getItem('quantities')) || {};
    if (Object.keys(quantities).length === 0) {
        alert('Please add items before submitting.');
        return; // Stop further execution
    }
    const quantityInputs = document.querySelectorAll('#quantityInputs input[type="number"]');
    let isEmpty = false;

    // Check if any quantity input field is empty
    quantityInputs.forEach(input => {
        if (input.value.trim() === '') {
            isEmpty = true;
            return; // Exit the loop early if any input field is empty
        }
    });

    if (isEmpty) {
        alert('Please fill in all quantity fields before submitting.');
        return; // Stop further execution
    }
    Object.entries(quantities).forEach(([itemID, { itemName, quantity }]) => {
        items.push({
            itemID: itemID,
            itemName: itemName,
            quantity: quantity
        });
    });

    const formData = {
        items: items
    };

    // Convert formData to JSON
    const jsonData = JSON.stringify(formData);

    // Send jsonData to the controller via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo URLROOT ?>/chefs/sendinventoryrequest', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request successful, do something with the response if needed
                //console.log(xhr.responseText);
                alert('Inventory request submitted successfully!');
            } else {
                // Error handling
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.send(jsonData);
    localStorage.removeItem('quantities');
});

// Search items function
function searchItems(value) {
    const options = document.querySelectorAll('#itemSelect option');
    options.forEach(option => {
        const item = option.textContent.toLowerCase();
        const searchTerm = value.toLowerCase();
        if (item.includes(searchTerm)) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}
</script>


</body>
</html>