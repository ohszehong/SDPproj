<?php

include 'conn.php';

 ?>
 <?php

 $User_ID = $_POST['UserID'];

 $Meal_ID = $_POST['MealID'];

 $Comment_Text = mysqli_real_escape_string($conn, $_POST['commenttext']);

 $Comment_Datetime = date('Y-m-d H:i:s');

 $sql2 =    "SELECT * FROM comment
               JOIN user
               ON comment.User_ID = user.User_ID
               WHERE Meal_ID = '".$Meal_ID."'
               ORDER BY Comment_Datetime DESC";

    $result2 = mysqli_query($conn, $sql2);

    $rows2 = mysqli_fetch_array($result2);


    $sql3 = "SELECT COUNT(Comment_ID) as comment_count
            FROM comment
            WHERE Meal_ID = '".$Meal_ID."'";

    $result3 = mysqli_query($conn, $sql3);

    $rows3 = mysqli_fetch_array($result3);

    echo  "<p id='comments-title'>Comments(".$rows3['comment_count'].")</p>";

        echo  "<div id=comments>

               <div id='comments-image'>
               <img src='".$rows2['User_Image']."'>
               </div>

               <input type='hidden' name='MealID' id='meal-id' value='".$Meal_ID."'>
               <input type='hidden' name='UserID' id='user-id' value='".$rows2['User_ID']."'>
               <div id='comments-text-template'>
               <div id='comments-text'>

               <textarea id='textbox' placeholder='Write comment...'></textarea>
               <input type='submit' id='post-comments' name='post-comments' value='POST'>

               </div>
               </div>

               </div>";


               $sql4 =    "SELECT * FROM comment
                             JOIN user
                             ON comment.User_ID = user.User_ID
                             WHERE Meal_ID = '".$Meal_ID."'
                             ORDER BY Comment_Datetime DESC";

                  $result4 = mysqli_query($conn, $sql4);

                  $rows4 = mysqli_fetch_array($result4);


  if(mysqli_num_rows($result4) > 0){
    while($rows4 = mysqli_fetch_array($result4))
    {

  echo

  "<div id='comments' style='background-color:rgba(51,48,48);'>

    <div id='comments-image'>
      <img src='".$rows4['User_Image']."'>
     </div>

     <div id='comments-text-template'>
     <div id='comments-text-2'>

     ".$rows4['Comment_Text']."

     <div id='datetime'>".$rows4['Comment_Datetime']."</div>
     </div>
     </div>

   </div>

   ";

 }
}

?>
