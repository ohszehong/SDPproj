<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Stall</title>
    <link rel="stylesheet" type="text/css" href="ViewStall.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <script>

  /*  $(document).ready(function() {
    $(document).on('click','#renew-btn',function (e){

       e.preventDefault();

      var Stall_ID = $('.stall-id').val();
      var Renew_Date = $('#renew-date').val();

      $.ajax ({

        type :'POST',
        data :{
                Stall_ID:Stall_ID,
                Renew_Date:Renew_Date
              },
        url  :"RenewContract.php",
        success : function(data){
           $('#table-data-grid').html(data);
        }

      })

    });


    $(document).on('click','#purchase',function (e){

       e.preventDefault();

      var OrderID = $('#order-id').val();
      var TotalPrice = $('#total').val();

      $.ajax ({

        type :'POST',
        data :{
                OrderID:OrderID,
                TotalPrice:TotalPrice
              },
        url  :"SendOrder.php",
        success : function(data){
           $('.cart-template').html(data);
        }

      })

    });



}); */


    </script>

  </head>
  <body>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">

    <div class='table-cover'>
    <div id='table-title'>
    VIEW STALLS
    </div>

    <div class="table-grid">

      <div id='table-header'>
      <div id='header'>ID</div>
      <div id='header'>Stall Name</div>
      <div id='header'>Stall Contract</div>
      <div id='header'>Stall Description</div>
      <div id='header'>Renew Contract</div>
      <div id='header' style='text-align:center;'>Remove Stall</div>
      </div>

      <div id='table-data-grid'>

    <?php

    $sql = "SELECT * FROM stall";

    $result = mysqli_query($conn, $sql);

    $getdate = date('Y-m-d');

    if (mysqli_num_rows($result) > 0) {

     while($rows = mysqli_fetch_array($result)) {



      echo "<div id='table-data'>".$rows['Stall_ID']."</div>
            <div id='table-data'>".$rows['Stall_Name']."</div>
            <div id='table-data'>".$rows['Stall_Contract']."</div>
            <div id='table-data'>".$rows['Stall_Description']."</div>";

            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($rows['Stall_Contract']);
            $diff = date_diff($date1,$date2);

      $diffrence = $diff->format("%R%a");

      if ( $diffrence > 0) {

        echo "<div id='table-data'>

              <form action='RenewContract.php' method='POST'>


              <input type='hidden' id='stall-id' name='stall-id' value='".$rows['Stall_ID']."'>
              <input type='date' id='renew-date' name='renew-date'>
              <input type='submit' id='renew-btn' value='RENEW'>

              </form>

              </div>";

        echo "<div id='table-data'>

              <div id='remove-btn'>

              <img src='SDP materials/remove-user-1.png'>

              </div>

              </div>";

      }

      else {

        echo "<div id='table-data'>

              <form action='RenewContract.php' method='POST'>

              <input type='hidden' id='stall-id' name='stall-id' value='".$rows['Stall_ID']."'>
              <input type='date' id='renew-date' name='renew-date'>
              <input type='submit' id='renew-btn' value='RENEW'>

              </form>

              </div>";

        echo "<div id='table-data'>

              <form action='RemoveStall.php' method='POST'>

              <input type='hidden' id='stall-id' name='stall-id' value='".$rows['Stall_ID']."'>

              <div id='remove-btn-2'>

              <input type='image' src='SDP materials/remove-user.png' name='remove-user'>

              </div>

              </form>

              </div>";

      }

    }


    }


     ?>

     </div>


     </div>

    </div>

     </div>


  </body>
</html>
