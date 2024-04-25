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

var reservations = [];

$(document).ready(function () {
  $(document).on("click", ".markCompleted", function () {
    var orderID = $(this).data("id-reservationid");
    markCompleted(orderID);
  });

//   $(document).ready(function () {
//   $(document).on("click", ".addOrderItems", function () {
//     var orderID = $(this).data("id-reservationid");
//     markCompleted(orderID);
//   });

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
                                              ? `<button class="light-green-btn addOrderItems" data-id-reservationID = "${
                                                order.orderID
                                              }">Add Items</button>`
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
