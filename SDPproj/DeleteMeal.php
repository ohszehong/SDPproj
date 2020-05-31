<?php

include "conn.php";

 ?>

 <?php

 $sql = "UPDATE meal

         SET Meal_Delete = 'Y'

         WHERE Meal_ID = '".$_POST['MealID']."'";

 $result = mysqli_query($conn, $sql);


 if(mysqli_affected_rows($conn) <= 0)
 {
     echo "<script>alert('Unable to delete data!');";
     die ("window.location.href='ProfileMeal.php';</script>");
 }

     echo "<script>window.location.href='ProfileMeal.php';</script>";

     mysqli_close($conn);

 ?>
