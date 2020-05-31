<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Send Feedback</title>
    <link rel="stylesheet" type="text/css" href="SendFeedbackform.css">

    <style>

    #stall-desc {
      width: 100%;
      height: 450px;
      margin-bottom: 15px;
      font-size: 18px;
      padding-left: 10px;
      color: white;
      padding-top: 5px;
      border-style: none;
    }



    </style>

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">

     <div class="grid-template">

     <div id="form-title">
     <div id="title">
     PROVIDE FEEDBACK
     </div>
     </div>


     <div id="form-input">
     <form action='UpdateStall.php' method='post' onsubmit='return Error(this)' id='addstall-form' enctype="multipart/form-data">

     <input type='text' id='stall-name' name='stall-name' placeholder="Stall Name...">

     <textarea id='stall-desc' name='stall-desc' placeholder="Stall Description..."></textarea>

     <input type='submit' id='update-stall' name='update-stall' value='UPDATE' style="background-color:#03a9f4;">

     <a href='MainpageAll.php' id='link'>
     <div id='cancel-btn'>
     CANCEL
     </div>
     </a>

     </form>
     </div>


     </div>

      <div id='validate'></div>

     </div>


     <script>

     function Error() {

         var stall_name = document.getElementById("stall-name").value;
         var stall_desc = document.getElementById("stall-desc").value;

         if (stall_name == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Stall name is required";
           return false;
         }

         if (stall_desc == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Stall Description is required";
             return false;
           }

           if (stall_desc.length < 20){
               document.getElementById('validate').style.display = "block";
             document.getElementById('validate').innerHTML = "* Stall Description must contain at least 20 characters";
               return false;
             }

         else {
           document.getElementById('validate').innerHTML = "";
         }

     }





     </script>

  </body>
</html>
