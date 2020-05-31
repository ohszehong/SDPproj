<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Revenue Report</title>
    <link rel="stylesheet" type="text/css" href="RevenueReport.css">
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

    $Month = $_GET['this-month'];

    $Year = $_GET['this-year'];

    $No = 1;

    $monthname = date("F", mktime(0, 0, 0, $Month, 10));

    echo "<div id='report-title'>MONTHLY REVENUE REPORT OF EACH STALL</div>";

    echo "<div id='monthyear-name'>".$monthname." ".$Year."</div>";

    echo "<div id='report-header-grid'>

          <div id='header'>No.</div>

          <div id='header'>Stall ID</div>

          <div id='header'>Stall Name</div>

          <div id='header'>Total Revenue (MYR)</div>

          </div>";


    $allstall = "SELECT * FROM stall";

    $allstallresult = mysqli_query($conn, $allstall);

    echo "<div id='report-grid'>";


          while ($allstallarray = mysqli_fetch_array($allstallresult)) {

            $Stall_ID = $allstallarray['Stall_ID'];

          echo  "<div id='report-data'>
                 ".$No."
                 </div>

                 <div id='report-data'>
                 ".$allstallarray['Stall_ID']."
                 </div>

                 <div id='report-data'>
                 ".$allstallarray['Stall_Name']."
                 </div>";

                 $sql2 = "SELECT * , SUM(OM_Price) as TotalRevenue FROM order_meal

                          JOIN user_order

                          ON user_order.Order_ID = order_meal.Order_ID

                          JOIN meal

                          ON order_meal.Meal_ID = meal.Meal_ID

                          JOIN stall

                          ON stall.Stall_ID = meal.Stall_ID

                          WHERE meal.Stall_ID = '".$Stall_ID."' && MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."' && order_meal.OM_Status = 'completed'

                          GROUP BY stall.Stall_ID

                          ORDER BY TotalRevenue DESC";


                 $result2 = mysqli_query($conn, $sql2);

                 $rows2 = mysqli_fetch_array($result2);

                 if (mysqli_num_rows($result2) > 0) {

                    echo "<div id='report-data'>

                          ".$rows2['TotalRevenue']."

                          </div>";


                 }

                 else {

                   echo "<div id='report-data'>

                         0.00

                         </div>";

                 }

                 $No++;

          }

    echo "</div>";

     ?>

     <?php

     $No2 = 1;
     $Noloop = 3;

     echo "<div id='report-header-grid'>

           <div id='header'>No.</div>

           <div id='header'>Stall ID</div>

           <div id='header'>Stall Name</div>

           <div id='header'>Total Revenue (MYR)</div>

           </div>";


                   $sql2 = "SELECT * , SUM(OM_Price) as TotalRevenue FROM order_meal

                            JOIN user_order

                            ON user_order.Order_ID = order_meal.Order_ID

                            JOIN meal

                            ON order_meal.Meal_ID = meal.Meal_ID

                            JOIN stall

                            ON stall.Stall_ID = meal.Stall_ID

                            WHERE MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."' && order_meal.OM_Status = 'completed'

                            GROUP BY stall.Stall_ID

                            ORDER BY TotalRevenue DESC LIMIT 3";

                 $result2 = mysqli_query($conn, $sql2);


    if (mysqli_num_rows($result2) > 0) {


    while ($rows2 = mysqli_fetch_array($result2)) {

       echo "<div id='report-grid'>";


     echo  "<div id='report-data'>
            ".$No2."
            </div>

            <div id='report-data'>
            ".$rows2['Stall_ID']."
            </div>

            <div id='report-data'>
            ".$rows2['Stall_Name']."
            </div>";


          echo      "
                    <div id='report-data'>
                    ".number_format($rows2['TotalRevenue'],2)."
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
                     </div>";


       echo  "</div>";

       $ForNo--;

      }

    }


      echo "<div id='earn-desc'>* Top 3 Revenue of each stall in ".$monthname." ".$Year."</div>";



   ?>

   <?php

   $query = "SELECT * FROM stall";
   $result = mysqli_query($conn, $query);
   $chart_data = '';
   $chart_data2 = '';
   while($row = mysqli_fetch_array($result))
   {

   $ThisStall_ID = $row['Stall_ID'];

   $query2 =   "SELECT * , SUM(OM_Price) as TotalRevenue FROM order_meal

                          JOIN user_order

                          ON user_order.Order_ID = order_meal.Order_ID

                          JOIN meal

                          ON order_meal.Meal_ID = meal.Meal_ID

                          JOIN stall

                          ON stall.Stall_ID = meal.Stall_ID

                          WHERE meal.Stall_ID = '".$ThisStall_ID."' && MONTH(user_order.Order_Date) = '".$Month."' && YEAR(user_order.Order_Date) = '".$Year."' && order_meal.OM_Status = 'completed'

                          GROUP BY stall.Stall_ID";

    $result2 = mysqli_query($conn,$query2);

    if (mysqli_num_rows($result2) > 0) {

    while($row2 = mysqli_fetch_array($result2)) {

      $chart_data .= "{ Stall_Name:'".$row2['Stall_Name']."', TotalRevenue:'".$row2["TotalRevenue"]."'}, ";

      //$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
      //$color .= '"'.'#'.$rand.'"'.',';
      //not used , random color generators

      }

    }

    else {

    $chart_data2 .= "{ Stall_Name:'".$row['Stall_Name']."', TotalSold:'0'}, ";


    }

   }
   $chart_data2 = substr($chart_data2, 0, -2);

  //$color = substr($color, 0, -1);
  // not used , also for random color generators

   $chart_data .= $chart_data2;

   ?>

   <div class="container" style="min-width:900px;margin-top:40px;margin-bottom:50px;">
   <h3 align="center">Revenue Data in <?php echo $monthname;echo " "; echo $Year;?></h3>
   <br /><br />
   <div id="chart"></div>
  </div>

   </div>

<script>

Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data;?>],
 xkey:'Stall_Name',
 ykeys:['TotalRevenue'],
 labels:['TotalRevenue(MYR)'],
 hideHover: 'auto',
 barColors:['#03a9f4'],
 stacked:true
});
</script>



   </div>

  </body>
</html>
