<?php

session_start();
session_write_close();

include "conn.php";


 ?>

 <?php

 if (isset($_POST['Accept'])) {

   $sql = "UPDATE meal
           SET Meal_Accept = 'Y'
           WHERE Meal_ID = '".$_POST['MealID']."'";

           if(!mysqli_query($conn,$sql))
           {
           die('Error:'.mysqli_error($conn));
           }

           echo'<script>alert("Request Accepted!");
           window.location.href = "ImageCheck.php";
           </script>';

 }

 if(isset($_POST['Reject'])) {

   $sql = "UPDATE meal
           SET Meal_Accept = 'C'
           WHERE Meal_ID = '".$_POST['MealID']."'";

           if(!mysqli_query($conn,$sql))
           {
           die('Error:'.mysqli_error($conn));
           }

           echo'<script>alert("Request Rejected!");
           window.location.href = "ImageCheck.php";
           </script>';

 }







  ?>
