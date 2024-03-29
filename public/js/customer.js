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
    var selectedTime = $(this).data("time"); // Get the time data from the clicked slot
    $("#selectedTime").val(selectedTime); // Set the value of the hidden input field
    $("#summary-time").text(selectedTime); // Update the text of the summary field
  });
});

// date picker
$(document).ready(function () {
  $(".date-slot").click(function () {
    $(".date-slot").removeClass("selected");
    $(this).addClass("selected");
    var selectedDate = $(this).data("date"); // Get the date data from the clicked slot
    $("#selectedDate").val(selectedDate); // Set the value of the hidden input field
    $("#summary-date").text(selectedDate); // Update the text of the summary field
  });
});

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
    var selectedPackage = $('input[name="packageID"]:checked').next(".name").text();
    $("#summary-package").text(selectedPackage);
  });

  // Initialize the summary with the default/initially selected package
  var initialPackage = $('input[name="packageID"]:checked').next(".name").text();
  $("#summary-package").text(initialPackage || 'None Selected'); // 'None Selected' is a placeholder
});

$("#summary-table").text($("#tableID").val());

$(document).ready(function () {
  // Constants
  const baseCostPerPerson = 500;

  // Function to update total amount
  function updateTotalAmount() {
      let total = baseCostPerPerson * parseInt($("#numOfPeople").val() || 1); // Default to 1 person if not set
      $(".menu-item .price").each(function () {
          total += parseFloat($(this).text());
      });

      $("#total-amount").text(`Rs.${total.toFixed(2)}`);
      $("#totalAmount").val(total.toFixed(2));
  }

  // Initialize the summary fields with the default values
  let selectedDate = $("#selectedDate").val() || new Date().toISOString().split('T')[0]; // Current date if not set
  let selectedPeople = $("#numOfPeople").val() || 1; // Default to 1 person if not set
  let selectedTime = $("#selectedTime").val() || '08:00'; // Default time if not set
  let selectedPackage = $('input[name="packageID"]:checked').next(".name").text() || 'T1'; 

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

  // Proceed to payment
  $("#proceed-to-pay").click(function () {
      // Logic to handle payment
  });

  // ... other event listeners ...
});



