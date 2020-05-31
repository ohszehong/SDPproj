<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <link rel="stylesheet" type="text/css" href="SalesReport.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

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

      echo "<div id='report-title'>Monthly Sales Report in ".$monthname." ".$Year."</div>";
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


      echo "<div id='earn-desc'>* You have earned a total(flat) of MYR".$TotalPrice." in ".$monthname." ".$Year."</div>";

     ?>

     <?php

     $No2 = 1;
     $Noloop = 3;

     echo "<div id='report-header-grid'>

           <div id='header'>No.</div>

           <div id='header'>Meal ID</div>

           <div id='header'>Meal Name</div>

           <div id='header'>Total Sold</div>

           <div id='header'>Total Price (MYR)</div>

           </div>";


                   $sql2 = "SELECT * , SUM(order_meal.OM_Quantity) as TotalSold , SUM(order_meal.OM_Price) as TotalPrice  FROM order_meal

                            JOIN user_order

                            ON order_meal.Order_ID = user_order.Order_ID

                            JOIN meal

                            ON order_meal.Meal_ID = meal.Meal_ID

                            JOIN stall

                            ON meal.Stall_ID = stall.Stall_ID

                            WHERE order_meal.OM_Status = 'completed' && meal.Stall_ID = '".$Stall_ID."' && MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."'

                            GROUP BY order_meal.Meal_ID

                            ORDER BY TotalPrice DESC LIMIT 3";

                 $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result2) > 0) {


    while ($rows2 = mysqli_fetch_array($result2)) {

       echo "<div id='report-grid'>";


     echo  "<div id='report-data'>
            ".$No2."
            </div>

            <div id='report-data'>
            ".$rows2['Meal_ID']."
            </div>

            <div id='report-data'>
            ".$rows2['Meal_Name']."
            </div>";


            $TotalPrice = $TotalPrice + $rows2['TotalPrice'];

          echo      "<div id='report-data'>
                     ".$rows2['TotalSold']."
                    </div>

                    <div id='report-data'>
                    ".number_format($rows2['TotalPrice'],2)."
                    </div>";


      echo  "</div>";

      $No2++;

      }

      }

      if ($Noloop - $No2 > 0) {

        $ForNo = $Noloop - $No2;

        while ($ForNo > 0) {

        echo "<div id='report-grid'>";


      echo  "<div id='report-data'>
             -
             </div>

             <div id='report-data'>
             -
             </div>

             <div id='report-data'>
             -
             </div>";

           echo      "<div id='report-data'>
                      -
                     </div>

                     <div id='report-data'>
                     -
                     </div>";


       echo  "</div>";

       $ForNo--;

      }

    }


      echo "<div id='earn-desc'>* Top 3 Sales in ".$monthname." ".$Year."</div>";



   ?>

   <?php

   $query = "SELECT * FROM meal WHERE Stall_ID = '".$Stall_ID."'";
   $result = mysqli_query($conn, $query);
   $chart_data = '';
   $chart_data2 = '';
   $color = '';
   while($row = mysqli_fetch_array($result))
   {

   $ThisMeal_ID = $row['Meal_ID'];

   $query2 =   "SELECT * , SUM(order_meal.OM_Quantity) as TotalSold FROM order_meal

                JOIN user_order

                ON order_meal.Order_ID = user_order.Order_ID

                JOIN meal

                ON order_meal.Meal_ID = meal.Meal_ID

                JOIN stall

                ON meal.Stall_ID = stall.Stall_ID

                WHERE order_meal.Meal_ID = '".$ThisMeal_ID."' && order_meal.OM_Status = 'completed' && meal.Stall_ID = '".$Stall_ID."' && MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."'

                GROUP BY order_meal.Meal_ID";

    $result2 = mysqli_query($conn,$query2);

    if (mysqli_num_rows($result2) > 0) {

    while($row2 = mysqli_fetch_array($result2)) {

      $chart_data .= "{ Meal_Name:'".$row2['Meal_Name']."', TotalSold:'".$row2["TotalSold"]."'}, ";

      $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
      $color .= '"'.'#'.$rand.'"'.',';

      }

    }

    else {

    $chart_data2 .= "{ Meal_Name:'".$row['Meal_Name']."', TotalSold:'0'}, ";


    }

   }
   $chart_data2 = substr($chart_data2, 0, -2);
   $color = substr($color, 0, -1);

   $chart_data .= $chart_data2;

   ?>

   <div class="container" style="min-width:900px;margin-top:40px;margin-bottom:50px;">
   <h3 align="center">Sales Data in <?php echo $monthname;echo " "; echo $Year;?></h3>
   <br /><br />
   <div id="chart"></div>
  </div>

   </div>

<script>

var $arrColors = [<?php echo $color; ?>];

Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data;?>],
 xkey:'Meal_Name',
 ykeys:['TotalSold'],
 labels:['TotalSold'],
 hideHover: 'auto',
 barColors:['#03a9f4'],
 stacked:true
});
</script>


  </body>
</html>
