<?php

  session_start();
  require "conn.php";

 ?>

 <?php

  $Comment_ID = $_POST['Comment_ID'];

  $User_ID = $_POST['UserID'];

  $Meal_ID = $_POST['MealID'];

  $sql = "DELETE FROM comment WHERE Comment_ID = '".$Comment_ID."'";

  $result = mysqli_query($conn, $sql);

?>

<?php

$sql = "SELECT COUNT(Comment_ID) as comment_count
        FROM comment
        WHERE Meal_ID = '".$Meal_ID."'";

$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_array($result);

$sql2 = "SELECT * FROM user WHERE User_ID = '".$_SESSION['Username']."'";

$result2 = mysqli_query($conn, $sql2);

$rows2 = mysqli_fetch_array($result2);

$sql3 = "SELECT * FROM comment
         JOIN user
         ON comment.User_ID = user.User_ID
         WHERE Meal_ID = '".$Meal_ID."'
         ORDER BY Comment_Datetime desc";

$result3 = mysqli_query($conn, $sql3);


echo  "<p id='comments-title'>Comments(".$rows['comment_count'].")</p>";

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
