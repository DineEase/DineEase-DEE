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
        <label for="startDate">Start Date:</label>
        <input type="date" name="start_date" id="startDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
        <span id="startDateErr" style="color: red;"></span> <!-- Display start_date_err here -->
        
        <label for="endDate">End Date:</label>
        <input type="date" name="end_date" id="endDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
        <span id="endDateErr" style="color: red;"></span> <!-- Display end_date_err here -->
    </form>
    
    <div id="salesData"></div> <!-- Display sales report data here -->
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

    // Function to display validation errors
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
    }

    // Listen for changes on the date inputs
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
</script>
