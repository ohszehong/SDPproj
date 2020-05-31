<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $Topup_Total = $_POST['topuptotal'];

    $TopupDate = date("Y/m/d");

    $topuphistory = "INSERT INTO topup (User_ID,Topup_Amount,Topup_Date)

                      VALUES

                      ('".$_SESSION['Username']."','".$Topup_Total."','".$TopupDate."')";

    $writehistory = mysqli_query($conn, $topuphistory);

    $sql = "SELECT User_Balance FROM user WHERE User_ID = '".$_SESSION['Username']."'";

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_fetch_array($result);

    $CurrentBalance = $rows['User_Balance'];

    $TopupResult = $Topup_Total + $CurrentBalance;

    $update = "UPDATE user SET User_Balance = '".$TopupResult."' WHERE User_ID = '".$_SESSION['Username']."'";

    $updateresult = mysqli_query($conn, $update);

    echo "<script>alert('Top up Successfully!')</script>;";
    echo "<script>window.location.href = 'PurchaseHistory.php'</script>;";


 ?>
