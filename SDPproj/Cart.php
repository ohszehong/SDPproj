<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Cart.css">

    <script>

    $(document).ready(function() {
    $(document).on('click','#close-btn',function (e){

       e.preventDefault();

      var Omid = $('#om-id').val();
      var OrderID = $('#order-id').val();
      var TotalPrice = $('#total').val();

      $.ajax ({

        type :'POST',
        data :{
                Omid:Omid,
                OrderID:OrderID,
                TotalPrice:TotalPrice
              },
        url  :"DeleteCart.php",
        success : function(data){
           $('.cart-template').html(data);
        }

      })

    });


    $(document).on('click','#purchase',function (e){

       e.preventDefault();

      var OrderID = $('#order-id').val();
      var TotalPrice = $('#total').val();

      $.ajax ({

        type :'POST',
        data :{
                OrderID:OrderID,
                TotalPrice:TotalPrice
              },
        url  :"SendOrder.php",
        success : function(data){
           $('.cart-template').html(data);
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

     <div class="cart-template">

    <?php

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

  echo "

        <input type='hidden' id='order-id' name='OrderID' value='".$Order_ID."'>

        <div id='cart-price'>

        <div id='cart-price-title'>Order Summary</div>

        <div id='cart-price-desc'>

        <input type='hidden' id='total' name='total' value='".$rows3['Order_Price']."'>

        Total (".$rows4['Total_Items']." items) <p id='total-price'>RM".$Order_Price."</p>

        </div>

        <div id='gst'>SST 6%</div>

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

              <div id='gst'>SST 6%</div>

              <br>


              <div id='purchase' style='cursor:not-allowed;pointer-events:none;'>Purchase</div>


              </div>";




}

?>






     </div>
   </div>



   <script>

   function closediv(){
   var x = document.getElementById("send-order-div");
   if (x.style.display === "none") {
     x.style.display = "block";

   } else {
     x.style.display = "none";

   }
 }

   </script>


  </body>
</html>
