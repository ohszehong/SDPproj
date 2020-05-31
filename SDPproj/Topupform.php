

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Top up</title>

    <link rel="stylesheet" type="text/css" href="Topupform.css">
    <link rel="stylesheet" type="text/css" href="AddNewMeal.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>
  <body>

      <?php

      require "navbar.php";

       ?>

       <div class="wrapper">


       <div class="topup-form">

                <div id="form-title">TOP UP</div>


       <form action="Topup.php" method="post" onsubmit="return Error(this)">

      <div id="cardnumber">
      <input type="text" id="card-number" name="card-num" placeholder="Enter card numbers here...">
      </div>

      <div id="cardexpirydatetitle">

      <div id="expiry-title">Expiry date</div>
      <div id="cvv-title">CVV</div>

      </div>

      <div id="cardexpirydate">

      <input type="text" id="card-expirydate" name="card-exp" placeholder="Expiry(mm/yy)" pattern="[0-1][0-9]/[0-9][0-9]" title="Please match the format MM/YY">
      <input type="text" id="card-cvv" name="card-cvv" placeholder="CVV">

      </div>


      <div id="card-method-title">Select your preferred method</div>

      <div id="select-method">

      <div id="card-image"></div>

      <select name="cardmethod" id="card-method" required onchange="cardselection()" >
        <option value="" disabled selected hidden>Select Card Method...</option>
        <option value="Visa card"> Visa</option>
        <option value="Mastercard"> Mastercard</option>
        <option value="AmericanExpresscard"> American-Express</option>
        <option value="Discovercard"> Discover</option>
      </select>

      <div id="topup-amount">

      <input type="text" id="topup-total" name="topuptotal" placeholder="Amount" onkeyup="checkDec(this)">

      </div>

      <div id="submit-btn">

      <input type="submit" id="topup-btn" name="topupbtn" value="TOP-UP NOW">

      </div>


      <a href="PurchaseHistory.php" id="link"><div id="Cancel">CANCEL</div></a>


      </div>


      </form>

       </div>


       <div id='validate'></div>


       </div>


    <script>


    function cardselection() {
      var x = document.getElementById("card-method").value;

      if (x == "Visa card") {

        document.getElementById("card-image").innerHTML = "<img src='SDP materials/visa.png'>";
      }

      if (x == "Mastercard") {

        document.getElementById("card-image").innerHTML = "<img src='SDP materials/master-card.png'>";
      }

      if (x == "AmericanExpresscard") {

          document.getElementById("card-image").innerHTML = "<img src='SDP materials/american-express.png'>";
      }

      if (x == "Discovercard") {

        document.getElementById("card-image").innerHTML = "<img src='SDP materials/discover.png'>";

      }

    }

    </script>


    <script>

    function Error() {

        var CardNumber = document.getElementById("card-number").value;
        var CardExpiryDate = document.getElementById("card-expirydate").value;
        var CardCVV = document.getElementById("card-cvv").value;
        var CardMethod = document.getElementById("card-method").value;
        var TopupTotal = document.getElementById("topup-total").value;


        if (CardNumber == ""){
            document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Card Number is required";
          return false;
        }

      if (CardNumber.length !=16){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid Card Number";
          return false;
        }

        if (isNaN(CardNumber)){
            document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Invalid Card Number";
          return false;
        }


     if (isNaN(TopupTotal)){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Amount can only contains numbers";
          return false;
        }


     if (CardExpiryDate == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Expiry date is required";
          return false;
        }


    if (CardCVV == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* CVV is required";
          return false;
        }

     if (CardCVV.length < 3 || CardCVV.length > 3){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid CVV";
          return false;
        }

        if (isNaN(CardCVV)){
              document.getElementById('validate').style.display = "block";
            document.getElementById('validate').innerHTML = "* Invalid CVV";
              return false;
            }

        if (TopupTotal == ""){
           document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Amount is required";
          return false;
        }

     if (CardMethod == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Card Method is required";
          return false;
        }


        else {
          document.getElementById('validate').innerHTML = "";
        }

    }



    </script>

    <script>
function checkDec(el){
var ex = /^\d*\.?\d{0,2}$/
if(ex.test(el.value)==false){
  el.value = el.value.substring(0,el.value.length - 1);
 }
}
</script>

  </body>
</html>
