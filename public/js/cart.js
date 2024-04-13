// Get the elements by their ID
var popupLink = document.getElementById("view-food-menu-in-cart");
var popupWindow = document.getElementById("menu-div-purchase");
var closeButton = document.getElementById("close-menu-div-purchase");

// !show hide menus
// Show the pop-up window when the link is clicked
popupLink.addEventListener("click", function(event) {
    console.log("popupLink clicked");
  event.preventDefault();
  popupWindow.style.display = "block";
});

// Hide the pop-up window when the close button is clicked
closeButton.addEventListener("click", function() {
  popupWindow.style.display = "none";
});