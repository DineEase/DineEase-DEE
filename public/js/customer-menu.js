var menuItems = [];
var itemReviewMap = foodReviews.reduce((map, item) => {
  map[item.itemID] = item;
  return map;
}, {});


$(document).ready(function () {
  console.log("Customer Menu JS Loaded");
  console.log(foodReviews);
  let currentCategoryId = "all";
  let currentPage = 1;
  let itemsPerPage = 16;

  function paginateItems(items) {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    return items.slice(startIndex, endIndex);
  }

  function updatePageInfo(totalItems) {
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    $("#page-info").text(`Page ${currentPage} of ${totalPages}`);
    $("#prev-page").prop("disabled", currentPage === 1);
    $("#next-page").prop(
      "disabled",
      currentPage === totalPages || totalPages === 0
    );
  }

  function displayItems(items) {
    const paginatedItems = paginateItems(items);
    $("#menu-container").empty(); // Clear existing items
    paginatedItems.forEach(function (item) {
      $("#menu-container").append(createMenuItemCard(item));
    });
    updatePageInfo(items.length);
  }

  function fetchMenuItems() {
    $.ajax({
      url: "getMenuItemsAPI",
      type: "GET",
      dataType: "json",
      success: function (data) {
        menuItems = data.filter((item) => item.hidden != 1); 
        console.log(menuItems);
        filterItems(); 
      },
      error: function (err) {
        console.log("Error fetching menu items:", err);
      },
    });
  }

  function filterItems() {
    let filteredItems = menuItems;
    const searchQuery = $("#search-input").val().toLowerCase();
    if (currentCategoryId !== "all") {
      filteredItems = filteredItems.filter(
        (item) => item.category_ID === currentCategoryId
      );
    }
    if (searchQuery) {
      filteredItems = filteredItems.filter((item) =>
        item.itemName.toLowerCase().includes(searchQuery)
      );
    }
    displayItems(filteredItems);
  }

  $(".category-button").on("click", function () {
    $(".category-button").removeClass("active-category");
    $(this).addClass("active-category");
    currentCategoryId = $(this).data("category-id");
    currentPage = 1;
    filterItems();
  });
  $("#prev-page").on("click", function () {
    if (currentPage > 1) {
      currentPage--;
      filterItems();
    }
  });

  $("#next-page").on("click", function () {
    currentPage++;
    filterItems();
  });

  // Search functionality
  $("#search-button").on("click", function (e) {
    e.preventDefault(); // Prevent form submission
    currentPage = 1; // Reset to first page for search results
    filterItems();
  });

  $("#search-input").on("keyup", function (e) {
    currentPage = 1; // Reset to first page for search results
    filterItems();
  });

  fetchMenuItems();

  function createMenuItemCard(item) {
    let reviewDeets = getDetailsByItemIdFromMap(item.itemID);
    let starCount = reviewDeets.stars;
    let stars = "";
    for (let i = 0; i < starCount; i++) {
      stars += '<i class="fa-solid fa-star"></i>';
    }
    if (starCount < 5) {
      for (let i = 0; i < 5 - starCount; i++) {
        stars += '<i class="fa-regular fa-star"></i>';
      }
    }
    

    let prices = item.Prices.split(",").map((price) => price.trim());
    let sizes = item.Sizes.split(",").map((size) => size.trim());


    let initialSelectedSize = "Regular";
    let initialPriceIndex = sizes.indexOf(initialSelectedSize);
    let initialPrice = prices[initialPriceIndex];

    let sizeSelectorOptions = sizes
      .map(
        (size, index) =>
          `<option value="${index}" ${
            index === initialPriceIndex ? "selected" : ""
          }>${size.charAt(0).toUpperCase()}</option>`
      )
      .join("");

    let tag = `sizeSelector${item.itemID}`;
    let quantityTag = `quantitySelector${item.itemID}`;
    let addToCartTag = `addtocart${item.itemID}`;

    return `
      <div class="menu-item-card" data-item-id="${
        item.itemID
      }" data-prices='${JSON.stringify(prices)}'>
        <img src="${item.imagePath}" alt="${item.itemName}">
      
        <h3>${item.itemName}</h3>
        <div class="sizeandprice">
            <select class="sizeSelector" id="${tag}" name="selectedSizeOfItem" ${sizes.length === 1 ? "disabled" : ""}>
            ${sizeSelectorOptions}
          </select>
          <p class="menuItemPrice">Rs.<span class="price">${initialPrice}</span></p>
        </div>
        <div class="menu-card-footer">
          <div class="menu-card-footer-stars">${stars}</div>
          <div class="menu-card-footer-num">(${reviewDeets.count})</div>
        </div>
         <div class="cartOptions"> 
          <div class="product-quantity" >
            <div class="product-quantity-subtract" data-slot-label="${quantityTag}">
              <i class="fa fa-chevron-left"></i>
            </div>
            <input type="text" class="product-quantity-input" id="${quantityTag}" placeholder="1" value="1" />
          <div class="product-quantity-add"  data-slot-label="${quantityTag}">
              <i class="fa fa-chevron-right"></i>
          </div>
          </div>
          <div class="add-to-cart-button-menu btn" onclick="addToCart(${
            item.itemID
          })" id="${addToCartTag}"><i class="fa-solid fa-cart-plus"></i></div>
        </div>
        
        </div>
    `;
  }

  // Attach event listener to handle size changes
  $(document).on("change", ".sizeSelector", function () {
    // Get the selected index
    let selectedIndex = $(this).val();
    let menuItemCard = $(this).closest(".menu-item-card");
    let prices = JSON.parse(menuItemCard.attr("data-prices"));

    // Update the price based on selected size
    menuItemCard.find(".price").text(prices[selectedIndex]);
  });

  function getDetailsByItemIdFromMap(itemId) {
    if (itemReviewMap[itemId]) {
      return {
        stars: itemReviewMap[itemId].stars,
        count: itemReviewMap[itemId].count,
      };
    }
    else {
      return {
        stars: 5,
        count: 1,
      };
    }
  }
});

