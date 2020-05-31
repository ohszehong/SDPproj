<?php

session_start();

 ?>

<?php
require 'conn.php';
?>

<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<div class='header'>
<a href="MainpageAll.php"><span id='logo'><img src='SDP materials/websitelogo.png'></span></a>




<?php


if(isset($_SESSION['Username'])){


  $sql = "SELECT * FROM user
          JOIN stall
          ON user.User_ID = stall.User_ID
          WHERE user.User_Role = '".$_SESSION['Role']."'";

  $result = mysqli_query($conn, $sql);

  $rows = mysqli_fetch_array($result);

  $sqlstallname = "SELECT Stall_Name FROM stall WHERE User_ID = '".$_SESSION['Username']."'";

  $sqlstallnameresult = mysqli_query($conn, $sqlstallname);

  $stallnamearray = mysqli_fetch_array($sqlstallnameresult);


echo "<a href='logout.php'><div id='logout'><img src='SDP materials/logout.png'>&nbsp;&nbsp;LOGOUT</div></a>";



if ($_SESSION['Role'] === '1') {
  echo "<a href=''><div id='stallname'>
        STALLNAME:&nbsp;".$stallnamearray['Stall_Name']."
        </div></a>";


  echo "<a href='OrderPanel.php'><div id='orderpanel'>
        <img src='SDP materials/list.png'>
        ORDERS PANEL
        </div></a>";
}

if ($_SESSION['Role'] === '2') {
  echo "<a href='MainpageAll.php'><div id='orderpanel'>
        <img src='SDP materials/user-outline.png'>
        USER MODE
        </div></a>";


  echo "<a href='Management.php'><div id='orderpanel'>
        <img src='SDP materials/management.png'>
        MANAGEMENT
        </div></a>";


  echo "<a href='ImageCheck.php'><div id='orderpanel'>
        <img src='SDP materials/search(white).png'>
        IMAGE CHECK
        </div></a>";
}

if ($_SESSION['Role'] === '3') {

  echo "<a href='MainpageAll.php'><div id='orderpanel'>
        <img src='SDP materials/user-outline.png'>
        USER MODE
        </div></a>";


  echo "<a href='ReviewFeedback.php'><div id='orderpanel'>
        <img src='SDP materials/reviewfeedback.png'>
        REVIEW FEEDBACK
        </div></a>";
}


}



 ?>




<?php


  if(isset($_SESSION['Username'])){

  $sql = "SELECT * FROM User WHERE User_ID = '".$_SESSION['Username']."'";
  $result = mysqli_query($conn, $sql);

  $rows = mysqli_fetch_array($result);

  $ProfilePic = $rows['User_Image'];







echo

      "<div id='userbtn'>



      <a href='SendFeedbackform.php'><div id='report'><img src='SDP materials/medical.png'></div></a>

      <a href='Cart.php'><div id='cart'><img src='SDP materials/cart.png'></div></a>

      <a href='Notifications.php'><div id='notification'><img src='SDP materials/notification.png'></div></a>";





/*if ($ProfilePic == NULL) {
  echo "<a href=''><div id='profile'>


  <img src='SDP materials/user.png'>


  </div></a>";*/


/*
else {

*/
  echo "<a href='PurchaseHistory.php'><div id='profile'>


  <img src='".$ProfilePic."'>


  </div></a>";
//}


}












//}*/

?>





</div>

<div id="hamburger" onclick="dropdownmenu()"><img src="SDP materials/menu.png"></div>

<div id="dropdown"></div>






</div>

<script>


  var dropdown = document.getElementById('dropdown');

// to be updated later

  function dropdownmenu() {
    dropdown.classList.toggle("show");
  }


</script>
