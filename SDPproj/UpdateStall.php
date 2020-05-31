<?php

  session_start();
  require "conn.php";

 ?>

 <?php

      $Stall_Name = $_POST['stall-name'];
      $Stall_Desc = $_POST['stall-desc'];


      $sql = "SELECT Stall_ID FROM stall WHERE User_ID ='".$_SESSION['Username']."'";

      $result = mysqli_query($conn,$sql);

      $rows = mysqli_fetch_array($result);

      $Stall_ID = $rows['Stall_ID'];

      $sql2 = "UPDATE stall

               SET Stall_Name = '".$Stall_Name."',Stall_Description = '".$Stall_Desc."'

               WHERE Stall_ID = '".$Stall_ID."'";

      $result2 = mysqli_query($conn,$sql2);

      echo "<script>alert('Update Succesfully!');</script>";
      echo "<script>window.location.href = 'PurchaseHistory.php';</script>";

      mysqli_close($conn);

  ?>
