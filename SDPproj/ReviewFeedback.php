<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Review Feedback</title>
    <link rel="stylesheet" type="text/css" href="ReviewFeedback.css">

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">

     <div id="review-title">
     <div id="title">
     FEEDBACKS
     </div>
     </div>

     <div id="review-panel">
     <div id="feedback-grid">

     <div id="grid-title-template">
     <div id='grid-title'>No.</div>
     <div id='grid-title'>Title</div>
     <div id='grid-title'>Date</div>
     <div id='grid-title'>Description</div>
     </div>

     <div id='grid-details'>

      <?php

      $sql = "SELECT * FROM report";

      $result = mysqli_query($conn,$sql);

      if (mysqli_num_rows($result) > 0) {

        while ($rows = mysqli_fetch_array($result)) {

        echo "

             <div id='grid-desc'>".$rows['Report_ID']."</div>

             <div id='grid-desc-2'>".$rows['Report_Reason']."</div>

             <div id='grid-desc'>".$rows['Report_Date']."</div>

             <div id='grid-desc-3'>".$rows['Report_Text']."</div>

            ";

      }
      }
       ?>
     </div>


     </div>
     </div>


     </div>

  </body>
</html>
