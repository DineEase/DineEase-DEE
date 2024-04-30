//!Navigation of fieldsets
let selectedDateForReservation = "";
let selectedSlotForReservation = "";
let selectedNoOfPeopleForReservation = "";
let selectedPackageForReservation = "";
let slotDetails;
let slotMaxCapacity = 15;
var today = new Date();
var todayInSlotFormat;
const baseCostPerPerson = 500;
var minTimeToCancel = 24;
var dateToCheckPassedSlots;

todayInSlotFormat = formatDateToSlotFormat(today);
// console.log(todayInSlotFormat);

$(document).ready(function () {
  var current = 1;
  var steps = $("fieldset").length;

  setProgressBar(current);

  $(".next").click(function () {
    var current_fs = $(this).parent();
    var next_fs = $(this).parent().next();

    // Activate next step on progressbar
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    // Hide the current fieldset and show the next one
    current_fs.hide();
    next_fs.show();
    setProgressBar(++current);
  });

  $(".previous").click(function () {
    var current_fs = $(this).parent();
    var previous_fs = $(this).parent().prev();

    // De-activate current step on progressbar
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    // Hide the current fieldset and show the previous one
    current_fs.hide();
    previous_fs.show();
    setProgressBar(--current);
  });

  function setProgressBar(curStep) {
    var percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%");
  }

  $(".submit").click(function () {
    return false;
  });
});

//!Function to switch between menu options

$(document).ready(function () {
  // When a radio button is clicked
  $("input[type=radio][name=menu]").change(function () {
    // Get the value of the selected radio button
    var selectedMenu = $(this).val();

    // Load the content for the selected menu option
    $("#" + selectedMenu)
      .show()
      .siblings()
      .hide();
  });

  // Show the appetizers by default
  $("#appetizers").show();
});

$(document).ready(function () {
  $(".nav_link_switch").click(function (e) {
    e.preventDefault();

    // Get the content attribute value
    var content = $(this).data("content");

    // Make an AJAX request to fetch the content
    $.ajax({
      url: "index.php", // Change this to the actual handler
      method: "POST",
      data: { content: content },
      success: function (response) {
        // Update the content in the body-template
        $("#content").html(response);
      },
      error: function (xhr, status, error) {
        console.error("Error: " + error);
      },
    });
  });
});

$(".button-sidebar-menu").on("click", function () {
  // Remove 'active' class from all buttons
  $(".button-sidebar-menu").removeClass("active-nav");

  // Add 'active' class to the clicked button
  $(this).addClass("active-nav");
});

$(document).ready(function () {
  $("#add-review-popup").hide();
});

function toggleReviewForm() {
  var reviewPopup = document.getElementById("add-review-popup");
  reviewPopup.style.display =
    reviewPopup.style.display === "none" ? "block" : "none";
}

//!functions for Reviews

function toggleComment(reviewID) {
  var moreContent = document.getElementById("more-" + reviewID);
  var fullContent = document.getElementById("full-comment-" + reviewID);

  moreContent.style.display = "none";
  fullContent.style.display = "inline";
}

function toggleComment(reviewID) {
  var moreText = document.getElementById("more-" + reviewID);
  var fullComment = document.getElementById("full-comment-" + reviewID);

  if (fullComment.style.display === "none") {
    moreText.style.display = "none";
    fullComment.style.display = "inline";
  } else {
    moreText.style.display = "inline";
    fullComment.style.display = "none";
  }
}

//!functions for time slots
$(document).ready(function () {
  $("#checkSlots").click(function () {
    var dateOfTheReservation = today.getDate();
    if (selectedDateForReservation == dateOfTheReservation) {
      $.ajax({
        url: "getReservationSlots",
        data: { date: dateOfTheReservation },
        dataType: "json",
        success: function (response) {
          slotDetails = response;
          var pkg = parseInt($('input[name="packageID"]:checked').val(), 10);
          let filteredSlotDetails = slotDetails.filter(
            (item) => item.packageID === pkg
          );

          slotDetails = filteredSlotDetails;
        },
        error: function (xhr, status, error) {
          console.error("Error fetching data:", error);
        },
      });
    }
    $("#time-slots").empty();
    createTimeSlot();
    var slots = document.querySelectorAll(".time-slot:not(.faded)");
    if (slots.length > 0) {
      slots[0].classList.add("selected");
    }
    addClickHandlers();
  });

  //TODO: #36 Time slots are only being displayed correctly when the page is loaded for the first time.
  function createTimeSlot() {
    for (var hour = 8; hour <= 23; hour++) {
      var timeString = (hour < 10 ? "0" + hour : hour) + ":00";
      var slotIsFull = false;
      var timeIsPassed = false;

      var pkg = $('input[name="packageID"]:checked').val();
      if (pkg == 1) {
        slotMaxCapacity = packageSizes.Budget;
      }
      if (pkg == 2) {
        slotMaxCapacity = packageSizes.Gold;
      }
      if (pkg == 3) {
        slotMaxCapacity = packageSizes.Platinum;
      }

      function checkIsSlotFull() {
        if (slotDetails) {
          for (var slot of slotDetails) {
            var sum =
              Number(slot.total_people) +
              Number(selectedNoOfPeopleForReservation);
            if (slot.slot === hour && sum >= slotMaxCapacity) {
              return true;
            }
          }
        }
      }

      function checkIsTimePassed() {
        console.log("called");
        var currentTime = new Date();
        var currentHour = currentTime.getHours();
        if (dateToCheckPassedSlots === today.getDate()) {
          if (hour <= currentHour) {
            return true;
          }
        }
      }

      slotIsFull = checkIsSlotFull();

      if (selectedDateForReservation == todayInSlotFormat) {
        timeIsPassed = checkIsTimePassed();
      }

      var $timeSlot = $("<div>", {
        class:
          (slotIsFull || timeIsPassed ? " faded " : "time-slot") +
          (hour === 8 && !slotIsFull && !timeIsPassed ? " selected" : ""),
        id: "time-slot",
        "data-time": timeString,
        text: timeString,
      });

      $("#time-slots").append($timeSlot);
    }
  }

  function addClickHandlers() {
    $(".time-slot:not(.faded)").click(function () {
      $(".time-slot").removeClass("selected");
      $(this).addClass("selected");
      var selectedTime = $(this).data("time");
      $("#selectedTime").val(selectedTime);
      $("#summary-time").text(selectedTime);
      selectedSlotForReservation = selectedTime;
    });
  }
});

// no of people
$(document).ready(function () {
  $(".person-icon").click(function () {
    $(".person-icon").removeClass("selected");
    $(this).addClass("selected");
    var selectedNumber = $(this).data("value");
    $("#numOfPeople").val(selectedNumber);
    $("#summary-people").text(selectedNumber);
    selectedNoOfPeopleForReservation = selectedNumber;
  });
});

// date picker

// format date to yyyy-mm-dd
function formatDateToSlotFormat(date) {
  const year = date.getFullYear();
  const month = date.getMonth() + 1;
  const day = date.getDate();

  const formattedMonth = month < 10 ? "0" + month : month;
  const formattedDay = day < 10 ? "0" + day : day;

  return `${year}-${formattedMonth}-${formattedDay}`;
}

//fixed: #27 Dater Picker does not take the default date as the selected date without clicking on it again.

$(document).ready(function () {
  var dateOfTheReservation = today.getDate();
  selectedDateForReservation = new Date();
  selectedDateForReservation = formatDateToSlotFormat(
    selectedDateForReservation
  );
  dateToCheckPassedSlots = dateOfTheReservation;

  $.ajax({
    url: "getReservationSlots",
    data: { date: selectedDateForReservation },
    dataType: "json",
    success: function (response) {
      slotDetails = response;

      var pkg = parseInt($('input[name="packageID"]:checked').val(), 10);
      let filteredSlotDetails = slotDetails.filter(
        (item) => item.packageID === pkg
      );
      slotDetails = filteredSlotDetails;
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
    },
  });

  $(".date-slot").click(function () {
    $(".date-slot").removeClass("selected");
    $(this).addClass("selected");
    var selectedDate = $(this).data("date");
    $("#selectedDate").val(selectedDate);
    $("#summary-date").text(selectedDate);
    selectedDateForReservation = selectedDate;
    console.log(selectedDateForReservation);
    $.ajax({
      url: "getReservationSlots",
      data: { date: selectedDate },
      dataType: "json",
      success: function (response) {
        slotDetails = response;
        var pkg = parseInt($('input[name="packageID"]:checked').val(), 10);
        let filteredSlotDetails = slotDetails.filter(
          (item) => item.packageID === pkg
        );

        slotDetails = filteredSlotDetails;
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  });
});

//!function to select no of people

// people Selection
$(document).ready(function () {
  $(".person-icon").click(function () {
    var selectedNumber = $(this).data("value"); // Get the value data from the clicked icon
    $("#numOfPeople").val(selectedNumber); // Set the value of the hidden input field
    $(".person-icon").removeClass("selected");
    $(this).addClass("selected");
    $("#summary-people").text(selectedNumber); // Update the text of the summary field
    updateTotalAmount(); // Update the total amount when the number of people changes
  });
});

$(document).ready(function () {
  // Update the package in the summary when a package is selected
  $('input[name="packageID"]').change(function () {
    var selectedPackage = $('input[name="packageID"]:checked')
      .next(".name")
      .text();
    $("#summary-package").text(selectedPackage);
  });

  // Initialize the summary with the default/initially selected package
  var initialPackage = $('input[name="packageID"]:checked')
    .next(".name")
    .text();
  $("#summary-package").text(initialPackage || "None Selected"); // 'None Selected' is a placeholder
});

$("#summary-table").text($("#tableID").val());

// !Function to update total amount

function updateTotalAmount() {
  var totForFood = grandTotal;

  let total = baseCostPerPerson * parseInt($("#numOfPeople").val() || 1);

  let totalPrice = total + totForFood;

  $("#total-amount").text(`Rs.${totalPrice.toFixed(2)}`);
  $("#totalAmount").val(totalPrice.toFixed(2));
  document.getElementById("topCartTotalAmount").innerText =
    totForFood.toFixed(2);
}

$(document).on("change", "#cartTotalAmount", function () {
  updateTotalAmount();
});

$(document).ready(function () {
  // Constants

  // Initialize the summary fields with the default values
  let selectedDate =
    $("#selectedDate").val() || new Date().toISOString().split("T")[0]; // Current date if not set
  let selectedPeople = $("#numOfPeople").val() || 1; // Default to 1 person if not set
  let selectedTime = $("#selectedTime").val() || "08:00"; // Default time if not set
  let selectedPackage =
    $('input[name="packageID"]:checked').next(".name").text() || "T1";

  // Update the summary fields
  $("#summary-date").text(selectedDate);
  $("#summary-people").text(selectedPeople);
  $("#summary-time").text(selectedTime);
  $("#summary-package").text(selectedPackage);

  // Call updateTotalAmount to set the initial total
  updateTotalAmount();

  // Event listeners for date, time, and people selections
  $(".date-slot, .time-slot, .person-icon").click(function () {
    // Update the summary fields and total amount whenever a selection is made
    selectedDate = $("#selectedDate").val();
    selectedPeople = $("#numOfPeople").val();
    selectedTime = $("#selectedTime").val();

    $("#summary-date").text(selectedDate);
    $("#summary-people").text(selectedPeople);
    $("#summary-time").text(selectedTime);
    updateTotalAmount();
  });

  // Add new menu items
  $("#add-item").click(function () {
    let newItemHtml = `
          <div class="menu-item">
              <span>Chicken fried rice</span>
              <span class="price">3000.00</span>
              <span class="remove-item">Remove</span>
          </div>
      `;
    $(".menu-items").append(newItemHtml);
    updateTotalAmount(); // Update total when a new item is added
  });

  // Remove menu items
  $(document).on("click", ".remove-item", function () {
    $(this).closest(".menu-item").remove();
    updateTotalAmount(); // Update total when an item is removed
  });
});

//!functions for reservation view page

// function isAlreadyReviewed(reservationID) {

//   fetch(`isisThereAReview?reservationid=${reservationID}`)
//     .then(response => response.json())
//     .then(data => {
//         if (data.reviewExists) {
//             console.log("A review exists.");
//         } else {
//             console.log("No review available.");
//         }
//     })
//     .catch(error => console.error('Error:', error));
// }

function popViewReservationDetails(element) {
  var reservationID = element.getAttribute("data-reservation-id");
  var item = "";
  var reservationDetails;
  var isAlreadyReviewed;

  $.ajax({
    url: "getReservationDetails/" + reservationID,
    dataType: "json",
    success: function (response) {
      reservationDetails = response;
      openedReservationDetails = reservationDetails;

      if (reservationDetails && reservationDetails.length > 0) {
        isAlreadyReviewed = reservationDetails[0].review;
        console.log(isAlreadyReviewed);
        var status = reservationDetails[0].status;

        console.log(status);

        if (status != "Completed") {
          $("#rs-review").prop("disabled", true);
          $("#rs-review").css("opacity", "0.5");
          $("#rs-review").css("pointer-events", "none");
          $("#rs-review").css("cursor", "not-allowed");
        }

        if (status == "Cancelled") {
          $("#rs-review").prop("disabled", true);
          $("#rs-review").css("background-color", "grey");
          $("#rs-review").css("pointer-events", "none");
          $("#rs-review").css("cursor", "not-allowed");
        }

        if (status == "Pending") {
          $("#rs-review").prop("disabled", true);
          $("#rs-review").css("opacity", "0.5");
          $("#rs-review").css("pointer-events", "none");
          $("#rs-review").css("cursor", "not-allowed");

          $("#rs-cancel").prop("disabled", false);
          $("#rs-cancel").css("opacity", "0.5");
          $("#rs-cancel").css("pointer-events", "none");
          $("#rs-cancel").css("cursor", "pointer");
        }

        if (isAlreadyReviewed > 0) {
          $("#rs-review").prop("disabled", true);
          $("#rs-review").css("background-color", "grey");
          $("#rs-review").css("pointer-events", "none");
          $("#rs-review").css("cursor", "not-allowed");
          $("#rs-review").text("Already Reviewed");
        }

        $("#reservation-details-container").show();
        $("#rs-order-id").text(reservationDetails[0].orderID || "N/A");
        $("#rs-subtotal").text(
          "LKR : " +
            (reservationDetails[0].amount -
              reservationDetails[0].numOfPeople * 500) +
            ".00" || "N/A"
        );
        $("#rs-review").val(reservationDetails[0].orderID);
        $("#rs-order-date").text(reservationDetails[0].date || "N/A");
        // $("#rs-time").text(reservationDetails[0].reservationStartTime || 'N/A');
        $("#rs-reservation").text(
          "LKR : " + reservationDetails[0].numOfPeople * 500 + ".00" || "N/A"
        );
        // $("#rs-package").text(reservationDetails[0].packageID || 'N/A');
        $("#rs-Payable").text(
          "LKR" + reservationDetails[0].amount + ".00" || "N/A"
        );
        // $("#rs-status").text(reservationDetails[0].status || 'N/A');
        // $("#rs-table").text(reservationDetails[0].tableID || 'N/A');
        // $("#rs-customer").text(reservationDetails[0].customerID || 'N/A');
        var itemDiv = $(".rs-items");
        itemDiv.empty();
        reservationDetails[1].forEach((element) => {
          item += `<div class='rs-item-card'>
          <img src='${element.imagePath.replace(/\\\//g, "/")}' alt='item'>
          <div class='rs-item-details'>
            <table>
              <tr><td><p>Item Name: ${
                element.itemName
              }</p></td><td><p class='rs-item-price'>Item Price: Rs. ${
            element.price
          }.00</p></td></tr>
              <tr><td><p>Item Size: ${element.size}</p></td><td><p>Quantity: ${
            element.quantity
          }</p></td></tr>
            </table>
             <p class='rs-item-completed'>Completed</p>

            </div>
        </div>`;
        });
        itemDiv.append(item);
      } else {
        alert("No details available for this reservation.");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
      alert("Failed to fetch reservation details: " + error);
    },
  });

  $(document).on("click", "#rs-close-btn", function () {
    $("#reservation-details-container").hide();
    location.reload();
  });
}

var review;

function popAddReviewForTheReservation() {
  var reservationID = $("#rs-review").val();
  var item = "";
  var reservationDetails;
  // alert(reservationID);
  $.ajax({
    url: "getReservationDetails/" + reservationID,
    dataType: "json",
    success: function (response) {
      reservationDetails = response;

      if (reservationDetails && reservationDetails.length > 0) {
        $("#reservation-details-container").hide();
        $("#reservation-review-container").show();

        var suites = [" ", "Budget", "Gold", "Platinum"];

        $("#rr-order-id").text(reservationDetails[0].orderID || "N/A");
        $("#rr-order-date").text(reservationDetails[0].date || "N/A");
        $("#rr-order-suite").text(
          suites[reservationDetails[0].packageID] || "N/A"
        );

        var itemDiv = $("#review-order-item-container");
        itemDiv.empty();
        reservationDetails[1].forEach((element) => {
          var stars = createStars(element);
          item += `<div class='rs-item-card'>
                    <img src='${element.imagePath.replace(
                      /\\\//g,
                      "/"
                    )}' alt='item'>
                    <div class='rs-item-details'>
                    <table>
                      <tr><td><p>Item Name: ${
                        element.itemName
                      }</p></td><td><p class='rs-item-price'></p></td></tr>
                        <tr><td><p>Item Size: ${element.size}</p></td><td><p>
                        Rating :  ${stars}</p></td></tr>
                      </table>
                  </div>
                </div>`;
        });
        itemDiv.append(item);

        var rID = [];

        reservationDetails[1].forEach((element) => {
          rID.push((element.orderNo + element.itemID).toLowerCase());
        });

        review = {
          orderID: reservationDetails[0].orderID,
          suite: suites[reservationDetails[0].packageID],
          reservationID: reservationDetails[0].reservationID,
          customerID: reservationDetails[0].customerID,
          items: reservationDetails[1],
          reviewedItemsIDs: rID,
        };
      } else {
        alert("No details available for this reservation.");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
      alert("Failed to fetch reservation details: " + error);
    },
  });
  $(document).on("click", "#rs-close-btn-review", function () {
    $("#reservation-review-container").hide();
    $("#reservation-details-container").show();
  });
}

function createStars(item) {
  var stars = "";
  orderItem = item.orderNo + item.itemID;
  orderItem = orderItem.toLowerCase();
  for (var i = 0; i < 5; i++) {
    stars +=
      "<i class=' fa-star fa-solid reviewed-star ' onclick='setStarsItem(this);' id='" +
      orderItem +
      i +
      "'data-id='" +
      orderItem +
      "' value='" +
      i +
      "'></i>";
  }
  stars +=
    "<input type='hidden' id='" +
    orderItem +
    "-input' name='" +
    orderItem +
    "-rating' value='5'>";
  return stars;
}

// Review in reservation page

function setStars(element) {
  var value = parseInt($(element).attr("value")) + 1;
  var tdID = $(element).data("id");

  $("#" + tdID)
    .find("i")
    .each(function (index) {
      if (index < value) {
        $(this).removeClass("fa-regular fa-star");
        $(this).addClass("fa-solid fa-star reviewed-star");
      } else {
        $(this).removeClass("fa-solid fa-star reviewed-star");
        $(this).addClass("fa-regular fa-star");
      }
    });

  $("#" + tdID + "-input").val(value);
}

function setStarsItem(element) {
  var value = parseInt($(element).attr("value")) + 1;
  var tdID = $(element).data("id");
  parent = element.parentElement;

  $(parent)
    .find("i")
    .each(function (index) {
      if (index < value) {
        $(this).removeClass("fa-regular fa-star");
        $(this).addClass("fa-solid fa-star reviewed-star");
      } else {
        $(this).removeClass("fa-solid fa-star reviewed-star");
        $(this).addClass("fa-regular fa-star");
      }
    });
  $("#" + tdID + "-input").val(value);
}

function submitReviewForReservation() {
  var overallRating = document.getElementById(
    "overall-rating-cont-input"
  ).value;
  var suitRating = document.getElementById("suit-rating-cont-input").value;
  var reviewedItemsIDst = review.reviewedItemsIDs;
  var suite = review.suite;
  var reviewChecked = [];
  var comment = document.getElementById("review-comment").value;
  for (let i = 0; i < reviewedItemsIDst.length; i++) {
    itemToCheck = reviewedItemsIDst[i] + "-input";
    var rating = document.getElementById(itemToCheck).value;
    reviewChecked[i] = {
      reviewID: reviewedItemsIDst[i],
      ItemID: review.items[i].itemID,
      rating: rating,
    };
  }
  var reviewDataCollected = {
    orderID: review.orderID,
    reservationID: review.reservationID,
    customerID: review.customerID,
    overallRating: overallRating,
    suitRating: suitRating,
    comment: comment,
    reviewChecked: reviewChecked,
    suite: suite,
  };

  $.ajax({
    url: "submitReservationReview",
    method: "POST",
    data: reviewDataCollected,
    success: function (response) {
      toastr.success("Review submitted successfully.");
      $("#reservation-review-container").hide();
      console.log(response);
    },
    error: function (xhr, status, error) {
      console.error("Error submitting review:", error);
      alert("Failed to submit review: " + error);
    },
  });
}

//! topbar

$(document).ready(function () {
  $(document).on("click", ".topbar-shoping-cart", function () {
    function createTopbarCartItems() {
      var cartRowHTML = "";
      var loopTotal = 0;
      var cartArray = JSON.parse(sessionStorage.getItem("food-cart") || "[]");

      cartArray.forEach(function (item, index) {
        var subTotal = parseFloat(item.price) * parseInt(item.quantity);
        var id = item.itemID;

        cartRowHTML +=
          "<div class='topbar-cart-item'>" +
          "<div class='topbar-cart-image'>" +
          "    <img src=' " +
          item.itemImage +
          " '/>" +
          " </div>" +
          " <div class='topbar-cart-details'>" +
          "     <h4>" +
          item.itemName +
          "</h4>" +
          "    <p>Price : " +
          item.price +
          "</p>" +
          "   <p>Quantity : " +
          item.quantity +
          " </p>" +
          " </div>" +
          "   <div class='topbar-cart-clear'>" +
          "      <button>X</button>" +
          "    </div>" +
          "</div>";
        subTotal = parseFloat(item.price) * parseInt(item.quantity);
        loopTotal += subTotal;
      });

      $(".topbar-cart-content").empty();
      $(".topbar-cart-content").html(cartRowHTML);
    }
    createTopbarCartItems();
    if ($(".topbar-cart-container").is(":visible")) {
      $(".topbar-cart-container").hide();
    } else {
      $(".topbar-cart-container").show();
    }
  });

  $(document).on("click", "#topbar-cart-clear", function () {
    $(".topbar-cart-container").hide();
  });

  // var cart = document.querySelector(".topbar-shoping-cart");

  // var observer = new MutationObserver(function (mutations) {
  //   mutations.forEach(function (mutation) {
  //     if (
  //       mutation.type === "attributes" &&
  //       mutation.attributeName === "value"
  //     ) {
  //       alert("Cart cahnged");
  //     }
  //   });
  // });

  // observer.observe(cart, {
  //   attributes: true,
  // });
});

function closeCancelReservation() {
  $("#reservation-cancel-container").hide();
  $("#reservation-details-container").show();
}

$(document).ready(function () {
  var possibilityToRefund;
  var reservationID;
  var orderID;
  var amount;
  var date;
  var suiteID;
  var suite;
  var suiteName;
  var slotToCancel;

  $(document).on("click", "#rs-cancel", function () {
    $("#reservation-cancel-container").show();
    $("#reservation-details-container").hide();

    reservationID = openedReservationDetails[0].reservationID;

    orderID = openedReservationDetails[0].orderID;
    amount = openedReservationDetails[0].amount;
    date = openedReservationDetails[0].date;
    suiteID = openedReservationDetails[0].packageID;
    suite = ["Budget", "Gold", "Platinum"];
    suiteName = suite[suiteID];

    slotToCancel = openedReservationDetails[0].reservationStartTime;
    possibilityToRefund;

    var checkingDate = new Date(date);
    checkingDate.setHours(0, 0, 0, 0);
    slotToHourFormat(slotToCancel);
    checkingDate.setHours(checkingDate.getHours() + parseInt(slotToCancel));

    let timeDifference = checkingDate - today;

    let rangeToCheck = minTimeToCancel * 60 * 60 * 1000;

    if (timeDifference < rangeToCheck) {
      possibilityToRefund = 0;
    } else {
      possibilityToRefund = 1;
    }

    $("#rc-order-id").text(orderID);
    $("#rc-order-suite").text(suiteName);
    $("#rc-order-date").text(date);
    loadCancellationDetails(
      openedReservationDetails[0].status,
      possibilityToRefund
    );
  });

  $(document).on("click", "#rc-submit-cancel", function () {
    swal({
      title: "Are you sure?",
      text: "Once Cancelled, you will not be able to recover this reservation!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("You have cancelled the reservation", {
          icon: "success",
        });
        cancelReservation(possibilityToRefund);
      } else {
        
      }
    });
    
    
  });

  function loadCancellationDetails(status, possibilityToRefund) {
    if (
      status == "Refund Requested" ||
      status == "Cancelled" ||
      status == "Refunded"
    ) {
      $("#rc-submit-cancel").prop("disabled", true);
      $("#rc-submit-cancel").css("background-color", "grey");
      $("#rc-submit-cancel").text("Already Cancelled");
      $("#rc-submit-cancel").css("pointer-events", "none");
      $("#rc-submit-cancel").css("cursor", "not-allowed");

      if (status == "Refund Requested") {
        $("#cancel-order-refund-given").hide();
        $("#cancel-order-refund-possible").hide();
        $("#cancel-order-refund-not-possible").hide();
        $("#cancel-order-cancelled-no-refund").hide();
        $("#cancel-order-refund-requested").show();
      } else if (status == "Cancelled") {
        $("#cancel-order-refund-given").hide();
        $("#cancel-order-refund-requested").hide();
        $("#cancel-order-refund-possible").hide();
        $("#cancel-order-refund-not-possible").hide();
        $("#cancel-order-cancelled-no-refund").show();
      } else if (status == "Refunded") {
        $("#cancel-order-refund-requested").hide();
        $("#cancel-order-refund-possible").hide();
        $("#cancel-order-refund-not-possible").hide();
        $("#cancel-order-cancelled-no-refund").hide();
        $("#cancel-order-refund-given").show();
      }
    } else {
      if (possibilityToRefund == 1) {
        $("#cancel-order-refund-given").hide();
        $("#cancel-order-refund-not-possible").hide();
        $("#cancel-order-cancelled-no-refund").hide();
        $("#cancel-order-refund-requested").hide();
        $("#cancel-order-refund-possible").show();
      } else if (possibilityToRefund == 0) {
        $("#cancel-order-refund-given").hide();
        $("#cancel-order-cancelled-no-refund").hide();
        $("#cancel-order-refund-possible").hide();
        $("#cancel-order-refund-requested").hide();
        $("#cancel-order-refund-not-possible").show();
      }
    }
  }

  function cancelReservation(possibilityToRefunds) {
    $.ajax({
      url: "cancelReservation",
      method: "POST",
      data: {
        reservationID: reservationID,
        orderID: orderID,
        amount: amount,
        date: date,
        possibilityToRefund: possibilityToRefunds,
      },
      success: function (response) {
        // $("#reservation-cancel-container").hide();
        cancelationResponse = response;

        if (
          cancelationResponse.status == 1 &&
          cancelationResponse.refund == 1
        ) {
          $("#cancel-order-refund-possible").hide();
          $("#cancel-order-refund-not-possible").hide();
          $("#cancel-order-cancelled-no-refund").hide();
          $("#cancel-order-refund-requested").show();

          console.log("Refund will be processed within 24 hours.");
        } else if (
          cancelationResponse.status == 1 &&
          cancelationResponse.refund == 0
        ) {
          $("#cancel-order-refund-possible").hide();
          $("#cancel-order-refund-not-possible").hide();
          $("#cancel-order-refund-requested").hide();
          $("#cancel-order-cancelled-no-refund").show();

          console.log(
            "Refund is not possible for this reservation but cancelled the reservation."
          );
        } else {
          // $("#cancel-order-refund-possible").hide();
          // $("#cancel-order-refund-not-possible").show();
          // $("#cancel-order-refund-not-possible").text(
          //   "Failed to cancel reservation."
          // );
          console.log("Failed to cancel reservation.");
        }
        location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error cancelling reservation:", error);
        alert("Failed to cancel reservation: " + error);
      },
    });
  }
});

function slotToHourFormat(slot) {
  if (slot < 0) {
    throw new Error("Number must be non-negative.");
  }

  const hours = Math.floor(slot);
  const minutes = Math.floor((slot - hours) * 60);

  const paddedHours = hours.toString().padStart(2, "0");
  const paddedMinutes = minutes.toString().padStart(2, "0");

  return `${paddedHours}:${paddedMinutes}`;
}
