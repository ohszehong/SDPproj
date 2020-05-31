<?php

  session_start();

  if(isset($_SESSION['Username']) === false) {

    die("<script>alert('Please login first before proceed to this page');</script>");

    echo "<script>window.location.href='LoginUser.php'</script>";

  }

  session_write_close();
  exit();

 ?>
