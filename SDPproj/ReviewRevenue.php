<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Review Revenue</title>
    <link rel="stylesheet" type="text/css" href="ReviewRevenue.css">

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">

     <div id="review-title">
     <div id='title-text'>REVENUE REVIEW</div>
     </div>

     <?php

     $sql = "SELECT MONTH(Order_Date) as Month, YEAR(Order_Date) as Year FROM user_order

             JOIN order_meal

             ON order_meal.Order_ID = user_order.Order_ID

             JOIN meal

             ON meal.Meal_ID = order_meal.Meal_ID

             GROUP BY Month,Year ORDER BY Year DESC,Month DESC";

     $result = mysqli_query($conn, $sql);


     if (mysqli_num_rows($result) > 0) {



      while ($rows = mysqli_fetch_array($result)) {

        echo "<div class='revenue-grid'>";

        echo "<div id='revenue-title'>

             <div id='blue-bars'></div>";

        $Thismonth = $rows['Month'];
        $Thisyear = $rows['Year'];

        $monthname = date("F", mktime(0, 0, 0, $Thismonth, 10));


        echo "<div id='revenue-desc'>Revenue in ".$monthname." ".$Thisyear."</div>";



            $getmonth = date('m');
            $getyear = date('Y');


            if ($Thismonth == $getmonth && $Thisyear == $getyear) {

              echo "
                  <div id='print-btn'>
                  ";

              echo "<input type='hidden' id='this-month' name='this-month' value='".$Thismonth."'>

                    <input type='hidden' id='this-year' name='this-year' value='".$Thisyear."'>

                    <input type='submit' id='print-submit-2' name='print-submit-2' value='Still Calculating...'>

                    </div>";

            }

            else {

              echo "
                  <div id='print-btn'>
                  <form action='RevenueReport.php'>

                  ";

              echo "<input type='hidden' id='this-month' name='this-month' value='".$Thismonth."'>

                    <input type='hidden' id='this-year' name='this-year' value='".$Thisyear."'>

                    <input type='submit' id='print-submit' name='print-submit' value='PRINT'>

                    </form>
                    </div>";

            }

           echo "</div>";

           echo "<div class='revenue-bars-grid'>";


        $sql3 = "SELECT * FROM stall";

        $result3 = mysqli_query($conn, $sql3);

        while ($rows3 = mysqli_fetch_array($result3)) {

          $sql2 = "SELECT * , SUM(OM_Price) as TotalRevenue FROM order_meal

                   JOIN user_order

                   ON user_order.Order_ID = order_meal.Order_ID

                   JOIN meal

                   ON order_meal.Meal_ID = meal.Meal_ID

                   JOIN stall

                   ON stall.Stall_ID = meal.Stall_ID

                   WHERE meal.Stall_ID = '".$rows3['Stall_ID']."' && MONTH(user_order.Order_Date) = '".$Thismonth."' && YEAR(user_order.Order_Date) = '".$Thisyear."' && order_meal.OM_Status = 'completed'

                   GROUP BY stall.Stall_ID

                   ORDER BY YEAR(user_order.Order_Date) DESC, MONTH(user_order.Order_Date) DESC";


          $result2 = mysqli_query($conn, $sql2);

          $rows2 = mysqli_fetch_array($result2);

          if (mysqli_num_rows($result2) > 0) {


            echo "<div id='revenue-bars'>

                  ".$rows3['Stall_Name']." has earned a total profit of MYR ".$rows2['TotalRevenue']."

                  <p id='tick'>
                  <img src='SDP materials/tick.png'>
                  </p>

                  </div>";

          }

          else {
            echo "<div id='revenue-bars'>

                  ".$rows3['Stall_Name']." has earned a total profit of MYR 0.00

                  <p id='tick'>
                  <img src='SDP materials/cross.png'>
                  </p>

                  </div>";
          }

        }



   echo "</div>";
   echo "</div>";

}
}

     ?>


     </div>

  </body>
</html>
