<?php

  session_start();
  require "conn.php";

 ?>


 <?php

    $Meal_ID = $_POST['meal-id'];

    $Meal_Name = $_POST['meal-name'];

    $Meal_Price = $_POST['meal-price'];

    $Meal_Category_1 = $_POST['meal-category-1'];

    $Meal_Category_2 = $_POST['meal-category-2'];

    $Meal_Discount = $_POST['meal-discount'];

    $Meal_Description = mysqli_real_escape_string($conn, $_POST['meal-desc']);

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


    $sql2 = "UPDATE meal

             SET Meal_Name = '".$Meal_Name."' , Meal_Category_1 = '".$Meal_Category_1."' , Meal_Category_2 = '".$Meal_Category_2."' , Meal_Price = '".$Meal_Price."'

                 , Meal_Description = '".$Meal_Description."' , Meal_Discount = '".$Meal_Discount."' , Meal_Image = '".$target_file."' , Meal_Accept = 'N'

            WHERE Meal_ID = '".$Meal_ID."'";

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
