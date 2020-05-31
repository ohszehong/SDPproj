<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <link rel="stylesheet" type="text/css" href="SalesReport.css">

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

    <div class="wrapper">

    <?php

      $Stall_ID = $_GET['this-stall-id'];
      $Year = $_GET['this-year'];
      $Month = $_GET['this-month'];

      $No = 1;

      $TotalPrice = 0;

      $sql = "SELECT * FROM stall WHERE Stall_ID ='".$Stall_ID."'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      $Stall_Image = $rows['Stall_Image'];

      $monthname = date("F", mktime(0, 0, 0, $Month, 10));

      echo "<div id='report-title'>".$monthname." ".$Year."</div>";
      echo "<div id='stall-name'>FROM ".$rows['Stall_Name']."</div>";


      echo "<div id='report-header-grid'>

            <div id='header'>No.</div>

            <div id='header'>Meal ID</div>

            <div id='header'>Meal Name</div>

            <div id='header'>Total Sold</div>

            <div id='header'>Total Price (MYR)</div>

            </div>";


      $allmeal = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."'";

      $allmealresult = mysqli_query($conn, $allmeal);

      echo "<div id='report-grid'>";

      while ($allmealarray = mysqli_fetch_array($allmealresult)) {

        $Meal_ID = $allmealarray['Meal_ID'];

      echo  "<div id='report-data'>
             ".$No."
             </div>

             <div id='report-data'>
             ".$allmealarray['Meal_ID']."
             </div>

             <div id='report-data'>
             ".$allmealarray['Meal_Name']."
             </div>";



               $sql2 = "SELECT * , SUM(order_meal.OM_Quantity) as TotalSold , SUM(order_meal.OM_Price) as TotalPrice  FROM order_meal

                            JOIN user_order

                            ON order_meal.Order_ID = user_order.Order_ID

                            JOIN meal

                            ON order_meal.Meal_ID = meal.Meal_ID

                            JOIN stall

                            ON meal.Stall_ID = stall.Stall_ID

                            WHERE order_meal.Meal_ID = '".$Meal_ID."' && order_meal.OM_Status = 'completed' && meal.Stall_ID = '".$Stall_ID."' && MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."'

                            GROUP BY order_meal.Meal_ID

                            ORDER BY TotalPrice DESC";

     $result2 = mysqli_query($conn, $sql2);

   if (mysqli_num_rows($result2) > 0) {

    while ($rows2 = mysqli_fetch_array($result2)) {

      $TotalPrice = $TotalPrice + $rows2['TotalPrice'];

  echo      " <div id='report-data'>
             ".$rows2['TotalSold']."
             </div>

             <div id='report-data'>
             ".number_format($rows2['TotalPrice'],2)."
             </div>";


        }

    }

      else {

        echo      " <div id='report-data'>
                   0
                   </div>

                   <div id='report-data'>
                   0.00
                   </div>";



      }

$No++;

    }


      echo "<div id='subtotal'>
            SUB TOTAL
            </div>";

      echo "<div id='total'>

            ".number_format($TotalPrice,2)."

            </div>";


        echo   "</div>";


      echo "<div id='earn-desc'>* You have earned a total(flat) of MYR".$TotalPrice." in ".$monthname." ".$Year."</div>"

     ?>



   </div>






  </body>
</html>
