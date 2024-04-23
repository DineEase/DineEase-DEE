<?php include('commonnavreport.php'); ?>
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
    </form>
   
     <!-- Display sales report data here -->
    <div id="MenuData"></div>
</div>
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
                    } else {
                        // No errors, clear any existing error messages
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
        var startDate = document.getElementById('startDate').value;
        var endDate = this.value;
        fetchSalesReport(startDate, endDate);
    });
    function fetchMenuReport(startDate, endDate) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse JSON response
                    var response = JSON.parse(xhr.responseText);
                    
                    // Check if there are errors in the response
                    if (response.errors) {
                        // Display validation errors
                        displayMenuValidationErrors(response.errors);
                    } else {
                        // No errors, clear any existing error messages
                        document.getElementById('menustartDateErr').innerHTML = '';
                        document.getElementById('menuendDateErr').innerHTML = '';
                        document.getElementById('menudiffDateErr').innerHTML = '';
                        
                        // Display sales report data
                        document.getElementById('MenuData').innerHTML = 'Menu Report: ' + response;
                    }
                } else {
                    console.error('Error fetching sales report:', xhr.status);
                    // Optionally, provide feedback to the user about the error
                    alert('Error fetching sales report. Please try again.');
                }
            }
        };
        xhr.open('POST', '<?php echo URLROOT ?>/managers/fetchMenuReport', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate));
    }
    

    // Function to display validation errors
   
    function displayMenuValidationErrors(errors) {
        if (errors.start_date_err) {
            document.getElementById('menustartDateErr').innerHTML = errors.start_date_err;
        } else {
            document.getElementById('menustartDateErr').innerHTML = '';
        }
        
        if (errors.end_date_err) {
            document.getElementById('menuendDateErr').innerHTML = errors.end_date_err;
        } else {
            document.getElementById('menuendDateErr').innerHTML = '';
        }
        if (errors.diff_date_err) {
            document.getElementById('menudiffDateErr').innerHTML = errors.diff_date_err;
        } else {
            document.getElementById('menudiffDateErr').innerHTML = '';
        }
    }

    // Listen for changes on the date inputs
    
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
</script>
