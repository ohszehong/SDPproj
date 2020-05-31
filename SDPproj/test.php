<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>test</title>
  </head>
  <body>

  <?php

  require "navbar.php";


   ?>

    <?php

    $sql = "SELECT * FROM order_meal

            JOIN user_order

            ON order_meal.Order_ID = user_order.Order_ID

            WHERE user_order.User_ID = '".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    $Contract = $rows['Order_Date'];

    list($year , $month , $date) = explode("-",$Contract);

    echo $year;

    echo $month;



     ?>





  </body>
</html>
