<?php

  session_start();
  require "conn.php";

 ?>

 <?php


    $OM_ID = $_POST['Omid'];

    $deletenotification2 = "UPDATE order_meal

                            SET OM_Notify = 'N'

                            WHERE OM_ID = '".$OM_ID."'";

    $resultdelete2 = mysqli_query($conn, $deletenotification2);


  echo  "<div id='user-info-2-links'>

        <a href='' id='link'><div id='user-info-2-link-ph'>PURCHASE HISTORY</div></a>

        <a href='' id='link'><div id='user-info-2-link-th'>TOP-UP HISTORY</div></a>";

    ?>

    <?php


    echo  "<a href='Notifications.php' id='link'><div id='user-info-2-link-notify' style='background-color:#03a9f4;'>NOTIFICATIONS";

    $sql = "SELECT * FROM order_meal

           JOIN user_order

           ON order_meal.Order_ID = user_order.Order_ID

           WHERE User_ID = '".$_SESSION['Username']."' && OM_Notify = 'Y'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
     echo  "<p style='display:inline-block;color:red;'>&nbsp;(!)</p>";
    }
    else {
     echo "";
    }


    echo  "</div></a>";


    ?>


    <?php


    if ($_SESSION['Role'] === "1") {

      echo "<a href='ProfileMeal.php' id='link'><div id='user-info-2-link-meals'>MEALS</div></a>";

      echo "<a href='' id='link'><div id='user-info-2-link-sr'>SALES REPORT</div></a>";

    }


     ?>


    </div>


    <div class="Notifications-template" id='notify-board'>

    <?php

    $sql2 = "SELECT * FROM order_meal

          JOIN user_order

          ON order_meal.Order_ID = user_order.Order_ID

          JOIN meal

          ON order_meal.Meal_ID = meal.Meal_ID

          WHERE user_order.User_ID = '".$_SESSION['Username']."' && order_meal.OM_Notify = 'Y'

          ORDER BY order_meal.OM_ID DESC";

    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2) > 0) {

    while ($rows2 = mysqli_fetch_array($result2)) {

      if ($rows2['OM_Status'] == 'pending') {
        echo "<div id='current-notification'>

        <input type='hidden' id='om-id' name='Omid' value='".$rows2['OM_ID']."'>

        <div id='delete-notification'>

        <img src='SDP materials/x-mark.png'>

        </div>

        <div id='notification-desc'>

        YOUR ORDER IS WAITING TO BE ACCEPTED. (".$rows2['Meal_Name']." Quantity: ".$rows2['OM_Quantity'].")

        </div>

        <div id='date'>
        ".$rows2['Order_Date']."
        </div>



        </div>";
      }



    if ($rows2['OM_Status'] == 'accepted') {
      echo "<div id='current-notification'>

      <input type='hidden' id='om-id' name='Omid' value='".$rows2['OM_ID']."'>

      <div id='delete-notification'>

      <img src='SDP materials/x-mark.png'>

      </div>

      <div id='notification-desc'>

      YOUR ORDER IS ACCEPTED (".$rows2['Meal_Name']." Quantity: ".$rows2['OM_Quantity'].")

      </div>

      <div id='date'>
      ".$rows2['Order_Date']."
      </div>



      </div>";
    }



    if ($rows2['OM_Status'] == 'completed') {
      echo "<div id='current-notification'>

      <input type='hidden' id='om-id' name='Omid' value='".$rows2['OM_ID']."'>

      <div id='delete-notification'>

      <img src='SDP materials/x-mark.png'>

      </div>

      <div id='notification-desc'>

      YOUR ORDER IS COMPLETED (ENDED) (".$rows2['Meal_Name']." Quantity: ".$rows2['OM_Quantity'].")

      </div>

      <div id='date'>
      ".$rows2['Order_Date']."
      </div>



      </div>";
    }




    }




    }



    ?>



    </div>
