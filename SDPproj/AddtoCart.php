<?php

include 'conn.php';

 ?>

 <?php

 if (isset($_POST['UserID'])) {

    $User_ID = $_POST['UserID'];

    $Order_Date = date("Y-m-d");

    $Order_Month = date("m");

    $Meal_ID = $_POST['MealID'];

    $Meal_Price = $_POST['MealPrice'];

    $Meal_Quantity = $_POST['MealQuantity'];

    $Meal_TotalPrice = $Meal_Price * $Meal_Quantity;

  $sql = "SELECT * FROM user_order WHERE User_ID = '".$User_ID."' && Order_Status = 'active'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) <= 0) {

    $sql2 = "INSERT INTO user_order (User_ID, Order_Date, Order_Month, Order_Status, Order_Notify)

             VALUES

             ('$User_ID', '$Order_Date', '$Order_Month', 'active', 'Y')";

    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM user_order WHERE User_ID = '".$User_ID."' && Order_Status = 'active'";

    $result3 = mysqli_query($conn, $sql);

    $rows3 = mysqli_fetch_array($result3);

    $Order_ID = $rows3['Order_ID'];

    $sql4 = "INSERT INTO order_meal (Meal_ID, Order_ID, OM_Price, OM_Quantity, OM_Status, OM_Notify)

             VALUES

             ('$Meal_ID', '$Order_ID', '$Meal_TotalPrice', '$Meal_Quantity', 'in-cart', 'Y')";


    $result4 = mysqli_query($conn, $sql4);

    $sql5 = "SELECT SUM(OM_Price) as Order_TotalPrice
             FROM order_meal
             WHERE Order_ID = '".$Order_ID."'";

    $result5 = mysqli_query($conn, $sql5);

    $rows5 = mysqli_fetch_array($result5);

    $Order_TotalPrice = $rows5['Order_TotalPrice'];

    $sql6 = "UPDATE user_order

             SET Order_Price = '".$Order_TotalPrice."'

             WHERE Order_ID = '".$Order_ID."'

             ";

    $result6 = mysqli_query($conn, $sql6);

    echo "<img src='SDP materials/verified.png'>

         added to cart.

         <div id='close' onclick='closediv()'>

         <img src='SDP materials/cancel.png'>

         </div>";

  }

  else {

    $rows = mysqli_fetch_array($result);

    $Order_ID = $rows['Order_ID'];

    $sql7 = "INSERT INTO order_meal (Meal_ID, Order_ID, OM_Price, OM_Quantity, OM_Status, OM_Notify)

             VALUES

             ('$Meal_ID', '$Order_ID', '$Meal_TotalPrice', '$Meal_Quantity', 'in-cart', 'Y')";

    $result7 = mysqli_query($conn, $sql7);

    $sql8 = "SELECT SUM(OM_Price) as Order_TotalPrice
             FROM order_meal
             WHERE Order_ID = '".$Order_ID."'";

    $result8 = mysqli_query($conn, $sql8);

    $rows8 = mysqli_fetch_array($result8);

    $Order_TotalPrice = $rows8['Order_TotalPrice'];

    $sql9 = "UPDATE user_order

             SET Order_Price = '".$Order_TotalPrice."'

             WHERE Order_ID = '".$Order_ID."'

             ";

    $result9 = mysqli_query($conn, $sql9);

    echo "<img src='SDP materials/verified.png'>

         added to cart.

         <div id='close' onclick='closediv()'>

         <img src='SDP materials/cancel.png'>

         </div>";


  }


}

 ?>
