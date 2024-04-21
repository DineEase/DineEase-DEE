document.addEventListener('DOMContentLoaded', function() {
    var updateButton = document.getElementById('update-dp');
    if (updateButton) {
        updateButton.addEventListener('click', function() {
            document.getElementById('upload-container').style.display = 'block';
            document.getElementById('overlay-profile').style.display = 'block';
        });
    }

    var overlay = document.getElementById('overlay-profile');
    if (overlay) {
        overlay.addEventListener('click', function() {
            document.getElementById('upload-container').style.display = 'none';
            this.style.display = 'none';
        });
    }

    var closeButton = document.getElementById('close-upload');
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            document.getElementById('upload-container').style.display = 'none';
            document.getElementById('overlay-profile').style.display = 'none';
        });
    }

    var fileInput = document.getElementById('file-upload');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                var fileName = this.files[0].name;
                document.getElementById('file-name').textContent = fileName;
                document.getElementById('upload-dp-btn').classList.remove('button-disabled');
            }
        });
    }
});