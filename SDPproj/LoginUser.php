

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>LoginUser</title>
    <link rel="stylesheet" type="text/css" href="LoginUser.css">

   </head>
   <body>


     <?php
     require "navbar.php";
     ?>




<div class="wrapper">

 <div id="Welcome">LOGIN</div>

 <div id="LoginForm">
<form method="post" action="LoginCheck.php" onsubmit="return Error(this)">

<div id="Username">
<input type="text" name="Username" id="username"  placeholder="TP number..." autocomplete="off">
</div>

<div id="Passwords">
<input type="password" name="Passwords" id="passwords"  placeholder="Passwords...">
</div>

<div id="LoginButton">
<input type="submit" id="login" name="Login" value="LOG IN" onclick="return Error()">
</div>




</form>
 </div>


 <div id="alarms">

<?php


if(isset($_SESSION['Error'])) {
  echo "<script>document.getElementById('alarms').style.display = 'block';</script>";
  echo $_SESSION['Error'];
  unset($_SESSION['Error']);
}




?>

 </div>


</div>

<script>
function Error() {

    var Username = document.getElementById("username").value;
    var Passwords = document.getElementById("passwords").value;

    if (Username == "" && Passwords == ""){
        document.getElementById('alarms').style.display = "block";
      document.getElementById('alarms').innerHTML = "* Username is required <br><br> * Passwords is required ";
      return false;
    }

    if (Username == ""){
        document.getElementById('alarms').style.display = "block";
      document.getElementById('alarms').innerHTML = "* Username is required";
      return false;
    }

    if (Passwords == ""){
      document.getElementById('alarms').style.display = "block";
      document.getElementById('alarms').innerHTML = "* Passwords is required";
      return false;
    }



    else {
      document.getElementById('alarms').innerHTML = "";
    }

}





</script>

</body>
</html>
