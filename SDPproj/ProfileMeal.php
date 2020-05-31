
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile Meal</title>
    <link rel="stylesheet" type="text/css" href="Profile.css">
    <link rel='stylesheet' type="text/css" href="ProfileMeal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>

  /*  $(document).ready(function() {
    $(document).on('click','#availability-btn',function (e){


      var MealID = $('#update-meal-id').val();
      var MealAvailability = $('#meal-availability').val();

      $.ajax ({

        type :'POST',
        data :{
                MealID:MealID,
                MealAvailability:MealAvailability
              },
        url  :"SetAvailability.php",
        success : function(data){
           $('#user-info-2').html(data);
        }

      })

    });


}); */





    </script>

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="profile-template">

     <div id="user-info-1">

     <div class='ProfilePicture'>

       <form id='ProfileUpdate' action='ProfilePicUpdate.php' method='post' enctype='multipart/form-data'>
       <label class='UpdatePic'>
       <input type="file" name='ProfilePic' required='required' onchange='this.form.submit();' id="choosefile">
       </label>
       </form>

     <?php



     $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

     $result = mysqli_query($conn, $sql);

     $rows = mysqli_fetch_array($result);

     $profilepic = $rows['User_Image'];

     if ($profilepic == NULL) {
       echo "<img src='SDP materials/user.png'>";
     }
     else {
       echo "<img src='".$profilepic."'>";
     }



     ?>




     </div>

     <div id="user-name">

     <?php

     $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

     $result = mysqli_query($conn, $sql);

     $rows = mysqli_fetch_array($result);

     echo $rows['User_LN'];
     echo "&nbsp;";
     echo $rows['User_FN'];




      ?>


     </div>


     <div id="user-details">

       <?php

       $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

       $result = mysqli_query($conn, $sql);

       $rows = mysqli_fetch_array($result);



       echo "GENDER:";
       echo "&nbsp;";

       if ($rows['User_Gender'] == "M") {

         echo "MALE";

       }
       elseif ($rows['User_Gender'] == "F") {

         echo "FEMALE";

       }

       echo "<br>";
       echo "<br>";

       echo "EMAIL:";
       echo "&nbsp;";
       echo $rows['User_Email'];

       echo "<br>";
       echo "<br>";

       echo "PHONE NO:";
       echo "&nbsp;";
       echo  $rows['User_Phone'];



        ?>





     </div>


     <div id="user-balance">

     <?php


     echo "BALANCE:";
     echo "&nbsp;";
     echo "MYR";
     echo "&nbsp;";

     echo $rows['User_Balance'];




      ?>

      <a href="Topupform.php" id="link"><div id="topup-btn">

      TOP UP

      </div></a>






     </div>


     <div id="stall-info">

     <?php

     $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

     $result = mysqli_query($conn, $sql);

     $rows = mysqli_fetch_array($result);

     $Contract = $rows['Stall_Contract'];

     if ($_SESSION['Role'] === "1") {



       echo "<u>STALL INFORMATION</u>";

       echo "<br><br>";

       echo "STALL NAME:";

       echo "&nbsp;";

       echo $rows['Stall_Name'];

       echo "&nbsp;&nbsp;&nbsp;";

       echo "<a href='UpdateStallform.php' id='link'><span id='edit-stall'>edit <img src='SDP materials/edit.png'></span></a>";

       echo "<br><br>";

       echo "CONTRACT until:";

       echo "<br>";

       list($year , $month , $date) = explode("-",$Contract);

       $monthname = date("F", mktime(0, 0, 0, $month, 10));


       echo $year;

       echo "&nbsp;";

       echo $monthname;

       echo "&nbsp";

       echo $date;

       echo "<br>";

       echo "<div id='stall-image'>";


       echo "<form id='StallUpdate' action='StallPicUpdate.php' method='post' enctype='multipart/form-data'>
             <label class='UpdateStall'>
             <input type='file' name='StallPic' required='required' onchange='this.form.submit();' id='choosefile'>
             </label>
             </form>";


             $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

             $result = mysqli_query($conn, $sql);

             $rows = mysqli_fetch_array($result);

             $stallpic = $rows['Stall_Image'];

             if ($stallpic == NULL) {
               echo "<img src='SDP materials/no-image(stall).png'>";
             }
             else {
               echo "<img src='".$stallpic."'>";
             }



      echo "</div>";









     }





      ?>




     </div>






     <div class="bottom-btn">

     <a href="UpdateAccountform.php" id="link"><div id="updateacc-btn">

       UPDATE ACCOUNT

     </div></a>

     <a href="ChangePasswordsform.php" id="link"><div id="changepw-btn">

       CHANGE PASSWORDS

     </div></a>





     </div>



     </div>


     <div id="user-info-2">

     <div id="user-info-2-links">

     <a href="PurchaseHistory.php" id="link"><div id="user-info-2-link-ph">PURCHASE HISTORY</div></a>

     <a href="TopupHistory.php" id="link"><div id="user-info-2-link-th">TOP-UP HISTORY</div></a>

     <a href="Notifications.php" id="link"><div id="user-info-2-link-notify">NOTIFICATIONS</div></a>












     <?php


     if ($_SESSION['Role'] === "1") {

       echo "<a href='ProfileMeal.php' id='link'><div id='user-info-2-link-meals'>MEALS</div></a>";

       echo "<a href='Sales.php' id='link'><div id='user-info-2-link-sr'>SALES REPORT</div></a>";

     }







      ?>





     </div>



     <div id="add-meals">

       <a href="AddNewMeal.php" id="link">
        <div id="add-meals-btn">




       </div>

       </a>


      <span id="add-meals-title"> ADD MEAL </span>


     </div>


     <?php

     $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

     $result = mysqli_query($conn, $sql);

     $rows = mysqli_fetch_array($result);

     $Stall_ID = $rows['Stall_ID'];

     $sql2 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'Y' && Meal_Delete = 'N'";

     $result2 = mysqli_query($conn, $sql2);

     $sql3 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'N' && Meal_Delete = 'N'";

     $result3 = mysqli_query($conn, $sql3);

     $sql4 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'C' && Meal_Delete = 'N'";

     $result4 = mysqli_query($conn, $sql4);


 echo "<div class='meal-display'>";
     if (mysqli_num_rows($result2) > 0) {

       while ($rows2 = mysqli_fetch_array($result2)) {


      echo "

            <div id='current-meal'>
            <img src='".$rows2['Meal_Image']."'>

          </div>


          <div id='current-meal-info'>

          <form method='post' action='DeleteMeal.php' id='delete-form'>

          <input type='hidden' name='MealID' value='".$rows2['Meal_ID']."'>
          <input type='image' name='delete' src='SDP materials/x-mark.png' id='delete-logo'>

          </form>

          <p id='meal-title'>".$rows2['Meal_Name']."</p>



          <p id='meal-desc'>".$rows2['Meal_Description']."</p>

          <br>

          <p id='meal-info'>Meal Categories: ".$rows2['Meal_Category_1']." , ".$rows2['Meal_Category_2']."</p>


          <p id='meal-info'>Meal Price: MYR".$rows2['Meal_Price']."</p>";

          echo "

          <p id='meal-info'>Meal Discount: ";


          if ($rows2['Meal_Discount'] == 0) {
            echo "N/A";
            echo "</p>";
          }
          else {
            echo $rows2['Meal_Discount'];
            echo "</p>";
          }


          echo

          "
          <div class='meal-btn-template'>

          <form method='POST' action='UpdateMealform.php' id='update-meal-form'>
          <div id='update-btn'>

          <input type='hidden' id='update-meal-id' name='update-meal-id' value='".$rows2['Meal_ID']."'>

          <input type='submit' id='update-meal-btn' name='update-meal-btn' value='UPDATE'>


          </div>
          </form>";

        if ($rows2['Meal_Availability'] == 'Y') {

           echo "
                <form action='SetAvailability.php' method='POST'>

                <div id='availability-btn'>

                <input type='hidden' id='change-meal-id' name='change-meal-id' value='".$rows2['Meal_ID']."'>

                 <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

                 <input type='submit' id='change-availability' name='change-availability' value='AVAILABLE'>


                  </div>

                  </form>";

        }

        else {

          echo "

                <form action='SetAvailability.php' method='POST'>

                <div id='availability-btn'>

                <input type='hidden' id='change-meal-id' name='change-meal-id' value='".$rows2['Meal_ID']."'>

                <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

                <input type='submit' id='change-availability-2' name='change-availability' value='N/A'>


                </div>

                </form>";


        }



         echo   "</div>";




          echo "

          </div>

          ";



}

     }
     if (mysqli_num_rows($result3) > 0) {

       while ($rows3 = mysqli_fetch_array($result3)) {
         echo "

              <div id='pending-image-border'></div>
               <div id='pending-meal'>
               PENDING REQUEST...










             </div>
             ";
           }
       }


       if (mysqli_num_rows($result4) > 0) {

         while ($rows4 = mysqli_fetch_array($result4)) {


        echo "

              <div id='current-meal'>
              <img src='".$rows4['Meal_Image']."'>











            </div>

            <div id='current-meal-info'>

            <form method='post' action='DeleteMeal.php' id='delete-form'>

            <input type='hidden' name='MealID' value='".$rows4['Meal_ID']."'>
            <input type='image' name='delete' src='SDP materials/x-mark.png' id='delete-logo'>

            </form>



            <p id='reject-info'>Request has been rejected:
                    <br>
                    possible reason:
                    <br>
                    unsuitable pictures (e.g not transparent etc)
                    <br>
                    unsuitable meal name, description (e.g vulgar or sensitive words etc)
            </p>
            <br><br>

            <p id='meal-info'>Original information:</p>
            <br>
            <p id='meal-info'>Meal Name: ".$rows4['Meal_Name']."</p>
            <p id='meal-info'>Meal Categories: ".$rows4['Meal_Category_1']." , ".$rows4['Meal_Category_2']."</p>
            <p id='meal-info'>Meal Price: ".$rows4['Meal_Price']."</p>
            <p id='meal-info'>Meal Description: ".$rows4['Meal_Description']."</p>
            <p id='meal-info'>Meal Discount: ";

            if ($rows4['Meal_Discount'] == 0) {
              echo "N/A";
              echo "</p>";
            }
            else {
              echo $rows4['Meal_Discount'];
              echo "</p>";
            }

            echo "

                </div>


            ";



  }
     }



     echo "</div>";







      ?>



     </div>


     </div>



   </div>



  </body>
</html>
