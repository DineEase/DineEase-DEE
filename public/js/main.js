
function showDialog(containerId , element) {
    const content = document.getElementById(containerId).innerHTML;
    const popupContent = document.getElementById('popup-content');
    popupContent.innerHTML = content;

    const popupContainer = document.getElementById('popup-container');
    popupContainer.style.display = 'flex'; 

    const closeButton = document.querySelector('.common-close-btn');
    closeButton.onclick = function() { 
        popupContainer.style.display = 'none';
    };
}

document.querySelector('.common-close-btn').addEventListener('click', function() {
    document.getElementById('popup-container').style.display = 'none';
});


