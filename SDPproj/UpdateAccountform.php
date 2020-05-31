

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Account</title>
    <link rel="stylesheet" type="text/css" href="UpdateAccountform.css">
    <link rel="stylesheet" type="text/css" href="AddNewMeal.css">
  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">



     <div class="updateaccountform">

       <div id="form-title">Update Account</div>

     <form action="UpdateAccount.php" method="post" onsubmit="return Error(this)">

    <?php

    $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {

    echo "

     <div id='update-input' style='margin-top:0;'>
     <input type='text' id='firstname' name='firstname' placeholder='First Name' value='".$rows['User_FN']."'>
     </div>

     <div id='update-input'>
     <input type='text' id='lastname' name='lastname' placeholder='Last Name' value='".$rows['User_LN']."'>
     </div>

     <div id='update-input'>
     <input type='text' id='email' name='email' placeholder='E-mail' value='".$rows['User_Email']."'>
     </div>

     <div id='update-input'>
     <input type='text' id='confirm-email' name='confirm-email' placeholder='Confirm E-mail' value='".$rows['User_Email']."'>
     </div>

     <div id='update-input'>
     <input type='text' id='phonenum' name='phonenum' placeholder='Phone number' value='".$rows['User_Phone']."'>
     </div>

     <div id='submit-btn'>
     <input type='submit' id='updateaccount-btn' name='updateaccount' value='UPDATE ACCOUNT'>
     </div>

     ";
   }

   else {
     echo "<script>alert('Please login first!')</script>;";
     echo "<script>window.location.href = 'LoginUser.php'</script>;";

   }



     ?>

     </form>

     <a href="ProfileMeal.php" id="link"><div id="Cancel">CANCEL</div></a>

     </div>


     <div id='validate'></div>


     </div>




     <script>

     function Error() {

         var FirstName = document.getElementById("firstname").value;
         var LastName = document.getElementById("lastname").value;
         var Email = document.getElementById("email").value;
         var ConfirmEmail = document.getElementById("confirm-email").value;
         var PhoneNumber = document.getElementById("phonenum").value;

         var pattern = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
         var usernamepattern = new RegExp(/^\S(?!.*\s{2}).*?\S$/);
         var phonepattern = new RegExp(/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/);

         var testEmail = pattern.test(Email);
         var testConfirmEmail = pattern.test(ConfirmEmail);
         var testFirstname = usernamepattern.test(FirstName);
         var testLastname = usernamepattern.test(LastName);
         var testPhoneNum = phonepattern.test(PhoneNumber);


         if (FirstName == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* First Name cannot be blank!";
           return false;
         }

         if (testFirstname == false){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Invalid First name";
           return false;
         }

       if (LastName == ""){
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Last Name cannot be blank!";
           return false;
         }

         if (testLastname == false){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Invalid Last name";
           return false;
         }

         if (testEmail == false){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Invalid Email format";
           return false;
         }


      if (testConfirmEmail == false){
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Invalid Confirm Email format";
           return false;
         }

         if(Email != ConfirmEmail) {
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Email and Confirm Email are not the same";
           return false;
         }


      if (testPhoneNum == false){
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Invalid Phone numbers";
           return false;
         }


     if (PhoneNumber.length < 8){
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Phone numbers is invalid";
           return false;
         }


         else {
           document.getElementById('validate').innerHTML = "";
         }

     }



     </script>




  </body>
</html>
