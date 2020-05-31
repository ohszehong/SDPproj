<?php

  session_start();
  require "conn.php";

 ?>

 <?php


 $OM_ID = $_POST['Omid'];

 $sql = "UPDATE order_meal

         SET OM_Status = 'completed'

         WHERE OM_ID = '".$OM_ID."'";

 $result = mysqli_query($conn, $sql);


  ?>


  <?php

  $sql = "SELECT * FROM user ur

          JOIN stall st

          ON ur.User_ID = st.User_ID

          WHERE ur.User_Role = '".$_SESSION['Role']."' and st.User_ID = '".$_SESSION['Username']."'";

  $result = mysqli_query($conn, $sql);

  $rows = mysqli_fetch_array($result);

  $Stall_ID = $rows['Stall_ID'];


  $sql2 = "SELECT * FROM order_meal

           JOIN meal

           ON order_meal.Meal_ID = meal.Meal_ID

           JOIN user_order

           ON order_meal.Order_ID = user_order.Order_ID

           WHERE Stall_ID = '".$Stall_ID."' && OM_Status = 'pending'

           GROUP BY order_meal.OM_ID DESC";

  $result2 = mysqli_query($conn, $sql2);



  if (mysqli_num_rows($result2) > 0) {

    echo  "<div id='accept-order'>";


    while ($rows2 = mysqli_fetch_array($result2)) {

    echo "

          <div id='accepting-order'>

          <input type='hidden' id='om-id' name='Omid' value='".$rows2['OM_ID']."'>

          <div id='meal-title'>".$rows2['Meal_Name']."</div>

          <div id='order-user-id'>FROM: ".$rows2['User_ID']."</div>

          <div id='meal-price'>MYR".$rows2['OM_Price']."</div>

          <div id='meal-quantity'>Quatity: ".$rows2['OM_Quantity']."</div>

          <div id='order-date'>".$rows2['Order_Date']."</div>

          <div id='accept-btn'>ACCEPT</div>

          </div>

          ";

  }

  echo  "</div>";

  }

  else {

    echo "<div id='accept-order'>

        <img src='SDP materials/empty-tray.png'>
        <br>
        <div id='empty-text'>NO ORDER</div></div>";

  }



  $sql3 = "SELECT * FROM order_meal

           JOIN meal

           ON order_meal.Meal_ID = meal.Meal_ID

           JOIN user_order

           ON order_meal.Order_ID = user_order.Order_ID

           WHERE meal.Stall_ID = '".$Stall_ID."' && order_meal.OM_Status = 'accepted'

           GROUP BY order_meal.OM_ID DESC";

  $result3 = mysqli_query($conn, $sql3);



  if (mysqli_num_rows($result3) > 0) {

  echo  "<div id='complete-order'>";

    while ($rows3 = mysqli_fetch_array($result3)) {

    echo "

          <div id='completing-order'>

          <input type='hidden' id='complete-om-id' name='Omid' value='".$rows3['OM_ID']."'>

          <div id='meal-title'>".$rows3['Meal_Name']."</div>

          <div id='order-user-id'>FROM: ".$rows3['User_ID']."</div>

          <div id='meal-price'>MYR".$rows3['OM_Price']."</div>

          <div id='meal-quantity'>Quatity: ".$rows3['OM_Quantity']."</div>

          <div id='order-date'>".$rows3['Order_Date']."</div>

          <div id='complete-btn'>COMPLETE</div>

          </div>

          ";

  }

  echo "</div>";

  }

  else {

    echo "<div id='accept-order'>

        <img src='SDP materials/empty-tray.png'>
        <br>
        <div id='empty-text'>NO ORDER</div></div>";

  }


   ?>
