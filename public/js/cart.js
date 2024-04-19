// Get the elements by their ID
var popupLink = document.getElementById("view-food-menu-in-cart");
var popupWindow = document.getElementById("menu-div-purchase");
var closeButton = document.getElementById("close-menu-div-purchase");
var addedReservationID;
var grandTotal = 0;
var topCartTotal = 0;

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

$(document).on("click", ".product-quantity-add", function (e) {
  var value = $(this).attr("data-slot-label");
  var quantity = $("#" + value).val();
  var newValue = parseInt(quantity) + 1;
  if (newValue > 10) newValue = 10;
  $("#" + value).val(newValue);
});

//! What is thiss
$(document).on("click", ".product-quantity-subtract", function () {
  var value = $(this).attr("data-slot-label");
  var quantity = $("#" + value).val();
  var newValue = parseInt(quantity) - 1;
  if (newValue < 1) newValue = 1;
  $("#" + value).val(newValue);
});

// //! Add item to cart function
// // Add item to cart

function addToCart(itemID) {
  var quantity = parseInt($("#quantitySelector" + itemID).val());
  var sizeIndex = $("#sizeSelector" + itemID).val();
  var prices = JSON.parse(
    $(".menu-item-card[data-item-id='" + itemID + "']").attr("data-prices")
  );
  var sizes = ["Large", "Regular", "Small"];
  var itemName = $(".menu-item-card[data-item-id='" + itemID + "'] h3").text();

  if (prices.length < 3) {
    sizes = ["Regular", "Small"];
  }

  if (prices.length < 2) {
    sizes = ["Regular"];
  }

  if (!quantity || isNaN(quantity) || quantity < 1) {
    alert("Please enter a valid quantity.");
    return;
  }

  var itemImage = $(".menu-item-card[data-item-id='" + itemID + "'] img").attr(
    "src"
  );

  var newItem = {
    itemID: itemID,
    itemName: itemName,
    quantity: quantity,
    size: sizes[sizeIndex],
    price: prices[sizeIndex],
    itemImage: itemImage,
  };

  var cartArray = JSON.parse(sessionStorage.getItem("food-cart") || "[]");
  cartArray.push(newItem);

  sessionStorage.setItem("food-cart", JSON.stringify(cartArray));
  showCart();
  alert(
    "Item added to cart: " +
      newItem.itemName +
      " x " +
      newItem.quantity +
      " " +
      newItem.size +
      " Price: " +
      newItem.price
  );

  var itemPrice = newItem.price * newItem.quantity;
  grandTotal += itemPrice;
  $("#itemCount").text(cartArray.length);
  $("#cartTotalAmount").text("LKR" + grandTotal + ".00");
  showCart();
  updateTotalAmount();
}

//TODO #43 Slot reservation amount must be deducted from the total amount

function subtractQuantityFromCart(element) {
  alert("Subtracting");
  var value = $(element).data("slot-label");
  alert(value);
  var quantity = $("#cart-item-quantity-input" + value).val();
  alert(quantity);
  var newValue = parseInt(quantity) - 1;
  if (newValue < 1) newValue = 1;
  $("#cart-item-quantity-input" + value).val(newValue);

  updateSessionStorage(value, newValue);
}
function addQuantityToCart(element) {
  alert("Subtracting");
  var value = $(element).data("slot-label");
  alert(value);
  var quantity = $("#cart-item-quantity-input" + value).val();
  alert(quantity);
  var newValue = parseInt(quantity) + 1;
  if (newValue > 10) newValue = 10;
  $("#cart-item-quantity-input" + value).val(newValue);

  updateSessionStorage(value, newValue);
}

function updateSessionStorage(itemID, newQuantity) {
  // Retrieve the current cart from session storage
  var cart = JSON.parse(sessionStorage.getItem("food-cart") || "[]");

  // Find the item and update its quantity
  var found = cart.find((item) => item.itemID == itemID);
  if (found) {
    found.quantity = newQuantity; // Update the quantity
  }

  // Save the updated cart back to session storage
  sessionStorage.setItem("food-cart", JSON.stringify(cart));
  showCart();
  updateTotalAmount();
}

function removeFromCart(index) {
  var cartArray = JSON.parse(sessionStorage.getItem("food-cart") || "[]");

  var itemPrice = cartArray[index].price;

  var itemQuantity = cartArray[index].quantity;

  var totalItemPrice = itemPrice * itemQuantity;

  grandTotal -= totalItemPrice;

  cartArray.splice(index, 1);
  sessionStorage.setItem("food-cart", JSON.stringify(cartArray));
  $("#itemCount").text(cartArray.length);
  $("#cartTotalAmount").text("LKR" + grandTotal + ".00");
  showCart();
  updateTotalAmount();
}

// Show the cart
$(document).ready(function () {
  showCart();
});

function showCart() {
  var cartRowHTML = "";
  var loopTotal = 0;
  var cartArray = JSON.parse(sessionStorage.getItem("food-cart") || "[]");

  cartArray.forEach(function (item, index) {
    var subTotal = parseFloat(item.price) * parseInt(item.quantity);
    var id = item.itemID;
    cartRowHTML +=
      "<tr class='cart-table-row'>" +
      "<td>" +
      "<img class='cart-item-image-added' src='" +
      item.itemImage +
      "' alt='item image' />" +
      "</td>" +
      "<td>" +
      item.itemName +
      "</td>" +
      "<td>" +
      item.size +
      "</td>" +
      "<td>LKR" +
      item.price +
      "</td>" +
      "<td><div class='cart-item-quantity-subtract' onclick='subtractQuantityFromCart(this);' data-slot-label='" +
      id +
      "'  ><i class='fa fa-chevron-left'</i> </div>" +
      "</td>" +
      "<td>" +
      "<input type='text' class='product-quantity-input' id='cart-item-quantity-input" +
      id +
      "' value=" +
      item.quantity +
      ">" +
      "</td>" +
      "<td>" +
      "<div class='cart-item-quantity-add' onclick='addQuantityToCart(this);'  data-slot-label='" +
      id +
      "'><i class='fa fa-chevron-right'></i></div>" +
      "</td>" +
      "<td>LKR." +
      subTotal.toFixed(2) +
      "</td>" +
      "<td><button type='button' onclick='removeFromCart(" +
      index +
      ")'><i class='fa-solid fa-xmark'></i></button></td>" +
      "</tr>";

    loopTotal += subTotal;
  });

  $("#cartTableBody").html(cartRowHTML);

  if (loopTotal != grandTotal) {
    grandTotal = loopTotal;
  }

  $("#itemCount").text(cartArray.length);
  $("#cartTotalAmount").text("LKR" + grandTotal + ".00");
  updateTotalAmount();
}

function emptyCart() {
  sessionStorage.removeItem("food-cart");
  grandTotal = 0;
  $("#itemCount").text(0);
  $("#cartTotalAmount").text("LKR" + grandTotal + ".00");
  showCart();
}

//! payment gateway

// Proceed to payment
$("#proceed-to-pay").click(function () {
  var data = {
    customerID: $("#customerID").val(),
    //TODO Implement table selection logic
    tableID: 1,
    packageID: $("#packageID:checked").val(),
    date: $("#selectedDate").val(),
    reservationStartTime: $("#selectedTime").val(),
    numOfPeople: $("#numOfPeople").val(),
    amount: $("#totalAmount").val(),
  };

  $.ajax({
    url: "addReservation",
    type: "POST",
    contentType: "application/x-www-form-urlencoded",
    data: data,
    success: function (response) {
      addedReservationID = response;
      paymentGateway(response);
    },
  });
});

function markPaid() {
  $.ajax({
    url: "markPaid",
    type: "POST",
    data: { reservationID: addedReservationID },
    dataType: "json",
    success: function (response) {
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });
}

function createOrder() {
  var cartArray = JSON.parse(sessionStorage.getItem("food-cart") || "[]");
  var orderItems = [];
  cartArray.forEach(function (item) {
    orderItems.push({
      itemID: item.itemID,
      itemName: item.itemName,
      quantity: item.quantity,
      size: item.size,
    });
  });

  var orderData = {
    reservationID: addedReservationID,
    orderItems: orderItems,
  };

  $.ajax({
    url: "createOrder",
    type: "POST",
    data: orderData,
    success: function (response) {
      console.log(response);
    },
  });
}

function paymentGateway(ReservationID) {
  var reservationID = ReservationID;
  let amount = document.getElementById("totalAmount").value;

  var formData = new FormData();
  formData.append("amount", amount);

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "payhereprocesss", true);
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var obj = JSON.parse(this.responseText);

      // Payment completed. It can be a successful failure.
      payhere.onCompleted = function onCompleted(orderId) {
        var reservationData = {
          reservationID: reservationID,
          invoiceID: reservationID,
          amount: amount,
          paymentMethod: "PayHere",
        };
        $.ajax({
          url: "makePayment",
          type: "POST",
          data: reservationData,
          contentType: "application/x-www-form-urlencoded",
          success: function (response) {},
        });
        markPaid();
        createOrder();
        emptyCart();
        location.reload();
      };

      // Payment window closed
      payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
        //TODO: Show an error page
      };

      // Error occurred
      payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
        //TODO: Show an error page
      };

      // Put the payment variables here
      var payment = {
        sandbox: true,
        merchant_id: obj.merchant_id, // Replace your Merchant ID
        return_url: "http://localhost/DineEase-DEE/customers/reservation",
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
        address: obj.address,
        city: obj.city,
        country: obj.country,
      };
      payhere.startPayment(payment);
    }
  };
  xhttp.send(formData);
}

//! ajax get request function
function getAjaxRequest(url, data) {
  return $.ajax({
    url: url,
    type: "GET",
    data: data,
    success: function (response) {
      return response;
    },
  });
}

//! ajax post request function
function postAjaxRequest(url, data) {
  return $.ajax({
    url: url,
    type: "POST",
    data: data,
    success: function (response) {
      return response;
    },
  });
}
