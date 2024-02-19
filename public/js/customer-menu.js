$(document).ready(function() {
    $.ajax({
        url: 'getMenuItemsAPI', 
        type: 'GET',
        dataType: 'json',
        success: function(menuItems) {
            menuItems.forEach(function(item) {
                $('#menu-container').append(createMenuItemCard(item));
            });
        },
        error: function(err) {
            console.log('Error fetching menu items:', err);
        }
    });
});

function createMenuItemCard(item) {
    return `
        <div class="menu-item-card">
            <img src="${item.imagePath}" alt="${item.itemName}">
            <h3>${item.itemName}</h3>
            <p>Price: ${item.price}</p>
            
        </div>
    `;
}