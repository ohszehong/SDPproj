<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Image Check</title>
    <link rel="stylesheet" type="text/css" href="ImageCheck.css">
  </head>
  <body>

    <?php

    require "navbar.php";

     ?>


     <div class="wrapper">


      <?php


      $sql = "SELECT * FROM meal
              JOIN stall
              ON meal.Stall_ID = stall.Stall_ID
              WHERE Meal_Accept = 'N'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {

        echo "<div class='template'>";

        while ($rows = mysqli_fetch_array($result)) {

          echo "<div id='meal-request-image'>
                <img src='".$rows['Meal_Image']."'>
                <form method='post' action=''>





                </form>
                </div>";

        echo "<div id='meal-request-info'>

              <p id='stall-title'>FROM: ".$rows['Stall_Name']."<p>

              <br>


              <p id='stall-info'>Meal Name: ".$rows['Meal_Name']."</p>

              <br>

              <p id='stall-info'>Meal Categories: ".$rows['Meal_Category_1']." , ".$rows['Meal_Category_2']."</p>

              <br>

              <p id='stall-info'>Meal Price: MYR".$rows['Meal_Price']."</p>

              <br>

              <p id='stall-info'>Meal Description: ".$rows['Meal_Description']."</p>


              <br>

              <p id='stall-info'>Meal Discount: ";

              if ($rows['Meal_Discount'] == NULL) {
                echo "N/A";
                echo "</p>";
              }
              else {
                echo "MYR".$rows['Meal_Discount']."";
                echo "</p>";
              }

              echo "

              <br>

              <form action='ImageDecide.php' method='post'>

              <input type='hidden' name='MealID' value='".$rows['Meal_ID']."'>
              <input type='submit' name='Accept' value='Accept' id='submit-accept'>
              <input type='submit' name='Reject' value='Reject' id='submit-reject'>

              </form>

             </div>";




        }

        echo "</div>";

      }



       else {

         echo "<div id='no-request'>

               <div id='no-request-content'>

              <img src='SDP materials/mail.png'>

              <br>
              <br>

              NO REQUEST

               </div>


               </div>";

       }

?>


     </div>

  </body>
</html>
