<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Purchase History</title>
    <link rel="stylesheet" type="text/css" href="Profile.css">


    <style>

    .purchase-history-template {
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: 0.1fr 0.8fr 0.1fr 1fr;
      position: relative;
      height: 96%;
      width: 100%;
      color: white;
    }

    #purchase-history-table {
      max-height: 550px;
      overflow-y: auto;
    }

    #table-grid {
      display: grid;
      grid-template-columns: 3fr 0.8fr 0.8fr 0.8fr;
      grid-auto-rows: 30px;
      position: relative;
      height: 100%;
      width: 100%;
      border-bottom:1px solid grey;
      max-height: 550px;
      overflow-y: auto;
    }

    #table-title {
      display: grid;
      grid-template-columns: 3fr 0.8fr 0.8fr 0.8fr;
      width: 100%;
      position: relative;
      font-size: 20px;
      padding-top: 15px;
      color:white;
      padding-left: 5px;
      text-decoration: underline;
    }

    #table-data {
      color: white;
      font-size: 18px;
      padding-left: 5px;
    }

    #history-grid {
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: 0.4fr auto;
      max-height: 250px;
      width: 95%;
      margin-left: 15px;
      overflow-y: auto;
      margin-top: 25px;
      min-height: 150px;
    }


    #purchase-history-bars {
      display: grid;
      grid-template-columns: 1fr;
      grid-template-rows: 0.2fr 2fr;
      width: 100%;
      height: 100%;
    }

    #monthlybasis {
      font-size: 20px;
      padding-top: 10px;
      padding-left: 15px;
    }

    #history-title {
      display: grid;
      grid-template-columns: 0.01fr 1.5fr;
      width: 100%;
      height: 50px;
    }

    #history-details {
      display: grid;
      grid-template-columns: 1fr;
      grid-auto-rows: 50px;
    }

    #history-desc {
      padding-top: 5px;
      padding-left: 5px;
      font-size: 15px;
    }

    #bars-details {
      max-height: 550px;
      overflow-y: auto;
    }

    #purchase-history-date {
      display: inline-block;
      width: 700px;
      height: 50px;
      background-color: black;
      font-size: 20px;
      color: white;
    }

    #purchase-history-data {
      display: inline-block;
      width: 150px;
      height: 50px;
      font-size: 20px;
      padding-top: 10px;

    }

    #purchase-history-amount {
      display: inline-block;
      width: 150px;
      height: 50px;

    }

    #table-grid::-webkit-scrollbar {
    width: 5px;
    }

    #table-grid::-webkit-scrollbar-thumb {
      background: #666;
      border-radius: 20px;
    }

    #totalpurchase {
      padding-left: 15px;
      padding-top: 14px;
      font-size: 18px;
      color: grey;
    }

    #history-bars {
      background-color: black;
      border-radius: 10px;
      margin-top: 8px;
      border: 1.5px solid grey;
      padding-left: 10px;
      font-size: 18px;
      padding-top: 8px;
    }

    #bars-details::-webkit-scrollbar {
    width: 5px;
    }

    #bars-details::-webkit-scrollbar-thumb {
      background: #666;
      border-radius: 20px;
    }

    #history-grid::-webkit-scrollbar {
    width: 5px;
    }

    #history-grid::-webkit-scrollbar-thumb {
      background: #666;
      border-radius: 20px;
    }

    </style>


  </head>
  <body>

    <?php
    require "navbar.php";
    ?>

    <div class="wrapper">


      <div class="profile-template">

      <div id="user-info-1">

      <div class='ProfilePicture'>

        <form id='ProfileUpdate' action='ProfilePicUpdate.php' method='post' enctype='multipart/form-data'>
        <label class='UpdatePic'>
        <input type="file" name='ProfilePic' required='required' onchange='this.form.submit();' id="choosefile">
        </label>
        </form>

      <?php

      $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      $profilepic = $rows['User_Image'];

      if ($profilepic == NULL) {
        echo "<img src='SDP materials/user.png'>";
      }
      else {
        echo "<img src='".$profilepic."'>";
      }



      ?>




      </div>

      <div id="user-name">

      <?php

      $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      echo $rows['User_LN'];
      echo "&nbsp;";
      echo $rows['User_FN'];




       ?>


      </div>


      <div id="user-details">

        <?php

        $sql = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

        $result = mysqli_query($conn, $sql);

        $rows = mysqli_fetch_array($result);



        echo "GENDER:";
        echo "&nbsp;";

        if ($rows['User_Gender'] == "M") {

          echo "MALE";

        }
        elseif ($rows['User_Gender'] == "F") {

          echo "FEMALE";

        }

        echo "<br>";
        echo "<br>";

        echo "EMAIL:";
        echo "&nbsp;";
        echo $rows['User_Email'];

        echo "<br>";
        echo "<br>";

        echo "PHONE NO:";
        echo "&nbsp;";
        echo  $rows['User_Phone'];



         ?>





      </div>


      <div id="user-balance">

      <?php


      echo "BALANCE:";
      echo "&nbsp;";
      echo "MYR";
      echo "&nbsp;";

      echo $rows['User_Balance'];




       ?>

       <a href="Topupform.php" id="link"><div id="topup-btn">

       TOP UP

       </div></a>






      </div>


      <div id="stall-info">

      <?php

      $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      $Contract = $rows['Stall_Contract'];

      if ($_SESSION['Role'] === "1") {



        echo "<u>STALL INFORMATION</u>";

        echo "<br><br>";

        echo "STALL NAME:";

        echo "&nbsp;";

        echo $rows['Stall_Name'];

        echo "&nbsp;&nbsp;&nbsp;";

        echo "<a href='UpdateStallform.php' id='link'><span id='edit-stall'>edit <img src='SDP materials/edit.png'></span></a>";

        echo "<br><br>";

        echo "CONTRACT until:";

        echo "<br>";

        list($year , $month , $date) = explode("-",$Contract);

        $monthname = date("F", mktime(0, 0, 0, $month, 10));


        echo $year;

        echo "&nbsp;";

        echo $monthname;

        echo "&nbsp";

        echo $date;

        echo "<br>";

        echo "<div id='stall-image'>";


        echo "<form id='StallUpdate' action='StallPicUpdate.php' method='post' enctype='multipart/form-data'>
              <label class='UpdateStall'>
              <input type='file' name='StallPic' required='required' onchange='this.form.submit();' id='choosefile'>
              </label>
              </form>";


              $sql = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

              $result = mysqli_query($conn, $sql);

              $rows = mysqli_fetch_array($result);

              $stallpic = $rows['Stall_Image'];

              if ($stallpic == NULL) {
                echo "<img src='SDP materials/no-image(stall).png'>";
              }
              else {
                echo "<img src='".$stallpic."'>";
              }



       echo "</div>";



      }





       ?>




      </div>






      <div class="bottom-btn">

      <a href="UpdateAccountform.php" id="link"><div id="updateacc-btn">

        UPDATE ACCOUNT

      </div></a>

      <a href="ChangePasswordsform.php" id="link"><div id="changepw-btn">

        CHANGE PASSWORDS

      </div></a>





      </div>



      </div>


      <div id="user-info-2">

      <div id="user-info-2-links">

      <a href="PurchaseHistory.php" id="link"><div id="user-info-2-link-ph" style="background-color:#03a0f4;">PURCHASE HISTORY</div></a>

      <a href="TopupHistory.php" id="link"><div id="user-info-2-link-th">TOP-UP HISTORY</div></a>

      <a href="Notifications.php" id="link"><div id="user-info-2-link-notify">NOTIFICATIONS</div></a>












      <?php


      if ($_SESSION['Role'] === "1") {

        echo "<a href='ProfileMeal.php' id='link'><div id='user-info-2-link-meals'>MEALS</div></a>";

        echo "<a href='Sales.php' id='link'><div id='user-info-2-link-sr'>SALES REPORT</div></a>";

      }







       ?>









      </div>


      <div class="purchase-history-template">

      <div id="table-title">

      <div style="padding-left:10px;">Purchase History</div>

      <div>Quantity</div>

      <div>Date</div>

      <div>Amount (MYR)</div>

      </div>

      <div id="purchase-history-table">


      <div id="table-grid">

      <?php

      $sql = "SELECT * FROM order_meal

              JOIN user_order

              ON order_meal.Order_ID = user_order.Order_ID

              JOIN meal

              ON order_meal.Meal_ID = meal.Meal_ID

              WHERE user_order.User_ID ='".$_SESSION['Username']."' && OM_Status = 'completed'

              ORDER BY user_order.Order_Date DESC";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {

      while ($rows = mysqli_fetch_array($result)) {

        echo "

        <div id='table-data' style='padding-left:15px;'>".$rows['Meal_Name']."</div>

        <div id='table-data'>".$rows['OM_Quantity']."</div>

        <div id='table-data'>".$rows['Order_Date']."</div>

        <div id='table-data'>".number_format($rows['OM_Price'],2)."</div>

        ";


      }
      }





      ?>

      </div>


      </div>


      <div id="totalpurchase">

      <?php

      $sql = "SELECT SUM(Order_Price) as TotalPrice FROM user_order WHERE User_ID ='".$_SESSION['Username']."' && Order_Status = 'passive'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      if (mysqli_num_rows($result) > 0) {
        echo "YOU HAVE SPENT A TOTAL OF <p style='color:white;display:inline-block;'>MYR ".number_format($rows['TotalPrice'],2)."</p> in APU's cafeteria";
      }
      else {
        echo "YOU HAVE SPENT A TOTAL OF <p style='color:white;display:inline-block;'>MYR 0.00</p> in APU's cafeteria";
      }

      ?>



      </div>


      <div id="purchase-history-bars">
      <div id="monthlybasis" style="text-decoration:underline;">MONTHLY BASIS</div>


      <div id="bars-details">

      <?php

      $sql = "SELECT MONTH(Order_Date) as Month, YEAR(Order_Date) as Year FROM user_order WHERE User_ID ='".$_SESSION['Username']."' GROUP BY Month,Year ORDER BY Year DESC,Month DESC";

      $result = mysqli_query($conn, $sql);


      if(mysqli_num_rows($result) > 0) {

      while($rows = mysqli_fetch_array($result)) {

      $Thisyear = $rows['Year'];

      $Thismonth = $rows['Month'];

      $spentpermonth = "SELECT SUM(Order_Price) as SpentPerMonth from user_order WHERE User_ID='".$_SESSION['Username']."' && Order_Status = 'passive' && MONTH(Order_Date) = '".$Thismonth."' && YEAR(Order_Date) = '".$Thisyear."'

                        ORDER BY Order_Date";

      $spentpermonthresult = mysqli_query($conn, $spentpermonth);

      $spentpermontharray = mysqli_fetch_array($spentpermonthresult);

      $monthname2 = date("F", mktime(0, 0, 0, $Thismonth, 10));

      echo "<div id ='history-grid'>";

      echo "<div id='history-title'>

            <div id='blue-bars' style='background-color:#03a9f4;'></div>

            <div id='history-desc'>

            <p style='display:inline-block;padding:0;margin:0;margin-top:5px;'>You have spent</p> MYR ".number_format($spentpermontharray['SpentPerMonth'],2)." <br> in ".$monthname2." ".$Thisyear."

            </div>";

      echo "</div>";

      echo "<div id='history-details'>";

      $sql2 = "SELECT * FROM order_meal

               JOIN user_order

               ON order_meal.Order_ID = user_order.Order_ID

               JOIN meal

               ON order_meal.Meal_ID = meal.Meal_ID

               WHERE user_order.User_ID ='".$_SESSION['Username']."' && order_meal.OM_Status = 'completed'

               ORDER BY user_order.Order_Date DESC";

      $result2 = mysqli_query($conn, $sql2);

      $sql3 = "SELECT MONTH(Order_Date) as Month2, YEAR(Order_Date) as Year2 FROM user_order

               JOIN order_meal

               ON order_meal.Order_ID = user_order.Order_ID

               WHERE User_ID ='".$_SESSION['Username']."' && order_meal.OM_Status = 'completed'

               ORDER BY user_order.Order_Date DESC";

      $result3 = mysqli_query($conn, $sql3);

      while (($rows2 = mysqli_fetch_array($result2)) && ($rows3 = mysqli_fetch_array($result3))) {


      if ($rows3['Month2'] == $Thismonth && $rows3['Year2'] == $Thisyear) {


          echo "

                <div id='history-bars'>

                 ".$rows2['Meal_Name']." x ".$rows2['OM_Quantity']." <p style='display:inline-block;float:right;margin-right:10px;'>MYR ".number_format($rows2['OM_Price'],2)."</p>

                </div> ";




      }


    }

    echo "</div>";
    echo "</div>";

    }

    }



      ?>







      </div>


      </div>

      </div>




      </div>


      </div>



    </div>





  </body>
</html>
