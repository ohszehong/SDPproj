<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Stall</title>
    <link rel="stylesheet" type="text/css" href="AddNewStall.css">


  </head>
  <body>

    <?php

    require "navbar.php";

    ?>

    <div class="wrapper">

    <div class="grid-template">

    <div id="form-title">
    <div id="title">
    ADD NEW STALL
    </div>
    </div>


    <div id="form-input">
    <form action='AddNewStall.php' method='post' id='addstall-form' onsubmit='return Error(this)'>

    <input type='text' id='username' name='username' placeholder='User ID...'>

    <input type='text' id='user-fn' name='user-fn' placeholder='First Name...'>

    <input type='text' id='user-ln' name='user-ln' placeholder='Last Name...'>

    <input type='text' id='user-email' name='user-email' placeholder='Email...'>

    <input type='text' id='user-phone' name='user-phone' placeholder='Phone Numbers...'>

    <input type='text' id='stall-name' name='stall-name' placeholder='Stall Name...'>

    <textarea id='stall-desc' name='stall-desc' placeholder='Stall Description...'></textarea>

    <p id='stall-contract-desc'>*Date of birth</p>
    <input type='date' id='user-dob' name='user-dob'>

    <p id='stall-contract-desc'>*Stall contract</p>
    <input type='date' id='stall-contract' name='stall-contract' placeholder='Contract until...'>

    <div id='user-gender-div'>
    <input type='radio' id='user-gender' name='user-gender' value='M'>Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type='radio' id='user-gender' name='user-gender' value='F'>Female
    </div>

    <input type='submit' id='add-stall' name='add-stall' value='ADD STALL' style="background-color:#03a9f4;" required="required">

    <a href='Management.php' id='link'>
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

        var User_ID = document.getElementById("username").value;
        var User_FN = document.getElementById("user-fn").value;
        var User_LN = document.getElementById("user-ln").value;
        var User_Email = document.getElementById("user-email").value;
        var User_Phone = document.getElementById("user-phone").value;
        var Stall_Name = document.getElementById("stall-name").value;
        var Stall_Desc = document.getElementById('stall-desc').value;
        var Stall_Contract = document.getElementById('stall-contract').value;
        var User_Gender = document.getElementById('user-gender').value;
        var User_DOB = document.getElementById('user-dob').value;

        var emailpattern = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        var usernamepattern = new RegExp(/^\S(?!.*\s{2}).*?\S$/);
        var phonepattern = new RegExp(/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/);

        var testEmail = emailpattern.test(User_Email);

        var testFirstname = usernamepattern.test(User_FN);

        var testLastname = usernamepattern.test(User_LN);

        var testPhone = phonepattern.test(User_Phone);


        if (User_ID == ""){
            document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* User ID is required";
          return false;
        }

      if (User_ID.length < 8){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* User ID is too short";
          return false;
        }

     if (User_FN == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* First Name is required";
          return false;
        }


     if (testFirstname == false){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid First name";
          return false;
        }

     if (User_LN == ""){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Last Name is required";
          return false;
        }

    if (testLastname == false){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid Last name";
          return false;
        }

     if (testEmail == false){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid Email format";
          return false;
        }

     if (testPhone == false){
          document.getElementById('validate').style.display = "block";
        document.getElementById('validate').innerHTML = "* Invalid Phone numbers";
          return false;
        }

     if (User_Phone.length < 8) {
          document.getElementById('validate').style.display = "block";
          document.getElementById('validate').innerHTML = "* Invalid Phone numbers";
          return false;
        }

        if (Stall_Name == ""){
             document.getElementById('validate').style.display = "block";
           document.getElementById('validate').innerHTML = "* Stall Name is required";
             return false;
           }

           if (Stall_Desc == ""){
                document.getElementById('validate').style.display = "block";
              document.getElementById('validate').innerHTML = "* Stall Description is required";
                return false;
              }

              if (Stall_Desc.length < 15){
                   document.getElementById('validate').style.display = "block";
                 document.getElementById('validate').innerHTML = "* Stall Description needs at least 15 characters";
                   return false;
                 }

                 if (User_DOB == ""){
                      document.getElementById('validate').style.display = "block";
                    document.getElementById('validate').innerHTML = "* Date of Birth is required";
                      return false;
                    }

                 if (Stall_Contract == ""){
                      document.getElementById('validate').style.display = "block";
                    document.getElementById('validate').innerHTML = "* Contract is required";
                      return false;
                    }

                    if (User_Gender == ""){
                         document.getElementById('validate').style.display = "block";
                       document.getElementById('validate').innerHTML = "* Gender is required";
                         return false;
                       }



        else {
          document.getElementById('validate').innerHTML = "";
        }

    }



    </script>


  </body>
</html>
