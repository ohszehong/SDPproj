<?php

  session_start();
  require "conn.php";

 ?>

 <?php

  $Meal_ID = $_POST['change-meal-id'];

  $Meal_Availability = $_POST['meal-availability'];

  if ($Meal_Availability == 'Y') {


    $sql = "UPDATE meal

            SET Meal_Availability = 'N'

            WHERE Meal_ID = '".$Meal_ID."'";

    $result = mysqli_query($conn,$sql);

    echo "<script>window.history.go(-1);</script>";

  }

  else if ($Meal_Availability == 'N') {

    $sql = "UPDATE meal
  
            SET Meal_Availability = 'Y'

            WHERE Meal_ID = '".$Meal_ID."'";

    $result = mysqli_query($conn,$sql);

    echo "<script>window.history.go(-1);</script>";

  }



/*  if ($Meal_Availability == 'Y') {

    $sqlupdate = "UPDATE meal SET Meal_Availability = 'N' WHERE Meal_ID ='".$Meal_ID."'";

    $resultupdate = mysqli_query($conn, $sqlupdate);


    $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    $Stall_ID = $rows['Stall_ID'];

    $sql2 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'Y'";

    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'N'";

    $result3 = mysqli_query($conn, $sql3);

    $sql4 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'C'";

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

         <form method='POST' action='UpdateMeal.php' id='update-meal-form'>
         <div id='update-btn'>

         <input type='hidden' id='update-meal-id' name='update-meal-id' value='".$rows2['Meal_ID']."'>

         <input type='submit' id='update-meal-btn' name='update-meal-btn' value='UPDATE'>


         </div>
         </form>";

       if ($rows2['Meal_Availability'] == 'Y') {

          echo "<div id='availability-btn' style='background-color:#03a9f4;'>

                <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

                AVAILABLE


                 </div>";

       }

       else {

         echo "<div id='availability-btn' style='background-color:#DB4141;'>

               <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

               N/A


               </div>";


       }



        echo   "</div>";




         echo "

         </div>

         ";



}

    }


    }


  else {

    $sqlupdate = "UPDATE meal SET Meal_Availability = 'Y' WHERE Meal_ID ='".$Meal_ID."'";

    $resultupdate = mysqli_query($conn, $sqlupdate);

    $sql2 = "SELECT Meal_ID, Meal_Availability FROM meal WHERE Meal_ID ='".$Meal_ID."'";

    $result2 = mysqli_query($conn, $sql2);

    $rows2 = mysqli_fetch_array($result2);

    $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    $Stall_ID = $rows['Stall_ID'];

    $sql2 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'Y'";

    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'N'";

    $result3 = mysqli_query($conn, $sql3);

    $sql4 = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."' && Meal_Accept = 'C'";

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

         <form method='POST' action='UpdateMeal.php' id='update-meal-form'>
         <div id='update-btn'>

         <input type='hidden' id='update-meal-id' name='update-meal-id' value='".$rows2['Meal_ID']."'>

         <input type='submit' id='update-meal-btn' name='update-meal-btn' value='UPDATE'>


         </div>
         </form>";

       if ($rows2['Meal_Availability'] == 'Y') {

          echo "<div id='availability-btn' style='background-color:#03a9f4;'>

                <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

                AVAILABLE


                 </div>";

       }

       else {

         echo "<div id='availability-btn' style='background-color:#DB4141;'>

               <input type='hidden' id='meal-availability' name='meal-availability' value='".$rows2['Meal_Availability']."'>

               N/A


               </div>";


       }



        echo   "</div>";




         echo "

         </div>

         ";



 }

    }


  } */


  ?>
