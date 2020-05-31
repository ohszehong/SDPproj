<?php
include("conn.php");
session_start();
session_write_close();

$target_dir = "SDP Materials/";
//the basename($_FILES["photo"]["name"]) means to get the basename (e.g. test.docx) //from the file path (e.g. D://images/test.docx)
$target_file = $target_dir . basename($_FILES["StallPic"]["name"]);
//to get the extension of the file (e.g docx)
$imageFileType = pathinfo ($target_file, PATHINFO_EXTENSION);

//check if image file is a actual image or fake image
$check = getimagesize($_FILES["StallPic"]["tmp_name"]);
if($check !== false)
{

 }
else  {
   echo "<script>alert('File is not an image.Please try again!');</script>";
   die("<script>window.history.go(-1);</script>");
  }

//Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.Please try again!');</script>";
  die("<script>window.history.go(-1);</script>");
}

//move the file using move_uploaded_file function.
//if not success transfer, give alert message!
if (! move_uploaded_file($_FILES["StallPic"]["tmp_name"],$target_file)) {
  echo "<script>alert('Unable to upload photo.Thus, data will not be inserted to database. Please try again!');</script>";
  die("<script>window.history.go(-1);</script>");
}

$sql = "UPDATE stall
        SET Stall_Image = '".$target_file."'
        WHERE User_ID = '".$_SESSION['Username']."'";

if(!mysqli_query($conn,$sql))
{
die('Error:'.mysqli_error($conn));
}

echo'<script>
window.location.href = "PurchaseHistory.php";
</script>';

mysqli_close($conn);
?>
