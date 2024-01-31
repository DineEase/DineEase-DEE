$(document).ready(function () {
  var current_fs, next_fs, previous_fs;
  var opacity;
  var current = 1;
  var steps = $("fieldset").length;

  setProgressBar(current);

  $(".next").click(function () {
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          next_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
    setProgressBar(++current);
  });

  $(".previous").click(function () {
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //Remove class active
    $("#progressbar li")
      .eq($("fieldset").index(current_fs))
      .removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
      { opacity: 0 },
      {
        step: function (now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            display: "none",
            position: "relative",
          });
          previous_fs.css({ opacity: opacity });
        },
        duration: 500,
      }
    );
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

// JavaScript code for toggleComment function (if needed)
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

// time slots
$(document).ready(function () {
  $(".time-slot").click(function () {
    $(".time-slot").removeClass("selected");
    $(this).addClass("selected");
    $("#selectedTime").val($(this).data("time"));
  });
});

// // date selection
// document.addEventListener("DOMContentLoaded", function () {
//     var today = new Date();
//     var maxDate = new Date();
//     maxDate.setDate(today.getDate() + 15);

//     var dateString = formatDate(today);
//     var maxDateString = formatDate(maxDate);

//     var datePicker = document.getElementById('date');
//     datePicker.value = dateString;
//     datePicker.min = dateString;
//     datePicker.max = maxDateString;
// });

// function formatDate(date) {
//     var d = new Date(date),
//         month = '' + (d.getMonth() + 1),
//         day = '' + d.getDate(),
//         year = d.getFullYear();

//     if (month.length < 2)
//         month = '0' + month;
//     if (day.length < 2)
//         day = '0' + day;

//     return [year, month, day].join('-');
// }

// date picker
$(document).ready(function () {
  $(".date-slot").click(function () {
    $(".date-slot").removeClass("selected");
    $(this).addClass("selected");
    $("#selectedDate").val($(this).data("date"));
  });
});

// people Selection
$(document).ready(function () {
  $(".person-icon").click(function () {
    var selectedNumber = $(this).data("value");
    $("#numOfPeople").val(selectedNumber);
    $(".person-icon").removeClass("selected");
    $(this).addClass("selected");
  });
});

// reservation summery
document.addEventListener("DOMContentLoaded", function () {
  // Placeholder for retrieving these values from a previous step or storage
  let selectedDate = "2022-08-01"; // Example date
  let selectedPeople = 4; // Example number of people
  let selectedTime = "19:00"; // Example time

  // Set the summary details
  document.getElementById("summary-date").textContent = selectedDate;
  document.getElementById("summary-people").textContent = selectedPeople;
  document.getElementById("summary-time").textContent = selectedTime;

  // Functionality to add new menu items
  document.getElementById("add-item").addEventListener("click", function () {
    let menuContainer = document.querySelector(".menu-items");
    let newItem = document.createElement("div");
    newItem.classList.add("menu-item");
    newItem.innerHTML = `<span>New Food Item</span><span class="price">Price</span>`;
    menuContainer.appendChild(newItem);
    updateTotalAmount();
  });

  // Update the total amount
  function updateTotalAmount() {
    let total = 0;
    document.querySelectorAll(".menu-item .price").forEach(function (item) {
      total += parseFloat(item.textContent);
    });
    document.getElementById("total-amount").textContent = `Rs.${total.toFixed(
      2
    )}`;
  }

  // Functionality to proceed to payment
  document
    .getElementById("proceed-to-pay")
    .addEventListener("click", function () {
      // Proceed to payment logic here
    });
});
