<?php

  session_start();
  require "conn.php";

 ?>

 <?php

  $Stall_ID = $_POST['stall-id'];


  $Renew_Date = date_create($_POST['renew-date']);
  $Renew_Date_Format = date_format($Renew_Date,"Y-m-d");



  //maybe will add some improvements later

  $updatecontract = "UPDATE stall

                     SET Stall_Contract = '".$Renew_Date_Format."'

                     WHERE Stall_ID = '".$Stall_ID."'";


  $resultupdate = mysqli_query($conn, $updatecontract);

  echo "<script>window.history.go(-1);</script>";

  ?>
