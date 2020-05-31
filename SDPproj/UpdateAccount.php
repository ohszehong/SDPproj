<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $UserFN = $_POST['firstname'];

    $UserLN = $_POST['lastname'];

    $Email = $_POST['email'];

    $ConfirmEmail = $_POST['confirm-email'];

    $Phonenum = $_POST['phonenum'];


    $sql = "UPDATE user

            SET User_FN ='".$UserFN."',

                User_LN ='".$UserLN."',

                User_Email ='".$Email."',

                User_Phone ='".$Phonenum."'

            WHERE User_ID ='".$_SESSION['Username']."'";


    $result = mysqli_query($conn, $sql);

    echo "<script>alert('Update Successfully!')</script>;";
    echo "<script>window.location.href = 'Profile.php'</script>;";


  ?>
