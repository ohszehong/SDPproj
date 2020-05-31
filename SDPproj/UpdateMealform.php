<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Meal</title>
    <link rel="stylesheet" type="text/css" href="AddNewMeal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>
  <body style="background-color:rgba(51,48,48);">

    <?php

    require "navbar.php";

     ?>


         <div class="wrapper">

         <div class="grid-template">

           <?php

           $Meal_ID = $_POST['update-meal-id'];

           $sql = "SELECT * FROM meal WHERE Meal_ID = '".$Meal_ID."'";

           $result = mysqli_query($conn, $sql);

           $rows = mysqli_fetch_array($result);


        echo "

         <div id='form-title'>
         <div id='title'>
         UPDATE MEAL
         </div>
         </div>


         <div id='form-input'>
         <form action='UpdateMeal.php' method='post' onsubmit='return Error(this)' id='addstall-form' enctype='multipart/form-data'>

         <input type='hidden' id='meal-id' name='meal-id' value='".$Meal_ID."'>

         <input type='text' id='meal-name' name='meal-name' placeholder='Meal's Name...' value='".$rows['Meal_Name']."'>

         <input type='text' id='meal-price' name='meal-price' placeholder='Meal's Price...' onkeyup='checkDec(this)' autocomplete='off' value='".$rows['Meal_Price']."'>

         <textarea id='meal-desc' name='meal-desc' placeholder='Meal's Description'>".$rows['Meal_Description']."</textarea>

         <select name='meal-category-1' id='meal-category-1' required>
         <option value='' disabled selected hidden>Meal's Category 1</option>
         <option value='breakfast'>BREAKFAST</option>
         <option value='sets'>SETS</option>
         <option value='spicy'>SPICY</option>
         <option value='western'>WESTERN</option>
         <option value='asians'>ASIANS</option>
         <option value='desserts'>DESSERTS</option>
         <option value='drinks'>DRINKS</option>
         </select>

         <select name='meal-category-2' id='meal-category-2' required>
         <option value='' disabled selected hidden>Meal's Category 2</option>
         <option value='breakfast'>BREAKFAST</option>
         <option value='sets'>SETS</option>
         <option value='spicy'>SPICY</option>
         <option value='western'>WESTERN</option>
         <option value='asians'>ASIANS</option>
         <option value='desserts'>DESSERTS</option>
         <option value='drinks'>DRINKS</option>
         </select>

         <input type='text' name='meal-discount' placeholder='Discount apply (in MYR)...' id='meal-discount' onkeyup='checkDec(this)' value='".$rows['Meal_Discount']."'>

         <p id='stall-contract-desc'>*Meal image</p>
          <label for='meal-image' id='meal-image-label'>
          UPLOAD FILE
          </label>
          <input type='file'  id='meal-image' name='meal-image'>
          <label id='file-name'></label>

         <input type='submit' id='update-meal' name='update-meal' value='UPDATE' style='background-color:#03a9f4;'>

         <a href='ProfileMeal.php' id='link'>
         <div id='cancel-btn'>
         CANCEL
         </div>
         </a>

         </form>
         </div>";


         ?>


         </div>

          <div id='validate'></div>

         </div>



    <script>


  document.querySelector("#meal-image").onchange = function(){
  document.querySelector("#file-name").textContent = this.files[0].name;
}

    function Error() {

        var Mealname = document.getElementById("meal-name").value;
        var Mealprice = document.getElementById("meal-price").value;
        var Mealdesc = document.getElementById("meal-desc").value;
        var Mealcategory1 = document.getElementById("meal-category-1").value;
        var Mealcategory2 = document.getElementById("meal-category-2").value;
        var Mealimage = document.getElementById("meal-image").value;
        var Mealdiscount = document.getElementById('meal-discount').value;

        if (Mealname == ""){
            document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Meal name is required";
          return false;
        }

      if (Mealprice == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal price is required";
          return false;
        }

     if (isNaN(Mealprice)){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal price can only contains numbers";
          return false;
        }


     if (Mealdesc == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal desc is required";
          return false;
        }

     if (Mealdesc.length < 20){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal desc has to contain at least 20 characters";
          return false;
        }

    if (Mealcategory1 == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal categories are required";
          return false;
        }

     if (Mealcategory2 == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal categories is required";
          return false;
        }

     if (Mealimage == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Meal image is required";
          return false;
        }

        if (Mealimage == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Meal image is required";
             return false;
           }

     if (isNaN(Mealdiscount)) {
          document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Discount can only contains numbers";
          return false;
        }

        else {
          document.getElementById('validate').innerHTML = "";
        }

    }



    </script>

    <script>
function checkDec(el){
var ex = /^\d*\.?\d{0,2}$/
if(ex.test(el.value)==false){
  el.value = el.value.substring(0,el.value.length - 1);
 }
}
</script>


  </body>
</html>
