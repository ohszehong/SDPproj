<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $User_ID = $_SESSION['Username'];

    $date = date('Y-m-d');

    $Report_Reason = mysqli_real_escape_string($conn,$_POST['report-title']);

    $Report_Description = mysqli_real_escape_string($conn,$_POST['report-desc']);

    $sql = "INSERT INTO report

            (User_ID,Report_Reason,Report_Text,Report_Date)

            VALUES

            ('".$User_ID."','".$Report_Reason."','".$Report_Description."','".$date."')";


    $result = mysqli_query($conn,$sql);

    echo "<script>alert('Feedback sent Successfully!')</script>;";
    echo "<script>window.location.href = 'MainpageAll.php'</script>;";


  ?>
