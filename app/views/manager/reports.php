<?php include('commonnavreport.php'); ?>
<style>
    /* Style for the results table */
    #results {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    #results th, #results td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    #results th {
        background-color: #f2f2f2;
    }
    #results tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    #generatePDFButton{
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        cursor: pointer;
        border-radius: 10px;
        
    
    }
</style>

<div class="container">
    <h2>Sales Report</h2>
    <?php
    $firstdate = substr($data['minmaxpaymentdate']->first_payment, 0, 10);
    $lastdate = substr($data['minmaxpaymentdate']->last_payment, 0, 10);
    $mindate = date('Y-m-d', strtotime($firstdate));
    $maxdate = date('Y-m-d', strtotime($lastdate));
    ?>
    <form id="salesreportform">
        <span id="diffDateErr" style="color: red;"></span>
        <label for="startDate">Start Date:</label>
        <input type="date" name="start_date" id="startDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
        <span id="startDateErr" style="color: red;"></span> <!-- Display start_date_err here -->

        <label for="endDate">End Date:</label>
        <input type="date" name="end_date" id="endDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
        <span id="endDateErr" style="color: red;"></span> <!-- Display end_date_err here -->
    </form>
    <div id="salesData"></div>
    <!-- Display sales report data here -->

    <h2>Menu Report</h2>
    <?php
    $firstdateres = substr($data['minmaxreservationdate']->first_reservation, 0, 10);
    $lastdateres = substr($data['minmaxreservationdate']->last_reservation, 0, 10);
    $mindateres = date('Y-m-d', strtotime($firstdateres));
    $maxdateres = date('Y-m-d', strtotime($lastdateres));
    ?>
    <form id="salesreportform">
        <span id="menudiffDateErr" style="color: red;"></span>
        <label for="startDate">Start Date:</label>
        <input type="date" name="menu_start_date" id="menustartDate" min="<?php echo $mindateres; ?>" max="<?php echo $maxdateres; ?>">
        <span id="menustartDateErr" style="color: red;"></span> <!-- Display start_date_err here -->

        <label for="menuendDate">End Date:</label>
        <input type="date" name="menu_end_date" id="menuendDate" min="<?php echo $mindateres; ?>" max="<?php echo $maxdateres; ?>">
        <span id="menuendDateErr" style="color: red;"></span> <!-- Display end_date_err here -->
        <button type="button" id="generatePDFButton">Generate Report</button>
    </form>

    <!-- Display sales report data here -->
    <div id="MenuData">
        <h2>Top Selling Menus</h2>
        <ul id="topSellingMenus"></ul>

        <h2>Top Selling Categories</h2>
        <ul id="topSellingCategories"></ul>

        <h2>Most Reservations Date</h2>
        <div id="mostReservationsDate"></div>

        <h2>Most Ordered Sizes</h2>
        <ul id="mostOrderedSizes"></ul>

        <h2>Total quantity sold and total amount for each menu item </h2>
        <table id="results">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Item</th>
                    <th>Date</th>
                    <th>Total Quantity Sold</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById('MenuData').style.display = 'none';
    
    
    function fetchMenuReport(startDate, endDate,callback) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse JSON response

                    var response = JSON.parse(xhr.responseText);
                    
                    var menuReport = response;

                   

                    // Check if there are errors in the response
                    if (response.errors) {
                        // Display validation errors
                        document.getElementById('MenuData').style.display = 'none';

                        displayMenuValidationErrors(response.errors);
                        
                    } else {
                        // No errors, clear any existing error messages
                        document.getElementById('MenuData').style.display = 'block';
                        document.getElementById('menustartDateErr').innerHTML = '';
                        document.getElementById('menuendDateErr').innerHTML = '';
                        document.getElementById('menudiffDateErr').innerHTML = '';
                        updateTopSellingMenus(menuReport.topSellingMenus);
                        updateTopSellingCategories(menuReport.topSellingCategories);
                        updateMostReservationsDate(menuReport.mostReservationsDate);
                        updateMostOrderedSizes(menuReport.mostOrderedSizes);
                        updateResults(menuReport.results);
                        
                        callback(menuReport);
                    }
                } else {
                    console.error('Error fetching sales report:', xhr.status);
                    // Optionally, provide feedback to the user about the error
                    alert('Error fetching meu report. Please try again.');
                }
            }
        };
        xhr.open('POST', '<?php echo URLROOT ?>/managers/fetchMenuReport', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate));
    }
    function generatePDF(menuReport, startDate, endDate) {
        console.log(menuReport);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // PDF generated successfully
                // Optionally, you can handle the response or provide feedback to the user
                alert('PDF generated successfully.');
            } else {
                console.error('Error generating PDF:', xhr.status);
                // Optionally, provide feedback to the user about the error
                alert('Error generating PDF. Please try again.');
            }
        }
    };
    xhr.open('POST', '<?php echo URLROOT ?>/managers/generatereportpdf?startDate=' + encodeURIComponent(startDate) + '&endDate=' + encodeURIComponent(endDate), true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    //console.log(JSON.stringify(menuReport));
    xhr.send(JSON.stringify(menuReport));
}


    function displayMenuValidationErrors(errors) {
        if (errors.start_date_err) {
            document.getElementById('menustartDateErr').innerHTML = errors.start_date_err;
            //document.getElementById('MenuData').innerHTML = '';
            
        } else {
            document.getElementById('menustartDateErr').innerHTML = '';
        }

        if (errors.end_date_err) {
            document.getElementById('menuendDateErr').innerHTML = errors.end_date_err;
            //document.getElementById('MenuData').innerHTML = '';
        } else {
            document.getElementById('menuendDateErr').innerHTML = '';
        }
        if (errors.diff_date_err) {
            document.getElementById('menudiffDateErr').innerHTML = errors.diff_date_err;
            //document.getElementById('MenuData').innerHTML = '';
        } else {
            document.getElementById('menudiffDateErr').innerHTML = '';
        }
    }

    function updateTopSellingMenus(topSellingMenus) {
        var topSellingMenusList = document.getElementById('topSellingMenus');
        topSellingMenusList.innerHTML = '';
        topSellingMenus.forEach(function(menu) {
            var menuItem = document.createElement('li');
            menuItem.textContent = menu.itemName + ' (ID: ' + menu.itemID + ') - Total Quantity Sold: ' + menu.total_quantity_sold;
            topSellingMenusList.appendChild(menuItem);
            
        });
    }

    // Function to update HTML with top selling categories data
    function updateTopSellingCategories(topSellingCategories) {
        var topSellingCategoriesList = document.getElementById('topSellingCategories');
        topSellingCategoriesList.innerHTML = '';
        topSellingCategories.forEach(function(category) {
            var categoryItem = document.createElement('li');
            categoryItem.textContent = category.category_name + ' (ID: ' + category.category_ID + ') - Total Quantity Sold: ' + category.total_quantity_sold;
            topSellingCategoriesList.appendChild(categoryItem);
        });
    }

    // Function to update HTML with most reservations date data
    function updateMostReservationsDate(mostReservationsDate) {
        var mostReservationsDateElement = document.getElementById('mostReservationsDate');
        mostReservationsDateElement.textContent = 'Date: ' + mostReservationsDate.date + ' - Reservation Count: ' + mostReservationsDate.reservation_count;
    }

    // Function to update HTML with most ordered sizes data
    function updateMostOrderedSizes(mostOrderedSizes) {
        var mostOrderedSizesList = document.getElementById('mostOrderedSizes');
        mostOrderedSizesList.innerHTML = '';
        mostOrderedSizes.forEach(function(size) {
            var sizeItem = document.createElement('li');
            sizeItem.textContent = size.itemName + ' - Size: ' + size.size + ' - Total Quantity Sold: ' + size.total_quantity_sold;
            mostOrderedSizesList.appendChild(sizeItem);
        });
    }

    // Function to update HTML with results data
    function updateResults(results) {
        var resultsTable = document.getElementById('results');
        //var resultsHeading = document.querySelector('#MenuData h2');
        //resultsTable.innerHTML = '';
       

// Clear existing table content
//resultsTable.innerHTML = '';
        results.forEach(function(result) {
            var row = resultsTable.insertRow();
            row.insertCell().textContent = result.category_name + ' (ID: ' + result.category_ID + ')';
            row.insertCell().textContent = result.itemName + ' (ID: ' + result.itemID + ')';
            row.insertCell().textContent = result.date;
            row.insertCell().textContent = result.total_quantity_sold;
            row.insertCell().textContent = result.total_amount;
        });
    
    
    }

    document.getElementById('menustartDate').addEventListener('change', function() {
        var startDate = this.value;
        var endDate = document.getElementById('menuendDate').value;
        fetchMenuReport(startDate, endDate);
    });

    document.getElementById('menuendDate').addEventListener('change', function() {
        var startDate = document.getElementById('menustartDate').value;
        var endDate = this.value;
        fetchMenuReport(startDate, endDate);
    });
    document.getElementById('generatePDFButton').addEventListener('click', function() {
    var startDate = document.getElementById('menustartDate').value;
    var endDate = document.getElementById('menuendDate').value;
    fetchMenuReport(startDate, endDate, function(menuReportdata) {
        generatePDF(menuReportdata, startDate, endDate);
    });
});

</script>
<script>
    // Function to fetch sales report data
    function fetchSalesReport(startDate, endDate) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse JSON response
                    var response = JSON.parse(xhr.responseText);

                    // Check if there are errors in the response
                    if (response.errors) {
                        // Display validation errors
                        displayValidationErrors(response.errors);
                        document.getElementById('salesData').style.display = 'none';
                    } else {
                        // No errors, clear any existing error messages
                        document.getElementById('salesData').style.display = 'block';
                        document.getElementById('startDateErr').innerHTML = '';
                        document.getElementById('endDateErr').innerHTML = '';
                        document.getElementById('diffDateErr').innerHTML = '';

                        // Display sales report data
                        document.getElementById('salesData').innerHTML = 'Total sales amount(LKR): ' + response['SUM(amount)'];
                    }
                } else {
                    console.error('Error fetching sales report:', xhr.status);
                    // Optionally, provide feedback to the user about the error
                    alert('Error fetching sales report. Please try again.');
                }
            }
        };
        xhr.open('POST', '<?php echo URLROOT ?>/managers/fetchSalesReport', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate));
    }

    function displayValidationErrors(errors) {
        if (errors.start_date_err) {
            document.getElementById('startDateErr').innerHTML = errors.start_date_err;
        } else {
            document.getElementById('startDateErr').innerHTML = '';
        }

        if (errors.end_date_err) {
            document.getElementById('endDateErr').innerHTML = errors.end_date_err;
        } else {
            document.getElementById('endDateErr').innerHTML = '';
        }
        if (errors.diff_date_err) {
            document.getElementById('diffDateErr').innerHTML = errors.diff_date_err;
        } else {
            document.getElementById('diffDateErr').innerHTML = '';
        }
    }
    document.getElementById('startDate').addEventListener('change', function() {
        var startDate = this.value;
        var endDate = document.getElementById('endDate').value;
        fetchSalesReport(startDate, endDate);
    });
    document.getElementById('endDate').addEventListener('change', function() {
        var endDate = this.value;
        var startDate = document.getElementById('startDate').value;
        fetchSalesReport(startDate, endDate);
    });

   
</script>