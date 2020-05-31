<?php

session_start();
require 'conn.php';

 ?>

 <?php

  $OM_ID = $_POST['Omid'];

  $sql = "DELETE FROM order_meal WHERE OM_ID = '".$OM_ID."'";

  $result = mysqli_query($conn, $sql);

  $OrderID = $_POST['OrderID'];

  $recountTotal = "SELECT SUM(OM_Price) as Total_Price FROM order_meal WHERE Order_ID ='".$OrderID."'";

  $recountresult = mysqli_query($conn, $recountTotal);

  $recountarray = mysqli_fetch_array($recountresult);

  $NewTotalPrice = $recountarray['Total_Price'];

  $UpdateTotalPrice = "UPDATE user_order SET Order_Price ='".$NewTotalPrice."' WHERE Order_ID = '".$OrderID."'";

  $Updateresult = mysqli_query($conn, $UpdateTotalPrice);

  $sql = "SELECT * FROM user_order WHERE User_ID = '".$_SESSION['Username']."' && Order_Status = 'active'";

  $result = mysqli_query($conn, $sql);

  $rows = mysqli_fetch_array($result);

  $Order_ID = $rows['Order_ID'];

  $sql2 = "SELECT * FROM order_meal
           JOIN meal
           ON order_meal.Meal_ID = meal.Meal_ID
           WHERE Order_ID = '".$Order_ID."'";

  $result2 = mysqli_query($conn, $sql2);

  if (mysqli_num_rows($result2) > 0) {

  echo  "<div id='cart-info'>";

  while ($rows2 = mysqli_fetch_array($result2)) {

  echo "

  <input type='hidden' id='om-id' name='Omid' value='".$rows2['OM_ID']."'>

   <div id='cart-image'>
   <img src='".$rows2['Meal_Image']."'>
   </div>

   <div id='cart-desc'>
      <div id='close-btn'>
      <img src='SDP materials/x-mark.png'>
      </div>
     <p id='meal-title'>".$rows2['Meal_Name']."</p>
     <div id='meal-desc'>
    ".$rows2['Meal_Description']."
     </div>

    <div id='meal-quantity'>Quantity:".$rows2['OM_Quantity']."</div>
     <div id='meal-price'>TOTAL:RM".$rows2['OM_Price']."</div>

   </div>


  ";


}

echo "</div>";


$sql3 = "SELECT * FROM user_order WHERE Order_ID = '".$Order_ID."'";

$result3 = mysqli_query($conn, $sql3);

$rows3 = mysqli_fetch_array($result3);

$sql4 = "SELECT SUM(OM_Quantity) as Total_Items FROM order_meal WHERE Order_ID = '".$Order_ID."'";

$result4 = mysqli_query($conn, $sql4);

$rows4 = mysqli_fetch_array($result4);

$Order_Price = number_format($rows3['Order_Price'],2);

echo "<div id='cart-price'>

      <input type='hidden' id='order-id' name='OrderID' value='".$Order_ID."'>

      <div id='cart-price-title'>Order Summary</div>

      <div id='cart-price-desc'>

      <input type='hidden' id='total' name='total' value='".$rows3['Order_Price']."'>

      Total (".$rows4['Total_Items']." items) <p id='total-price'>RM".$Order_Price."</p>

      </div>

      <div id='gst'>GST 0%</div>

      <div id='purchase'>Purchase</div>


      </div>";





}

else {

  echo "

        <div id='empty-cart'>
      </div>
      ";



      echo "<div id='cart-price'>

            <div id='cart-price-title'>Order Summary</div>

            <div id='cart-price-desc'>



            </div>

            <div id='gst'>GST 0%</div>

            <br>


            <div id='purchase' style='cursor:not-allowed;'>Purchase</div>


            </div>";




}


  ?>
