<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New User</title>
    <link rel="stylesheet" type="text/css" href="ChangePasswordsform.css">
  </head>
  <body>

    <?php

    require "navbar.php";

     ?>


     <div class="wrapper">

     <div id="form-title">It seems you are new here, Please Change your passwords</div>


     <div class="changepasswordsform">

     <form method="post" action="ChangePasswords.php" onsubmit="return Error(this)">

     <?php

     $sql = "SELECT * FROM user WHERE User_ID ='".$_SESSION['Username']."'";

     $result = mysqli_query($conn, $sql);

     $rows = mysqli_fetch_array($result);

     if (mysqli_num_rows($result) > 0) {

     echo "

     <div id='change-input'>
     <input type='password' id='old-passwords' name='old-password' value='".$rows['User_Passwords']."' placeholder='Old Passwords...' readOnly='readonly'>
     </div>

     <div id='change-input'>
     <input type='password' id='new-passwords' name='new-password' placeholder='New Passwords...'>
     </div>

     <div id='submit-btn'>
     <input type='submit' id='changepasswords-btn' name='changepasswords' value='CHANGE PASSWORDS'>
     </div>

      ";

   }

   else {

  /*    echo'<script>alert("Please login first!");
     window.location.href = "LoginUser.php";
     </script>'; */

   }

     ?>

    </form>

    <a href="MainpageAll.php" id="link"><div id="Cancel">CANCEL</div></a>

     </div>


     <div id='validate'></div>


     </div>

     <script>

     function Error() {

         var NewPasswords = document.getElementById("new-passwords").value;

         var pattern = new RegExp('^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$');

         var testPasswords = pattern.test(NewPasswords);


         if (NewPasswords == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* New Passwords is blank";
           return false;
         }

         if (testPasswords == false){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Passwords must be alphanumeric";
           return false;
         }

         if (NewPasswords.length < 8){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Passwords length must not less than 8";
           return false;
         }


         else {
           document.getElementById('validate').innerHTML = "";
         }

     }



     </script>



  </body>
</html>
