<?php
session_start();
?>

<?php
include 'conn.php';
?>

<?php
$username = mysqli_real_escape_string($conn , $_POST['Username']);
$password = mysqli_real_escape_string($conn , $_POST['Passwords']);

$sql = "Select * from User where User_ID = '".$username."' and User_Passwords = '".$password."'";

$result = mysqli_query($conn , $sql);

$rows = mysqli_fetch_array($result);

if(mysqli_num_rows($result)<=0)
{
    $_GET['username'] = $username;
    $_SESSION['Error'] = "* Invalid User, please try again!";
    header("Location: LoginUser.php");

}

else
{

  if ($username == $password) {
    $_SESSION['Username'] = $rows['User_ID']; //use session
    $_SESSION['Passwords'] = $rows['User_Passwords'];
    $_SESSION['Role'] = $rows['User_Role'];
      echo "<script>window.location.href='ChangeNewPasswords.php';</script>";

  }




 else {

  $_SESSION['Username'] = $rows['User_ID']; //use session
  $_SESSION['Passwords'] = $rows['User_Passwords'];
  $_SESSION['Role'] = $rows['User_Role'];

  echo "<script>window.location.href='MainpageAll.php';</script>";

}
}

session_write_close();

?>
