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

//! payment gateway

// Proceed to payment
$("#proceed-to-pay").click(function () {
  // var data = {
  //   customerID: $("#customerID").val(),
  //   tableID: 1,
  //   packageID: $("#packageID:checked").val(),
  //   date: $("#selectedDate").val(),
  //   reservationStartTime: $("#selectedTime").val(),
  //   numOfPeople: $("#numOfPeople").val(),
  //   amount: $("#totalAmount").val(),
  // };

  // $.ajax({
  //   url: 'addReservation',
  //   type: 'POST',
  //   contentType: 'application/x-www-form-urlencoded',
  //   data: data,
  //   success: function(response) {
  //     console.log(response);
  //     //reload page

  //     location.reload();
  //   }
  // });

  paymentGateway();
});

function paymentGateway() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      alert(this.responseText);
      // Payment gateway
      var obj = JSON.parse(this.responseText);

      // Payment completed. It can be a successful failure.
      payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
      };

      // Payment window closed
      payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
      };

      // Error occurred
      payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
      };

      // Put the payment variables here
      var payment = {
        sandbox: true,
        merchant_id: obj.merchant_id, // Replace your Merchant ID
        return_url: "http://localhost/DineEase-DEE/customers/reservation", // Important
        cancel_url: "http://localhost/DineEase-DEE/customers/reservation", // Important
        notify_url: "http://sample.com/notify",
        order_id: obj.order_id,
        items: obj.items,
        amount: obj.amount,
        currency: obj.currency,
        hash: obj.hash,
        first_name: obj.first_name,
        last_name: obj.last_name,
        email: obj.email,
        phone: obj.phone,
        address:  obj.address,
        city: obj.city,
        country:  obj.country,
      };
      payhere.startPayment(payment);
    }
  };  
  xhttp.open("GET", "payhereprocesss", true);
  xhttp.send();
}
