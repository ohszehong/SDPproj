<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile Notifications</title>
    <link rel="stylesheet" type="text/css" href="Profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>

    .Notifications-template {
      display: grid;
      grid-template-columns: 1fr;
      grid-auto-rows: 150px;
      min-height: 200px;
      max-height: 1200px;
      overflow: auto;

    }

    #current-notification {
      padding-top: 10px;
      padding-left: 15px;
      border-bottom: 1px solid grey;
      font-size: 23px;
      color: white;
      margin-left: 10px;
      margin-right: 10px;
    }

    #delete-notification > img {
      width: 30px;
      height: 30px;
      float: right;
      margin-right: 15px;
      cursor: pointer;
    }

    #notification-desc {
      margin-top: 50px;
      margin-left: 10px;
    }

    #date {
      color: grey;
      font-size: 13px;
      float: right;
      margin-top: 35px;
    }

    .Notifications-template::-webkit-scrollbar {
    width: 5px;
    }

    .Notifications-template::-webkit-scrollbar-thumb {
      background: #666;
      border-radius: 20px;
    }


    </style>

    <script>

    $(document).ready(function() {
    $(document).on('click','#delete-notification',function (e){

       e.preventDefault();

      var Omid = $('#om-id').val();

      $.ajax ({

        type :'POST',
        data :{
                Omid:Omid
              },
        url  :"DeleteNotification.php",
        success : function(data){
           $('#user-info-2').html(data);
        }

      })

    });

});


</script>

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

        <a href="" id="link"><div id="topup-btn">

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

       <a href="" id="link"><div id="updateacc-btn">

         UPDATE ACCOUNT

       </div></a>

       <a href="" id="link"><div id="changepw-btn">

         CHANGE PASSWORDS

       </div></a>





       </div>



       </div>


       <div id="user-info-2">

       <div id="user-info-2-links">

       <a href="PurchaseHistory.php" id="link"><div id="user-info-2-link-ph">PURCHASE HISTORY</div></a>

       <a href="TopupHistory.php" id="link"><div id="user-info-2-link-th">TOP-UP HISTORY</div></a>

       <?php


      echo  "<a href='Notifications.php' id='link'><div id='user-info-2-link-notify' style='background-color:#03a9f4;'>NOTIFICATIONS";

      $sql = "SELECT * FROM order_meal

              JOIN user_order

              ON order_meal.Order_ID = user_order.Order_ID

              WHERE User_ID = '".$_SESSION['Username']."' && OM_Notify = 'Y' && (OM_Status = 'accepted' || OM_Status = 'completed')";

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

         echo "<a href='Sales.php' id='link'><div id='user-info-2-link-sr'>SALES REPORT</div></a>";

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

         <div id='notification-desc' style='color:#DB4141;'>

         YOUR ORDER IS WAITING TO BE ACCEPTED. (PENDING!) (".$rows2['Meal_Name']." Quantity: ".$rows2['OM_Quantity'].")

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

         <div id='notification-desc' style='color:#03a9f4;'>

         YOUR ORDER IS ACCEPTED (READY!) (".$rows2['Meal_Name']." Quantity: ".$rows2['OM_Quantity'].")

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





       </div>


       </div>



     </div>





  </body>
</html>
