
<?php include('commonnavreport.php'); ?>
    <div class="container">
    <?php
    if (isset($data['salesreport'])) {
    echo "Total sales amount: " . $data['salesreport']->{'SUM(amount)'};
}
?>
    <h2>Sales Report</h2>
    <?php
    $firstdate = substr($data['minmaxpaymentdate']->first_payment, 0, 10);
    $lastdate = substr($data['minmaxpaymentdate']->last_payment, 0, 10);
    $mindate = date('Y-m-d', strtotime($firstdate));
    $maxdate = date('Y-m-d', strtotime($lastdate));
    ?>

    <label for="startDate">Start Date:</label>
    
    <input type="date" name="start_date" id="startDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
    <label for="endDate">End Date:</label>
    <input type="date" name="end_date" id="endDate" min="<?php echo $mindate; ?>" max="<?php echo $maxdate; ?>">
    <div id="salesData"></div>
    
</div>

<script>
    // JavaScript code to send AJAX request for fetching sales report

    // Listen for changes on the date inputs
    document.getElementById('startDate').addEventListener('change', function() {
        // Retrieve the start date value
        var startDate = this.value;
        // Retrieve the current end date value
        var endDate = document.getElementById('endDate').value;
        // Call the function to fetch sales report with updated dates
        fetchSalesReport(startDate, endDate);
    });

    document.getElementById('endDate').addEventListener('change', function() {
        // Retrieve the current start date value
        var startDate = document.getElementById('startDate').value;
        // Retrieve the end date value
        var endDate = this.value;
        // Call the function to fetch sales report with updated dates
        fetchSalesReport(startDate, endDate);
    });

    // Function to fetch sales report data
    function fetchSalesReport(startDate, endDate) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Update the view with the fetched sales report
                    document.getElementById('salesData').innerHTML = xhr.responseText;
                    //location.reload();
                } else {
                    console.error('Error fetching sales report:', xhr.status);
                    // Optionally, provide feedback to the user about the error
                    document.getElementById('salesData').innerHTML = 'Error fetching sales report. Please try again.';
                }
            }
        };
        xhr.open('POST', '<?php echo URLROOT ?>/managers/reports', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('start_date=' + encodeURIComponent(startDate) + '&end_date=' + encodeURIComponent(endDate));
    }
    
</script>

