function changeSuiteFilter(element) { 
    var packageId = $(element).data('package-id');  
    $("#suiteFilter").val(packageId); 
    $("#suiteAndDateFilterForm").submit();
}
//TODO #63 Active status of the suite buttons are not working properly.
function changeDate(direction) {
    var datePicker = document.getElementById('date-picker');
    var currentDate = new Date(datePicker.value);
    currentDate.setDate(currentDate.getDate() + direction);  
    datePicker.value = currentDate.toISOString().split('T')[0]; 
    $("#suiteAndDateFilterForm").submit();
}

$("#date-picker").change(function() {
    $("#suiteAndDateFilterForm").submit();
});