$(document).ready(function () {
  let currentCategoryId = "all"; // Default to show all categories
  let currentPage = 1;
  let itemsPerPage = 16; // Adjust based on your preference

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

  function fetchMenuItems() {
    $.ajax({
      url: "getMenuItemsAPI",
      type: "GET",
      dataType: "json",
      success: function (menuItems) {
        const filteredItems = menuItems.filter(function (item) {
          return (
            item.hidden != 1 &&
            (currentCategoryId === "all" ||
              item.category_ID === currentCategoryId)
          );
        });
        const paginatedItems = paginateItems(filteredItems);
        $("#menu-container").empty(); // Clear existing items
        paginatedItems.forEach(function (item) {
          $("#menu-container").append(createMenuItemCard(item));
        });
        updatePageInfo(filteredItems.length);
      },
      error: function (err) {
        console.log("Error fetching menu items:", err);
      },
    });
  }

  $(".category-button").on("click", function () {
    $(".category-button").removeClass("active-category");
    $(this).addClass("active-category");
    currentCategoryId = $(this).data("category-id");
    currentPage = 1; // Reset to first page when changing categories
    fetchMenuItems();
  });

  $("#prev-page").on("click", function () {
    if (currentPage > 1) {
      currentPage--;
      fetchMenuItems();
    }
  });

  $("#next-page").on("click", function () {
    currentPage++;
    fetchMenuItems();
  });

  fetchMenuItems(); // Initial fetch for menu items
  function createMenuItemCard(item) {
    return `
                <div class="menu-item-card">
                    <img src="${item.imagePath}" alt="${item.itemName}">
                    <h3>${item.itemName}</h3>
                    <p>Price: ${item.price}</p>
                </div>
            `;
  }
});
