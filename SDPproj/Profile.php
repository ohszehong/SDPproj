<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="Profile.css">


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

        echo "<a href='' id='link'><span id='edit-stall'>edit <img src='SDP materials/edit.png'></span></a>";

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

        echo "<a href='Sales.php' id='link'><div id='user-info-2-link-sr'>SALES REPORT</div></a>";

      }







       ?>





      </div>






      </div>


      </div>



    </div>





  </body>
</html>
