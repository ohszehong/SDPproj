<?php

  session_start();
  require "conn.php";

 ?>

 <?php

   $NewPasswords = $_POST['new-password'];

   $OldPasswords = $_POST['old-password'];

   if ($NewPasswords == $OldPasswords) {

      echo "<script>alert('Old Passwords and New Passwords are same!')</script>;";
      echo "<script>window.history.go(-1)</script>;";


   }


 else {


    $sql = "UPDATE user

            SET User_Passwords = '".$NewPasswords."'

            WHERE User_ID ='".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);


    echo "<script>alert('Update Successfully!')</script>;";
    echo "<script>window.location.href = 'Profile.php'</script>;";

 }

  ?>
