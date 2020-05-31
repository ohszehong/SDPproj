<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Send Feedback</title>
    <link rel="stylesheet" type="text/css" href="SendFeedbackform.css">

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
     <form action='SendFeedback.php' method='post' onsubmit='return Error(this)' id='addstall-form' enctype="multipart/form-data">

     <input type='text' id='report-title' name='report-title' placeholder="Report Title...">

     <textarea id='report-desc' name='report-desc' placeholder="Report Description..." style="height:450px;"></textarea>

     <input type='submit' id='send-feedback' name='send-feedback' value='SEND FEEDBACK' style="background-color:#03a9f4;">

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

         var report_title = document.getElementById("report-title").value;
         var report_desc = document.getElementById("report-desc").value;

         if (report_title == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Report title is required";
           return false;
         }

       if (report_title.length < 5){
           document.getElementById('validate').style.display = "block";
         document.getElementById('validate').innerHTML = "* Report title is too short";
           return false;
         }

         if (report_desc == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Report Description is required";
             return false;
           }

           if (report_desc.length < 20){
               document.getElementById('validate').style.display = "block";
             document.getElementById('validate').innerHTML = "* Report Description must contain at least 20 characters";
               return false;
             }

         else {
           document.getElementById('validate').innerHTML = "";
         }

     }





     </script>

  </body>
</html>
