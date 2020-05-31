<?php

  session_start();
  require "conn.php";

 ?>

 <?php

    $Report_ID = $_POST['ReportID'];

    $sql = "DELETE FROM report WHERE Report_ID = '".$Report_ID."'";

    $result = mysqli_query($conn, $sql);

 ?>

    <?php

    $sql2 = "SELECT * FROM report";

    $result2 = mysqli_query($conn,$sql2);

    if (mysqli_num_rows($result2) > 0) {

      while ($rows = mysqli_fetch_array($result2)) {

      echo "

           <input type='hidden' name='report-id' id='report-id' value='".$rows['Report_ID']."'>

           <div id='grid-desc'>".$rows['Report_ID']."</div>

           <div id='grid-desc-2'>".$rows['Report_Reason']."</div>

           <div id='grid-desc'>".$rows['Report_Date']."</div>

           <div id='grid-desc-3'>".$rows['Report_Text']."

           <div id='delete-btn'><img src='SDP materials/x-mark.png'></div>

           </div>

          ";

    }
    }
     ?>










  ?>
