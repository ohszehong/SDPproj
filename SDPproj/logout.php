<?php
  session_start();

  echo "<script>alert('You already logged out! Thank you ".
  $_SESSION['Username'] ."!')</script>";

  session_destroy();
  session_unset();

  echo "<script>window.location.href='LoginUser.php'</script>";



 ?>
