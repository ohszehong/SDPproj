<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order Panel</title>

    <link rel="stylesheet" type="text/css" href="OrderPanel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>

    $(document).ready(function() {
      $(document).on('click','#accept-btn',function (e){

         e.preventDefault();

        var Omid = $('#om-id').val();

        $.ajax ({

          type :'POST',
          data :{
                  Omid:Omid
                },
          url  :"AcceptOrder.php",
          success : function(data){
             $('.order-grid').html(data);
          }

        })

      });

      $(document).on('click','#complete-btn',function (e){

         e.preventDefault();

         var Omid = $('#complete-om-id').val();

         $.ajax ({

           type :'POST',
           data :{
                   Omid:Omid
                 },
           url  :"CompleteOrder.php",
           success : function(data){
              $('.order-grid').html(data);
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

     <div id='title-board'>

     <div id="accept-title">ACCEPT ORDER</div>

     <div id="complete-title">COMPLETE ORDER</div>

    </div>

     <div class="order-grid">

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

            <input type='hidden' id='complete-om-id' name='CompleteOmid' value='".$rows3['OM_ID']."'>

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

      echo "<div id='complete-order'>

            <img src='SDP materials/empty-tray.png'>
            <br>
            <div id='empty-text'>NO ORDER</div>

            </div>";

    }




     ?>


     </div>




</div>


     <a href='MainpageAll.php'><div id='back-btn'>BACK</div></a>





  </body>



</html>
