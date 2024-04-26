function changeSuiteFilter(element) {
  var packageId = $(element).data("package-id");
  $("#suiteFilter").val(packageId);
  $("#suiteAndDateFilterForm").submit();
}
//TODO #63 Active status of the suite buttons are not working properly.
function changeDate(direction) {
  var datePicker = document.getElementById("date-picker");
  var currentDate = new Date(datePicker.value);
  currentDate.setDate(currentDate.getDate() + direction);
  datePicker.value = currentDate.toISOString().split("T")[0];
  $("#suiteAndDateFilterForm").submit();
}

$("#date-picker").change(function () {
  $("#suiteAndDateFilterForm").submit();
});
var suiteMaxCapacity = [20, 10, 10];

var reservations = [];

$(document).ready(function () {
  $(".quantity-input-menu-items").attr({
    min: 1,
    max: 10,
  });
});

$(document).ready(function () {
  getAvailability($("#reservation_suite").val());

  function getMenus() {
    $.ajax({
      url: "getMenus",
      type: "GET",
      dataType: "json",
      success: function (data) {
        menus = data;
        console.log(menus);

        displayItems(menus);
        displayItemsEO(menus);

        $(document).on("input", "#menuSearchRADD", function () {
          console.log("input");
          $("#itemsBySearch").empty();
          console.log("input");
          var searchQuery = $(this).val().toLowerCase();
          filterItems(menus, searchQuery);
        });

        //*works fine

        $(document).on("input", "#menuSearchEO", function () {
          console.log("input");
          $("#itemsBySearchEO").empty();
          console.log("inputss");
          var searchQuery = $(this).val().toLowerCase();
          filterItemsEO(menus, searchQuery);
        });
      },
      error: function (err) {
        console.log("Error fetching menu items:", err);
      },
    });
  }

  function filterItems(array, searchQuery) {
    let filteredItems = array;
    if (searchQuery) {
      filteredItems = filteredItems.filter((item) =>
        item.itemName.toLowerCase().includes(searchQuery)
      );
    }
    displayItems(filteredItems);
  }
  //*works fine
  function filterItemsEO(array, searchQuery) {
    let filteredItems = array;
    if (searchQuery) {
      filteredItems = filteredItems.filter((item) =>
        item.itemName.toLowerCase().includes(searchQuery)
      );
    }
    displayItemsEO(filteredItems);
  }

  function displayItems(items) {
    const dropdown = $("#itemsBySearch");
    dropdown.empty();

    if (items.length > 0) {
      items.forEach((item) => {
        let sizesArray = item.Sizes.split(", ");
        let pricesArray = item.Prices.split(", ");

        if (sizesArray.length > 1) {
          for (let i = 0; i < sizesArray.length; i++) {
            let sizePrice = [];

            sizePrice = sizesArray[i] + " - " + pricesArray[i];

            dropdown.append(
              $("<div>", {
                class: "menu-item",
                text: item.itemName + " - " + sizePrice,
              })
                .append(
                  $("<input>", {
                    type: "number",
                    class: "quantity-input-menu-items",
                    id: "quantity-input" + item.itemID,
                    placeholder: "Quantity",
                    value: 1,
                    min: 1,
                    required: true,
                  })
                )
                .append(
                  $("<button>", {
                    class: "add-to-cart-btn",
                    text: "Add to Cart",
                    id: "add-to-cart-btn" + item.itemID,
                    "data-item-id": item.itemID,
                    "data-item-price": pricesArray[i],
                    "data-item-size": sizesArray[i],
                    "data-item-name": item.itemName,
                    onClick: "addToCart(this)",
                  })
                )
            );
          }
        } else {
          dropdown.append(
            $("<div>", {
              class: "menu-item",
              text: item.itemName + " - " + sizesArray + " - " + pricesArray,
            })
              .append(
                $("<input>", {
                  type: "number",
                  class: "quantity-input-menu-items",
                  id: "quantity-input" + item.itemID,
                  value: 1,
                  min: 1,
                  placeholder: "Quantity",
                  required: true,
                })
              )
              .append(
                $("<button>", {
                  class: "add-to-cart-btn",
                  text: "Add to Cart",
                  id: "add-to-cart-btn" + item.itemID,
                  "data-item-id": item.itemID,
                  "data-item-price": pricesArray,
                  "data-item-size": sizesArray,
                  "data-item-name": item.itemName,
                  onClick: "addToCart(this)",
                })
              )
          );
        }
      });
    }
  }
  //!Could be fine
  function displayItemsEO(items) {
    const dropdown = $("#itemsBySearchEO");
    dropdown.empty();

    if (items.length > 0) {
      items.forEach((item) => {
        let sizesArray = item.Sizes.split(", ");
        let pricesArray = item.Prices.split(", ");

        if (sizesArray.length > 1) {
          for (let i = 0; i < sizesArray.length; i++) {
            let sizePrice = [];

            sizePrice = sizesArray[i] + " - " + pricesArray[i];

            dropdown.append(
              $("<div>", {
                class: "menu-item",
                text: item.itemName + " - " + sizePrice,
              })
                .append(
                  $("<input>", {
                    type: "number",
                    class: "quantity-input-menu-items",
                    id: "quantity-input" + item.itemID,
                    placeholder: "Quantity",
                    value: 1,
                    min: 1,
                    required: true,
                  })
                )
                .append(
                  $("<button>", {
                    class: "add-to-cart-btn",
                    text: "Add to Order",
                    id: "add-to-cart-btn" + item.itemID,
                    "data-item-id": item.itemID,
                    "data-item-price": pricesArray[i],
                    "data-item-size": sizesArray[i],
                    "data-item-name": item.itemName,
                    onClick: "addToCartEO(this)",
                  })
                )
            );
          }
        } else {
          dropdown.append(
            $("<div>", {
              class: "menu-item",
              text: item.itemName + " - " + sizesArray + " - " + pricesArray,
            })
              .append(
                $("<input>", {
                  type: "number",
                  class: "quantity-input-menu-items",
                  id: "quantity-input" + item.itemID,
                  placeholder: "Quantity",
                  min: 1,
                  value: 1,
                  required: true,
                })
              )
              .append(
                $("<button>", {
                  class: "add-to-cart-btn",
                  text: "Add to Order",
                  id: "add-to-cart-btn" + item.itemID,
                  "data-item-id": item.itemID,
                  "data-item-price": pricesArray,
                  "data-item-size": sizesArray,
                  "data-item-name": item.itemName,
                  onClick: "addToCartEO(this)",
                })
              )
          );
        }
      });
    }
  }
  getMenus();
});

//!changed
function addToCart(element) {
  var itemID = $(element).data("item-id");
  var itemPrice = $(element).data("item-price");
  var itemSize = $(element).data("item-size");
  var itemName = $(element).data("item-name");
  var quantity = $(element).prev().val();

  var item = {
    itemID: itemID,
    itemPrice: itemPrice,
    itemSize: itemSize,
    itemName: itemName,
    quantity: quantity,
  };

  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart.push(item);
  localStorage.setItem("cart", JSON.stringify(cart));

  populateAddedItems();
}

function addToCartEO(element) {
  var itemID = $(element).data("item-id");
  var itemPrice = $(element).data("item-price");
  var itemSize = $(element).data("item-size");
  var itemName = $(element).data("item-name");
  var quantity = $(element).prev().val();

  var item = {
    itemID: itemID,
    itemPrice: itemPrice,
    itemSize: itemSize,
    itemName: itemName,
    quantity: quantity,
  };

  var toAdd = JSON.parse(localStorage.getItem("toAdd")) || [];
  toAdd.push(item);
  localStorage.setItem("toAdd", JSON.stringify(toAdd));

  populateAddNewItems();
}

var totalAmount = 0;

function populateAddedItems() {
  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  var total = 0;
  var html = "";

  cart.forEach((item) => {
    var itemTotal = item.itemPrice * item.quantity;
    total += itemTotal;

    html += `
              <div class="added-item
              ">
                  <div class="added-item
                  -name">${item.itemName}</div>
                  <div class="added-item-size">${item.itemSize}</div>

                  <div class="added-item
                  -quantity">${item.quantity}</div>
                  <div class="added-item
                  -price">${itemTotal}</div>
                  <button class="remove-itemEO-btn" data-item-size="${item.itemSize}" data-item-id="${item.itemID}" data-item-quantity="${item.quantity}" data-item-size="" onClick="removeItem(this);">Remove</button>
              </div>

          `;

    $("#added-items-to-reservation").html(html);
  });
  totalAmount = total;
  $("#total-for-cart").val(totalAmount);
  console.log(totalAmount);
  console.log($("#total-for-cart").val());
}

var toAddTotalAmount = 0;

function populateAddNewItems() {
  var toAdd = JSON.parse(localStorage.getItem("toAdd")) || [];
  var total = 0;
  var html = "";

  toAdd.forEach((item) => {
    var itemTotal = item.itemPrice * item.quantity;
    total += itemTotal;

    html += `
              <div class="added-item
              ">
                  <div class="added-item
                  -name">${item.itemName}</div>
                  <div class="added-item-size">${item.itemSize}</div>

                  <div class="added-item
                  -quantity">${item.quantity}</div>
                  <div class="added-item
                  -price">${itemTotal}</div>
                  <button class="remove-itemEO-btn" data-item-size="${item.itemSize}" data-item-id="${item.itemID}" data-item-quantity="${item.quantity}" data-item-size="" onClick="removeItemEO(this);">Remove</button>
              </div>

          `;

    $("#added-items-to-Order").html(html);
  });
  toAddTotalAmount = total;
  $("#total-for-newly-added").val(toAddTotalAmount);
  console.log(totalAmount);
  console.log($("#amount-editEO").val());
}

//todo
function clearCart() {
  alert("Order clearedss successfully!");
  localStorage.removeItem("cart");
  populateAddedItems();
  $("#added-items-to-reservation").html("");
  totalAmount = 0;
  $("#total-for-cart").val(totalAmount);
}

function clearCartEO() {
  alert("Order cleared successfully!");
  localStorage.removeItem("toAdd");
  populateAddNewItems();
  $("#added-items-to-Order").html("");
  toAddTotalAmount = 0;
  $("#total-for-newly-added").val(toAddTotalAmount);
}

function removeItem(element) {
  var itemID = $(element).data("item-id");
  var itemSize = $(element).data("item-size");
  var itemQuantity = parseInt($(element).data("item-quantity"), 10); // Convert to integer

  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  var foundIndex = cart.findIndex(
    (item) =>
      item.itemID === itemID &&
      item.itemSize === itemSize &&
      parseInt(item.quantity, 10) === itemQuantity // Ensure comparison as integers
  );

  if (foundIndex == 0 && cart.length == 1) {
    clearCart();
  }

  if (foundIndex !== -1) {
    cart.splice(foundIndex, 1);
  } else {
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  populateAddedItems();
}

function removeItemEO(element) {
  var itemID = $(element).data("item-id");
  var itemSize = $(element).data("item-size");
  var itemQuantity = parseInt($(element).data("item-quantity"), 10); // Convert to integer

  var toAdd = JSON.parse(localStorage.getItem("toAdd")) || [];
  var foundIndex = toAdd.findIndex(
    (item) =>
      item.itemID === itemID &&
      item.itemSize === itemSize &&
      parseInt(item.quantity, 10) === itemQuantity // Ensure comparison as integers
  );

  if (foundIndex == 0 && toAdd.length == 1) {
    clearCartEO();
  }

  if (foundIndex !== -1) {
    toAdd.splice(foundIndex, 1);
  } else {
  }

  localStorage.setItem("toAdd", JSON.stringify(toAdd));
  populateAddNewItems();
}

//!DONE

function createOrder() {
  var numberOfGuests = document.getElementById("number_of_guests").value;
  var suitePackage = document.getElementById("reservation_suite").value;
  var total = document.getElementById("total-for-cart").value;

  today = new Date();
  slot = today.getHours();

  var cart = JSON.parse(localStorage.getItem("cart")) || [];
  var order = {
    numberOfGuests: numberOfGuests,
    suitePackage: suitePackage,
    items: cart,
    slot: slot,
    total: total,
  };

  $.ajax({
    url: "createOrder",
    type: "POST",
    data: order,
    success: function (data) {
      console.log(data);
      clearCart();
      totalAmount = 0;
    },
    error: function (err) {
      console.log("Error creating order:", err);
    },
  });
}

function editOngoingOrder(element) {
  toggleDisplay(".viewOngoing", ".editOngoingS");
  clearCartEO();

  var orderID = $(element).data("id-reservationid");
  var order = reservations.find((order) => order.orderID == orderID);
  $("#orderNO-editEO").text(order.orderID);
  $("#customerName-editEO").text(order.customer.name);
  $("#tableID-editEO").text(order.tableID);
  $("#status-editEO").text(order.preparationStatus);
  populateAddNewItems();
}

function closeEditOngoingOrder() {
  toggleDisplay(".viewOngoing", ".editOngoingS");
  clearCartEO();
}

window.addEventListener("storage", function (e) {
  if (e.key === "cart") {
    populateAddedItems();
  }
});

window.addEventListener("storage", function (e) {
  if (e.key === "toAdd") {
    populateAddNewItems();
  }
});

function addNewItemsToOrder() {
  var orderID = $("#orderNO-editEO").text();
  var total = document.getElementById("total-for-newly-added").value;
}

function setSuite(suiteValue) {
  $("#reservation_suite").val(suiteValue);

  getAvailability(suiteValue);
}

//&DONE

function getAvailability(suiteValue) {
  $.ajax({
    url: "getAvailableSlotsNow",
    type: "GET",
    data: { suiteID: suiteValue },
    success: function (data) {
      var reserved = data;
      reserved = parseInt(reserved);

      var available = suiteMaxCapacity[suiteValue - 1] - reserved;

      $("#number_of_guests").attr({
        max: available,
        min: 1,
      });

      $("#availiable-seats").text(available);
    },
    error: function (err) {
      console.log("Error fetching suite details:", err);
    },
  });
}

// //TODO FIX THESE FUNCTIONS
// function removeItem(element) {
//   var itemName = $(element).prev().prev().prev().text();
//   var cart = JSON.parse(localStorage.getItem("cart")) || [];
//   var updatedCart = cart.filter((item) => item.itemName != itemName);
//   localStorage.setItem("cart", JSON.stringify(updatedCart));
//   populateAddedItems();
// }

// function removeItemEO(element) {
//   var itemName = $(element).prev().prev().prev().text();
//   var toAdd = JSON.parse(localStorage.getItem("toAdd")) || [];
//   var updatedCart = toAdd.filter((item) => item.itemName != itemName);
//   localStorage.setItem("toAdd", JSON.stringify(updatedCart));
//   populateAddedItems();
// }

//!ORDER EDITING FUNCTIONS

$(document).ready(function () {
  $(document).on("click", ".markCompleted", function () {
    var orderID = $(this).data("id-reservationid");
    markCompleted(orderID);
  });

  function markCompleted(orderID) {
    $.ajax({
      url: "markCompleted",
      type: "POST",
      data: { orderID: orderID },
      success: function (data) {
        console.log(data);
        fetchReservations();
      },
      error: function (err) {
        console.log("Error marking completed:", err);
      },
    });
  }

  function fetchReservations() {
    $.ajax({
      url: "getOrders",
      type: "GET",
      dataType: "json",
      success: function (data) {
        reservations = data;

        var incomingOrders = reservations.filter(
          (reservation) => reservation.preparationStatus == "Pending"
        );
        var activeOrders = reservations.filter(
          (reservation) => reservation.preparationStatus == "Active"
        );

        var completedOrders = reservations.filter(
          (reservation) => reservation.preparationStatus == "Completed"
        );

        var queuedItems = activeOrders.map((reservation) =>
          reservation.items.filter(
            (item) => item.itemProcessingStatus == "Queued"
          )
        );
        var processingItems = activeOrders.map((reservation) =>
          reservation.items.filter(
            (item) => item.itemProcessingStatus == "Processing"
          )
        );
        var completedItems = activeOrders.map((reservation) =>
          reservation.items.filter(
            (item) => item.itemProcessingStatus == "Ready"
          )
        );

        var ongoingOrders = incomingOrders.concat(activeOrders);

        $("#ongoingOrders").html(createOrders(ongoingOrders));
        $("#completedOrders").html(createOrders(completedOrders));

        function createOrders(orders) {
          var html = "";
          orders.forEach((order) => {
            html += `
                            <div class="completed-order-item-card">
                                <table>
                                    <tr>
                                        <td>${order.reservationID}</td>
                                        <td>${order.customer.name}</td>
                                        <td>${order.tableID}</td>
                                        <td>${order.amount}</td>
                                        <td>${
                                          order.amountPaid - order.amount
                                        }  </td>
                                        <td>${order.preparationStatus}</td>
                                        <td>
                                        ${
                                          order.preparationStatus == "Completed"
                                            ? `<button class="light-green-btn markCompleted" data-id-reservationID = "${order.orderID}">Mark Complete</button>`
                                            : ""
                                        }
                                          ${
                                            order.preparationStatus !=
                                            "Completed"
                                              ? `<button class="light-green-btn addOrderItems" onClick="editOngoingOrder(this);" data-id-reservationID = "${order.orderID}">Add Items</button>`
                                              : ""
                                          }
                                        </td>
                                    </tr>
                                </table>
                            </div>
        `;
          });
          return html;
        }
      },
      error: function (err) {
        console.log("Error fetching menu items:", err);
      },
    });
  }
  fetchReservations();
});
