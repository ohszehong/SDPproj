<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Selected Meal Page</title>
    <link rel="stylesheet" type="text/css" href="SelectedMeal.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script>

    $(document).ready(function() {
      $(document).on('click','#post-comments',function (e){

         e.preventDefault();

        var MealID = $('#meal-id').val();
        var commenttext = $('textarea#textbox').val();
        var UserID = $('#user-id').val();

        $.ajax ({

          type :'POST',
          data :{
                  UserID:UserID,
                  MealID:MealID,
                  commenttext:commenttext
                },
          url  :"PostComment.php",
          success : function(data){
             $('#selected-meal-comments').html(data);
          }

        })

      });

      $(document).on('click','#add-to-cart-btn',function (e){

         e.preventDefault();

        var MealID = $('#meal-id').val();
        var MealPrice = $('#meal-price').val();
        var MealQuantity = $('#meal-quantity').val();
        var UserID = $('#user-id').val();

        $.ajax ({

          type :'POST',
          data :{
                  UserID:UserID,
                  MealID:MealID,
                  MealPrice:MealPrice,
                  MealQuantity:MealQuantity
                },
          url  :"AddtoCart.php",
          success : function(result){
             $('#info-box').show();
             $('#info-box').html(result);
          }

        })

      });

      $(document).on('click','#delete-comment-btn',function (e){

         e.preventDefault();

        var Comment_ID = $('#comment-id').val();
        var MealID = $('#meal-id').val();
        var commenttext = $('textarea#textbox').val();
        var UserID = $('#user-id').val();

        $.ajax ({

          type :'POST',
          data :{
                  Comment_ID:Comment_ID,
                  UserID:UserID,
                  MealID:MealID,
                  commenttext:commenttext
                },
          url  :"DeleteComment.php",
          success : function(result){
             $('#selected-meal-comments').html(result);
          }

        })

      });

      $(document).on('click','#ban-comment-btn',function (e){

         e.preventDefault();

        var Comment_ID = $('#comment-id').val();
        var MealID = $('#meal-id').val();
        var commenttext = $('textarea#textbox').val();
        var UserID = $('#user-id').val();

        $.ajax ({

          type :'POST',
          data :{
                  Comment_ID:Comment_ID,
                  UserID:UserID,
                  MealID:MealID,
                  commenttext:commenttext
                },
          url  :"BanComment.php",
          success : function(result){
          $('#selected-meal-comments').html(result);
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


     <div class="selected-meal-template">


     <div id="selected-meal-info">











     <?php

     $sql = "SELECT * FROM meal
             JOIN stall
             ON meal.Stall_ID = stall.Stall_ID
             WHERE Meal_ID = '".$_GET['MealID']."' && Meal_Availability = 'Y'";

     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) <= 0) {


       $sql2 = "SELECT * FROM meal
               JOIN stall
               ON meal.Stall_ID = stall.Stall_ID
               WHERE Meal_ID = '".$_GET['MealID']."' && Meal_Availability = 'N'";

       $result2 = mysqli_query($conn, $sql2);


       while ($rows2 = mysqli_fetch_array($result2)) {

         $MealTotalPrice2 = $rows2['Meal_Price']-$rows2['Meal_Discount'];

         echo "<div id='meal-image'><img src='".$rows2['Meal_Image']."'></div>";

         echo "<div id='meal-desc-template'>";

         echo "<p id='meal-title'>".$rows2['Meal_Name']."";

         echo "<p id='meal-desc'>".$rows2['Meal_Description']."</p>";

         echo "<p id='stall-name'>FROM: ".$rows2['Stall_Name']."</p>";


         echo "<p id='meal-category'>".$rows2['Meal_Category_1']." , ".$rows2['Meal_Category_2']."</p>";

         echo "<br>";

         echo "<div id='meal-price-div'>RM".$MealTotalPrice2." (-RM".$rows2['Meal_Discount'].")</div>";

         echo "<input type='hidden' name='meal-price' id='meal-price' value='".$MealTotalPrice2."'>";

         echo "<button id='add-to-cart-btn-2' style='background-color:#DB4141;cursor:not-allowed;'>NOT AVAILABLE</button>";

         echo "<div id='meal-quantity-div'>Quantity: <input type='number' name='MealQuantity' id='meal-quantity' value='1'></div>";


       }

     }

     else {





       while ($rows = mysqli_fetch_array($result)) {

        $MealTotalPrice = $rows['Meal_Price']-$rows['Meal_Discount'];

         echo "<div id='meal-image'><img src='".$rows['Meal_Image']."'></div>";

         echo "<div id='meal-desc-template'>";

         echo "<p id='meal-title'>".$rows['Meal_Name']."";

         echo "<p id='meal-desc'>".$rows['Meal_Description']."</p>";

         echo "<p id='stall-name'>FROM: ".$rows['Stall_Name']."</p>";


         echo "<p id='meal-category'>".$rows['Meal_Category_1']." , ".$rows['Meal_Category_2']."</p>";

         echo "<br>";

         echo "<div id='meal-price-div'>RM".$MealTotalPrice." (-RM".$rows['Meal_Discount'].")</div>";

         echo "<input type='hidden' name='meal-price' id='meal-price' value='".$MealTotalPrice."'>";

         echo "<button id='add-to-cart-btn'>ADD TO CART</button>";

         echo "<div id='meal-quantity-div-2'>Quantity: <input type='number' name='MealQuantity' id='meal-quantity' value='1'></div>";



       }
     }


     ?>











   </div>
     </div>





     <div id="selected-meal-comments">


    <?php

    $sql = "SELECT COUNT(Comment_ID) as comment_count
            FROM comment
            WHERE Meal_ID = '".$_GET['MealID']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    $sql2 = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

    $result2 = mysqli_query($conn, $sql2);

    $rows2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT * FROM comment
             JOIN user
             ON comment.User_ID = user.User_ID
             WHERE Meal_ID = '".$_GET['MealID']."'
             ORDER BY Comment_Datetime desc";

    $result3 = mysqli_query($conn, $sql3);


    echo  "<p id='comments-title'>Comments(".$rows['comment_count'].")</p>";

    echo  "<div id=comments>

           <div id='comments-image'>
           <img src='".$rows2['User_Image']."'>
           </div>

           <input type='hidden' name='MealID' id='meal-id' value='".$_GET['MealID']."'>
           <input type='hidden' name='UserID' id='user-id' value='".$rows2['User_ID']."'>
           <div id='comments-text-template'>
           <div id='comments-text'>

           <textarea id='textbox' placeholder='Write comment...'></textarea>
           <input type='submit' id='post-comments' name='post-comments' value='POST'>

           </div>
           </div>";

  echo    "</div>";


  if (mysqli_num_rows($result3) <= 0) {

    echo "<div id='no-comments'>NO COMMENTS</div>";
  }

  else {

    while ($rows3 = mysqli_fetch_array($result3)) {

    if ($rows3['Comment_Ban'] == 'N') {

    echo "
    <div id='comments'>

    <div id='comments-image'>
      <img src='".$rows3['User_Image']."'>
     </div>

     <input type='hidden' name='comment-id' id='comment-id' value='".$rows3['Comment_ID']."'>
     <div id='comments-text-template'>
     <div id='comments-text-2'>

     <p id='user-name'>".$rows3['User_FN']."  ".$rows3['User_LN']."</p>";

     if ($rows3['User_ID'] == $_SESSION['Username']) {
         echo "<div id='delete-comment-btn'>delete comment</div>";
         }

    if ($_SESSION['Role'] == '3') {
        echo "<div id='ban-comment-btn'>BAN</div>";
    }

echo "

     <p id='just-text'>".$rows3['Comment_Text']."</p>

     <div id='datetime'>".$rows3['Comment_Datetime']."</div>";


echo  "</div>";

echo "</div>";

echo "</div>
     ";


   }

   else {

      echo "<div id='banned-comment'>This comment has been banned.</div>";

   }

   }
}


     ?>










     </div>

     </div>


     <div id='info-box'>
     <img src='SDP materials/verified.png'>

     added to cart.

     <div id='close' onclick='closediv()'>

     <img src='SDP materials/cancel.png'>

     </div>

     </div>

     </div>

     <script>

     function closediv(){
     var x = document.getElementById("info-box");
     if (x.style.display === "none") {
       x.style.display = "block";

     } else {
       x.style.display = "none";

     }
   }

     </script>


  </body>
</html>
