document.addEventListener("DOMContentLoaded", function () {
  var updateButton = document.getElementById("update-dp");
  if (updateButton) {
    updateButton.addEventListener("click", function () {
      document.getElementById("upload-container").style.display = "block";
      document.getElementById("overlay-profile").style.display = "block";
    });
  }

  var overlay = document.getElementById("overlay-profile");
  if (overlay) {
    overlay.addEventListener("click", function () {
      document.getElementById("upload-container").style.display = "none";
      this.style.display = "none";
    });
  }

  var closeButton = document.getElementById("close-upload");
  if (closeButton) {
    closeButton.addEventListener("click", function () {
      document.getElementById("upload-container").style.display = "none";
      document.getElementById("overlay-profile").style.display = "none";
    });
  }

  var fileInput = document.getElementById("file-upload");
  if (fileInput) {
    fileInput.addEventListener("change", function () {
      if (this.files.length > 0) {
        var fileName = this.files[0].name;
        if (fileName.length > 20) {
          fileName = fileName.substring(0, 20) + "...";
        }
        document.getElementById("file-name").textContent = fileName;
        document
          .getElementById("upload-dp-btn")
          .classList.remove("button-disabled");
      }
    });
  }

  //

  var updateButton2 = document.getElementById("change-user-password");
  if (updateButton2) {
    updateButton2.addEventListener("click", function () {
      document.getElementById("change-password-div").style.display = "block";
      document.getElementById("overlay-profile").style.display = "block";
    });
  }

  var overlay = document.getElementById("overlay-profile");
  if (overlay) {
    overlay.addEventListener("click", function () {
      document.getElementById("change-password-div").style.display = "none";
      this.style.display = "none";
    });
  }

  var closeButton = document.getElementById("close-upload");
  if (closeButton) {
    closeButton.addEventListener("click", function () {
      document.getElementById("upload-container").style.display = "none";
      document.getElementById("overlay-profile").style.display = "none";
    });
  }

  var subimitdp = document.getElementById("upload-dp-btn");
  if (subimitdp) {
    subimitdp.addEventListener("click", function () {});
  }
});

function toastrSuccess(message) {
  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "3000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  toastr.success(message);
}

function validatePasswords() {
  var newPassword = document.getElementById("new-psw").value;
  var confirmPassword = document.getElementById("confirm-psw").value;
  if (newPassword !== confirmPassword) {
    
    toastr.error("Passwords do not match");
    return false;
  }
  form.submit();
}
  

function validateForm() {
  var currentPassword = document.getElementById("current-psw").value;
  var newPassword = document.getElementById("new-psw").value;
  var confirmPassword = document.getElementById("confirm-psw").value;
  if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
    toastr.error("All fields are required");
    return false;
  }
  return validatePasswords();
}