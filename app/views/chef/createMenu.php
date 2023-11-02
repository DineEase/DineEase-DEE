<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Create Menu Item</title>
      <style>
         body {
         background-color: #282c34;
         color: #ffffff;
         font-family: 'Arial', sans-serif;
         text-align: center;
         margin: 0;
         }
         h3 {
         font-size: 3rem;
         margin: 2rem 0;
         }
         .editmenu {
         display: flex;
         flex-direction: column;
         align-items: center;
         padding: 2rem;
         background-color: #61dafb; /* Light blue background */
         border-radius: 1rem;
         box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
         }
         .imagePart img {
         width: 350px;
         height: 400px;
         border-radius: 1rem;
         object-fit: cover;
         border: 5px solid #ffffff;
         }
         .imagePart span {
         display: inline-block;
         margin-top: 1rem;
         padding: 0.5rem 1.5rem;
         border-radius: 0.5rem;
         background-color: #000000;
         font-size: 1.2rem;
         cursor: pointer;
         }
         .NamePart input,
         .NamePart select {
         width: 100%;
         padding: 1rem;
         font-size: 1.2rem;
         border: none;
         margin-bottom: 1rem;
         border-radius: 0.5rem;
         }
         .buttons button {
         color: #ffffff;
         background-color: #030303;
         outline: none;
         border: none;
         font-size: 1.5rem;
         padding: 1rem 2rem;
         margin-right: .7rem;
         border-radius: 0.5rem;
         cursor: pointer;
         }
         .menubuttons {
         display: flex;
         justify-content: center;
         gap: 1rem;
         margin-bottom: 1rem;
         }
         .buttons, .menubuttons {
         display: flex;
         justify-content: center;
         gap: 1rem;
         margin-bottom: 1rem;
         }
      </style>
   </head>
   <body>
      <div class="editmenu">
         <div class="others">
            <div class="imagePart">
               <img src=""/>
               <div class="buttons">
                  <form action="<?php echo URLROOT; ?>/chefs/submitMenuitem" method="post" id="menuForm" enctype="multipart/form-data">
                     <button type="button" id="imageButton">Add Image</button>
                     <input type="file" name="imagePath" accept="image/*" style="display: none;" id="imageInput"
                        onchange="previewImage(event)">
               </div>
            </div>
            <div class="NamePart">
            <input type="text" name="itemName" class="<?php echo (!empty($data['itemName_err'])) ? 'is-invalid' : '' ?>" placeholder="name" required/>
            <span class="invalid-feedback"> <?php echo $data['itemName_err'] ?> </span>
            <input type="text" name="price" class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : '' ?>" placeholder="price" required/>
            <span class="invalid-feedback"> <?php echo $data['price_err'] ?> </span>
            <input type="text" name="averageTime" class="<?php echo (!empty($data['averageTime_err'])) ? 'is-invalid' : '' ?>" placeholder="time" required/>
            <span class="invalid-feedback"> <?php echo $data['averageTime_err'] ?> </span>
            <div class="buttons">
            <button type="submit">Save Changes</button>
            <button type="button" onclick="resetForm()">Reset</button>
            <button type="button" id="cancelButton">Cancel</button>
            </div>
            </div>
            </form>
         </div>
      </div>
      <script>
        
         
         document.getElementById('imageButton').addEventListener('click', function() {
         document.getElementById('imageInput').click();
         });
         
         function previewImage(event) {
         var input = event.target;
         var preview = document.querySelector('.imagePart img');
         var reader = new FileReader();
         
         reader.onload = function () {
             preview.src = reader.result;
         };
         
         reader.readAsDataURL(input.files[0]);
         }
         function resetForm() {
         document.getElementById('menuForm').reset();
         // Reset the preview image
         document.querySelector('.imagePart img').src = '';
         

         }
         
      </script>
      <script>
    // Get the cancel button element by its ID
    var cancelButton = document.getElementById('cancelButton');

    // Add click event listener to the cancel button
    cancelButton.addEventListener('click', function(event) {
        // Redirect to the index page when the button is clicked
        window.location.href = '<?php echo URLROOT; ?>/chefs/menu/;';
    });
</script>
   </body>
</html>