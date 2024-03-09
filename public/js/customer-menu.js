$(document).ready(function () {
  let currentCategoryId = "all"; // Default to show all categories
  let currentPage = 1;
  let itemsPerPage = 16; // Adjust based on your preference
  let menuItems = []; 

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
    paginatedItems.forEach(function(item) {
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
        menuItems = data.filter(item => item.hidden != 1); // Store fetched items
        filterItems(); // Initial display or filter
      },
      error: function (err) {
        console.log("Error fetching menu items:", err);
      },
    });
  }

  function filterItems() {
    let filteredItems = menuItems;
    const searchQuery = $('#search-input').val().toLowerCase();
    if (currentCategoryId !== 'all') {
      filteredItems = filteredItems.filter(item => item.category_ID === currentCategoryId);
    }
    if (searchQuery) {
      filteredItems = filteredItems.filter(item => item.itemName.toLowerCase().includes(searchQuery));
    }
    displayItems(filteredItems);
  }
  
  $('.category-button').on('click', function() {
    $('.category-button').removeClass('active-category');
    $(this).addClass('active-category');
    currentCategoryId = $(this).data('category-id');
    currentPage = 1; // Reset to first page when changing categories
    filterItems();
  });
  $('#prev-page').on('click', function() {
    if (currentPage > 1) {
      currentPage--;
      filterItems();
    }
  });

  $('#next-page').on('click', function() {
    currentPage++;
    filterItems();
  });

  // Search functionality
  $('#search-button').on('click', function(e) {
    e.preventDefault(); // Prevent form submission
    currentPage = 1; // Reset to first page for search results
    filterItems();
  });

  $('#search-input').on('keyup', function(e) {
    currentPage = 1; // Reset to first page for search results
    filterItems();
  });

  fetchMenuItems();

  function createMenuItemCard(item) {
    let starCount = 5;
    let stars = '';
    for (let i = 0; i < starCount; i++) {
      stars += '<i class="fa-solid fa-star"></i>';
    }

    return `
      <div class="menu-item-card">
        <img src="${item.imagePath}" alt="${item.itemName}">
        <h3>${item.itemName}</h3>
        <p><b>Rs.${item.price}.00</b></p>
        <div class="menu-card-footer">
          <div class="menu-card-footer-stars">${stars}</div>
          <div class="menu-card-footer-num">(50)</div>
        </div>
      </div>
    `;
  }
});
