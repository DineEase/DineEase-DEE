// Get the elements by their ID
var popupLink = document.getElementById("view-food-menu-in-cart");
var popupWindow = document.getElementById("menu-div-purchase");
var closeButton = document.getElementById("close-menu-div-purchase");

// !show hide menus
// Show the pop-up window when the link is clicked
popupLink.addEventListener("click", function (event) {
  event.preventDefault();
  popupWindow.style.display = "block";
});

// Hide the pop-up window when the close button is clicked
closeButton.addEventListener("click", function () {
  popupWindow.style.display = "none";
});

//!Quantity calculation
//Reduce quantity by 1 if clicked
$(document).on("click", ".product-quantity-subtract", function (e) {
  var value = $("#product-quantity-input").val();
  //console.log(value);
  var newValue = parseInt(value) - 1;
  if (newValue < 0) newValue = 0;
  $("#product-quantity-input").val(newValue);
  // CalcPrice(newValue);
});

// Import jQuery library
$(document).on("click", ".product-quantity-add", function (e) {
  var value = $(this).attr("data-slot-label");
  var quantity = $("#" + value).val();
  var newValue = parseInt(quantity) + 1;
  if (newValue > 10) newValue = 10;
  $("#" + value).val(newValue);
});

$(document).on("click", ".product-quantity-subtract", function () {
  var value = $(this).attr("data-slot-label");
  var quantity = $("#" + value).val();
  var newValue = parseInt(quantity) - 1;
  if (newValue < 1) newValue = 1;
  $("#" + value).val(newValue);
});

// //! payment gateway

// Proceed to payment
$("#proceed-to-pay").click(function () {
  var data = {
    customerID: $("#customerID").val(),
    tableID: 1,
    packageID: $("#packageID:checked").val(),
    date: $("#selectedDate").val(),
    reservationStartTime: $("#selectedTime").val(),
    numOfPeople: $("#numOfPeople").val(),
    amount: $("#totalAmount").val(),
  };

  $.ajax({ 
    url: 'addReservation', 
    type: 'POST', 
    contentType: 'application/x-www-form-urlencoded', 
    data: data, 
    success: function(response) { 
      console.log(response);
      //reload page
      
      location.reload();
    } 
  }); 
});

// function paymentGateway(){
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       console.log(this.responseText);
//     }
//   }
//   xhttp.open("GET", "payhereprocesss", true);
//   xhttp.send();
// }
