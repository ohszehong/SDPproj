<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Purchase History</title>
    <link rel="stylesheet" type="text/css" href="Profile.css">
    <link rel="stylesheet" type="text/css" href="Sales.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


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

      <a href="PurchaseHistory.php" id="link"><div id="user-info-2-link-ph">PURCHASE HISTORY</div></a>

      <a href="TopupHistory.php" id="link"><div id="user-info-2-link-th">TOP-UP HISTORY</div></a>

      <a href="Notifications.php" id="link"><div id="user-info-2-link-notify">NOTIFICATIONS</div></a>












      <?php


      if ($_SESSION['Role'] === "1") {

        echo "<a href='ProfileMeal.php' id='link'><div id='user-info-2-link-meals'>MEALS</div></a>";

        echo "<a href='Sales.php' id='link'><div id='user-info-2-link-sr' style='background-color:#03a9f4;'>SALES REPORT</div></a>";

      }







       ?>









      </div>


      <div class="purchase-history-template">

      <div id="table-title">

      <div style="padding-left:10px;">Product</div>

      <div>Sold</div>

      <div>Date</div>

      <div>Amount (MYR)</div>

      </div>

      <div id="purchase-history-table">


      <div id="table-grid">

      <?php

      $searchStall_ID = "SELECT * FROM stall WHERE User_ID ='".$_SESSION['Username']."'";

      $searchresult = mysqli_query($conn, $searchStall_ID);

      $searcharray = mysqli_fetch_array($searchresult);

      $Stall_ID = $searcharray['Stall_ID'];

      $sql = "SELECT * FROM order_meal

              JOIN user_order

              ON order_meal.Order_ID = user_order.Order_ID

              JOIN meal

              ON order_meal.Meal_ID = meal.Meal_ID

              JOIN stall

              ON meal.Stall_ID = stall.Stall_ID

              WHERE stall.Stall_ID = '".$Stall_ID."' && OM_Status = 'completed'

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

      $searchStall_ID = "SELECT * FROM stall WHERE User_ID ='".$_SESSION['Username']."'";

      $searchresult = mysqli_query($conn, $searchStall_ID);

      $searcharray = mysqli_fetch_array($searchresult);

      $Stall_ID = $searcharray['Stall_ID'];

      $sql = "SELECT SUM(OM_Price) as TotalPrice FROM order_meal

              JOIN meal

              ON meal.Meal_ID =  order_meal.Meal_ID

              JOIN stall

              ON stall.Stall_ID = meal.Stall_ID

              WHERE meal.Stall_ID = '".$Stall_ID."' && OM_Status = 'completed'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_array($result);

      if (mysqli_num_rows($result) > 0) {
        echo "YOU HAVE EARNED A TOTAL(FLAT) OF <p style='color:white;display:inline-block;'>MYR ".number_format($rows['TotalPrice'],2)."</p> in APU's cafeteria";
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

      $searchStall_ID = "SELECT * FROM stall WHERE User_ID ='".$_SESSION['Username']."'";

      $searchresult = mysqli_query($conn, $searchStall_ID);

      $searcharray = mysqli_fetch_array($searchresult);

      $Stall_ID = $searcharray['Stall_ID'];

      $sql = "SELECT MONTH(Order_Date) as Month, YEAR(Order_Date) as Year FROM user_order

              JOIN order_meal

              ON order_meal.Order_ID = user_order.Order_ID

              JOIN meal

              ON meal.Meal_ID = order_meal.Meal_ID

              WHERE Stall_ID ='".$Stall_ID."' GROUP BY Month,Year ORDER BY Year DESC,Month DESC";

      $result = mysqli_query($conn, $sql);


      if(mysqli_num_rows($result) > 0) {

      while($rows = mysqli_fetch_array($result)) {

      $Thisyear = $rows['Year'];

      $Thismonth = $rows['Month'];

      $earnpermonth = "SELECT SUM(OM_Price) as EarnPerMonth from order_meal

                        JOIN meal

                        ON order_meal.Meal_ID = meal.Meal_ID

                        JOIN stall

                        ON stall.Stall_ID = meal.Stall_ID

                        JOIN user_order

                        ON order_meal.Order_ID = user_order.Order_ID

                        WHERE meal.Stall_ID = '".$Stall_ID."' && order_meal.OM_Status = 'completed' && MONTH(Order_Date) = '".$Thismonth."' && YEAR(Order_Date) = '".$Thisyear."'

                        GROUP BY order_meal.Meal_ID

                        ORDER BY user_order.Order_Date";

      $earnpermonthresult = mysqli_query($conn, $earnpermonth);

      $earnpermontharray = mysqli_fetch_array($earnpermonthresult);

      $monthname2 = date("F", mktime(0, 0, 0, $Thismonth, 10));

      $getmonth = date('m');
      $getyear = date('Y');

      echo "<div id ='history-grid'>";

      echo "<div id='history-title'>

            <div id='blue-bars' style='background-color:#03a9f4;'></div>

            <div id='history-desc'>

            <p style='display:inline-block;padding:0;margin:0;margin-top:5px;'>You have earned a total of</p> MYR ".number_format($earnpermontharray['EarnPerMonth'],2)." <br> in ".$monthname2." ".$Thisyear."

            </div>";

     if ($Thismonth == $getmonth && $Thisyear == $getyear) {

       echo "<input type='hidden' id='this-month' name='this-month' value='".$Thismonth."'>";

       echo "<input type='hidden' id='this-year' name='this-year' value='".$Thisyear."'>";

       echo "<div id='print-btn-2'>Still calculating...</div>";

     }

     else if ($Thismonth != $getmonth && $Thisyear != $getyear) {

      echo "<form action='SalesReport.php'>

            <input type='hidden' id='this-stall-id' name='this-stall-id' value='".$Stall_ID."'>

            <input type='hidden' id='this-month' name='this-month' value='".$Thismonth."'>

            <input type='hidden' id='this-year' name='this-year' value='".$Thisyear."'>

            <div id='print-btn'><input type='submit' id='print-submit' name='print-submit' value='PRINT'></div>


            </form>";

    }

    else {

      echo "<form action='SalesReport.php'>

            <input type='hidden' id='this-stall-id' name='this-stall-id' value='".$Stall_ID."'>

            <input type='hidden' id='this-month' name='this-month' value='".$Thismonth."'>

            <input type='hidden' id='this-year' name='this-year' value='".$Thisyear."'>

            <div id='print-btn'><input type='submit' id='print-submit' name='print-submit' value='PRINT'></div>


            </form>";

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
