<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $User_ID = $_POST['username'];

    $User_FN = $_POST['user-fn'];

    $User_LN = $_POST['user-ln'];

    $User_Email = $_POST['user-email'];

    $User_Phone = $_POST['user-phone'];

    $Stall_Name = $_POST['stall-name'];

    $Stall_Desc = $_POST['stall-desc'];

    $Stall_Contract = $_POST['stall-contract'];

    $User_Gender = $_POST['user-gender'];

    $User_DOB = $_POST['user-dob'];


    $checkexist = "SELECT User_ID FROM user WHERE User_ID = '".$User_ID."'";

    $checkresult = mysqli_query($conn, $checkexist);

    if(mysqli_num_rows($checkresult) > 0) {

      echo "<script>alert('User ID Exists!')</script>;";
      echo "<script>window.history.go(-1)</script>;";

    }

    else {

      $insertdata = "INSERT INTO user

                     (User_ID,User_Passwords,User_FN,User_LN,User_DOB,User_Email,User_Gender,User_Phone,User_Role)

                     VALUES

                     ('".$User_ID."','".$User_ID."','".$User_FN."','".$User_LN."','".$User_DOB."','".$User_Email."','".$User_Gender."','".$User_Phone."','1')

                      ";

     $insertresult = mysqli_query($conn, $insertdata);

     $insertdata2 = "INSERT INTO stall

                     (User_ID,Stall_Name,Stall_Contract,Stall_Description)

                     VALUES

                     ('".$User_ID."','".$Stall_Name."','".$Stall_Contract."','".$Stall_Desc."')";

     $insertresult2 = mysqli_query($conn, $insertdata2);

     echo "<script>alert('Stall Added Successfully!')</script>;";
     echo "<script>window.location.href = 'ViewStall.php'</script>;";


    }


  ?>
