<?php

  session_start();

  include "conn.php";

 ?>


 <?php

 $sql1 = "SELECT * FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

 $result1 = mysqli_query($conn, $sql1);


 $rows = mysqli_fetch_array($result1);

 $Stall_ID = $rows['Stall_ID'];

 $MealName = $_POST['meal-name'];
 $MealPrice = $_POST['meal-price'];

 if ($_POST['meal-discount'] == "") {
   $MealDiscount = 0;
 }
 else {
 $MealDiscount = $_POST['meal-discount'];
}

 $MealCategory1 = $_POST['meal-category-1'];
 $MealCategory2 = $_POST['meal-category-2'];

 $MealDescription = mysqli_real_escape_string($conn, $_POST['meal-desc']);

 $name = $_FILES['meal-image']['name'];
 $type = $_FILES['meal-image']['type'];
 $data = mysqli_real_escape_string($conn,file_get_contents($_FILES['meal-image']['tmp_name']));

 $target_dir = "SDP materials/";


 //the basename($_FILES["photo"]["name"]) means to get the basename (e.g. test.docx) //from the file path (e.g. D://images/test.docx)
 $target_file = $target_dir . basename($_FILES["meal-image"]["name"]);

 if (! move_uploaded_file($_FILES["meal-image"]["tmp_name"],$target_file)) {
   echo "<script>alert('Unable to upload photo.Thus, data will not be inserted to database. Please try again!');</script>";
   die("<script>window.history.go(-1);</script>");
 }


 $sql2 = "INSERT INTO meal (Stall_ID, Meal_Name, Meal_Category_1, Meal_Category_2, Meal_Price, Meal_Availability, Meal_Description, Meal_Discount, Meal_Image)

 VALUES

 ('$Stall_ID', '$MealName', '$MealCategory1', '$MealCategory2', '$MealPrice', 'Y', '$MealDescription', '$MealDiscount', '$target_file')";

 if(!mysqli_query($conn,$sql2))
 {
 die('Error:'.mysqli_error($conn));
 }
 else {
   echo "<script>alert('Meal added Successfully!')</script>;";
   echo "<script>window.location.href = 'ProfileMeal.php'</script>;";
 }


 mysqli_close($conn);

  ?>
