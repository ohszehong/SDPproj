<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $Stall_ID = $_POST['stall-id'];

    $sql = "DELETE FROM stall

            WHERE Stall_ID = '".$Stall_ID."'";

    $result = mysqli_query($conn, $sql);

      echo "<script>window.history.go(-1);</script>";


  ?>
