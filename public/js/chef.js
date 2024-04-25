var reservations = [];



$(document).ready(function () {
  $(document).on("click", ".add-to-queue-btn", function () {
    var orderID = $(this).data("order-id");
    addToQueue(orderID);
  });

    $(document).on("click", "#start-processing", function () {
        var itemID = $(this).data("item-id");
        startProcessing(itemID);
    });

    $(document).on("click", "#mark-ready", function () {
        var itemID = $(this).data("item-id");
        markReady(itemID);
    }
    );

    function startProcessing(itemID) {
        $.ajax({
            url: "startProcessing",
            type: "POST",
            data: { itemID: itemID },
            success: function (data) {
                console.log(data);
                fetchReservations();
            },
            error: function (err) {
                console.log("Error starting processing:", err);
            },
        });
    }

    function markReady(itemID) {
        $.ajax({

            url: "markReady",
            type: "POST",
            data: { itemID: itemID },
            success: function (data) {
                console.log(data);
                fetchReservations();
            },
            error: function (err) {
                console.log("Error marking ready:", err);
            },
        });
    }


  function addToQueue(orderID) {
    $.ajax({
      url: "addToQueue",
      type: "POST",
      data: { orderID: orderID },
      success: function (data) {
        console.log(data);
        fetchReservations();
      },
      error: function (err) {
        console.log("Error adding order to queue:", err);
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

        $("#incoming-orders").html(createOrders(incomingOrders));
        $("#active-orders").html(createOrders(activeOrders));

        $("#queued-items").html(createItems(queuedItems));
        $("#processing-items").html(createItems(processingItems));
        $("#completed-items").html(createItems(completedItems));

        console.log([].concat.apply([], completedItems).length);

        $("#order-count-incoming").text(incomingOrders.length);
        $("#order-count-active").text(activeOrders.length);

        $("#item-count-queued").text([].concat.apply([], queuedItems).length);
        $("#item-count-processing").text(
          [].concat.apply([], processingItems).length
        );
        $("#item-count-completed").text(
          [].concat.apply([], completedItems).length
        );

        // $("#item-count-completed").

        function createItems(items) {
          var html = "";
          items.forEach((innerArray) => {
            innerArray.forEach((item) => {
              html += `
                        <div class="order-card-container">
                        <div class="row">
                            <h3>${item.itemName}</h3>
                            ${
                              item.itemProcessingStatus == "Queued"
                                ? `<button class="order-item-button" id="start-processing" data-item-id="${item.orderItemID}"> Start Processing </button>`
                                : ""
                            }
                            ${
                              item.itemProcessingStatus == "Processing"
                                ? `<button class="order-item-button" id="mark-ready" data-item-id="${item.orderItemID}"> Ready </button>`
                                : ""
                            }
                        </div>
                        <div class="row space-between">
                            <span class="size">${item.size}</span>
                            <span class="quantity">Quantity : ${
                              item.quantity
                            }</span>
                        </div>
                    </div>
                    `;
            });
          });
          return html;
        }

        function createOrders(orders) {
          var html = "";
          orders.forEach((order) => {
            var items = order.items.map((item) => {
              return `
                <div class="row">
                    <span class="quantity">${item.quantity}</span> X
                    <span class="item"> ${item.itemName} </span> -
                    <span class="size">${item.size}</span>
                </div>
                `;
            });

            html += `
                <div class="order-card-container">
                <div class="row">
                <div class="column">
                <span class="orderNo">${order.orderID}</span>
                <span class="tableNo">${order.tableID} </span>
                <span class="orderTime">${order.reservationStartTime} </span>
                </div>
                <div class="column half">
                ${items.join("")}
                </div>
            </div>
            <div class="row space-between">
            ${
              order.preparationStatus == "Pending"
                ? `<span class="est-time"> 30 Min</span>`
                : ""
            }
            ${
              order.preparationStatus == "Pending"
                ? `<button  class="add-to-queue-btn" data-order-id="${order.orderID}">Add To Queue</button>`
                : ""
            }
            ${
              order.preparationStatus == "Active"
                ? `<span class="est-time"> Time Remaining : 15 Min</span>`
                : ""
            }
           
            </div>
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
