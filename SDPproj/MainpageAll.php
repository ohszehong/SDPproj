<?php


  include "conn.php";

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mainpage</title>
    <link rel="stylesheet" type="text/css" href="Mainpage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


  </head>
  <body style='font-family: 'Noto Sans SC', sans-serif !important;'>

    <?php

    require "navbar.php";

     ?>

     <div class="wrapper">

       <div class="container">
   	<div class="row">
   		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
               <div class="MultiCarousel-inner">


                   <div class="item">
                       <a href='MainpageAll.php'>
                       <div class="pad15">
                           <img src='SDP materials/defaultstall.jpg'>
                       </div>
                     </a>
                   </div>

                   <?php

                  $selectstall = "SELECT * FROM stall";

                  $selectresult = mysqli_query($conn, $selectstall);

                  while ($selectrows = mysqli_fetch_array($selectresult)) {

                    $stallid = $selectrows['Stall_ID'];

                    echo "<div class='item'>
                        <form action='MainpageAll.php' method='GET'>
                        <input type='hidden' id='get-stall-id' name='get-stall-id' value='".$selectrows['Stall_ID']."'>
                        <input type='image' src='".$selectrows['Stall_Image']."' class='pad15' id='get-stall-image".$stallid."'>
                      </form>
                      </div>";

                  }


                   ?>

               </div>
               <button class="btn btn-primary leftLst"><</button>
               <button class="btn btn-primary rightLst">></button>
           </div>
   	</div>


  <div class="menu-template">

    <div id="menu-category">

    <div id="searchbox">
    <form action = "MainpageAll.php" method = "get">
    <input type="image" src="SDP materials/search.png" alt="Search" id="Searchbtn">
    <input type="text" name="searchtext" id="searchtextbox" placeholder="Enter keywords...">
    </form>
    </div>




  <!-- <a href="" id="link"><div id="hot-deals">HOT DEALS</div></a>

      <a href="" id="link"><div id="breakfast">BREAKFAST</div></a>

      <a href="" id="link"><div id="sets">SETS</div></a>

    <a href="" id="link"><div id="spicy">SPICY</div></a>

    <a href="" id="link"><div id="western">WESTERN</div></a>

    <a href="" id="link"><div id="asians">ASIANS</div></a>

    <a href="" id="link"><div id="desserts">DESSERTS</div></a>

    <a href="" id="link"><div id="drinks">DRINKS</div></a> -->


    </div>





    <div class='menu-desc-template'>

    <?php

      $search_key = isset($_GET['searchtext'])? $_GET['searchtext']:'';
      $sqlsearch = "SELECT * FROM meal
            WHERE (Meal_Name LIKE '%".$search_key."%')
            OR (Meal_Category_1 LIKE '%".$search_key."%')
            OR (Meal_Category_2 LIKE '%".$search_key."%')
            AND (Meal_Accept = 'Y')";

      $resultsearch = mysqli_query($conn , $sqlsearch);

      if (mysqli_num_rows($resultsearch) <= 0) {

        echo "<script>window.go.history(-1);</script>";

      }

      else if (isset($_GET['get-stall-id'])) {

        $searchmeal = "SELECT * FROM meal WHERE Stall_ID = '".$_GET['get-stall-id']."'";

        $searchmealresult = mysqli_query($conn, $searchmeal);

        while ($searchmealrows = mysqli_fetch_array($searchmealresult)) {


        if ($searchmealrows['Meal_Availability'] == 'N' && $searchmealrows['Meal_Accept'] == 'Y' && $searchmealrows['Meal_Delete'] == 'N') {

        echo "<div id='menu-desc'>
              <div id='menu-pic' style='opacity:0.5;'>
              <img src='".$searchmealrows['Meal_Image']."'>
              </div>
              <div id='menu-btn'>

              <div id='menu-name'>
              ".$searchmealrows['Meal_Name']."
              </div>

              <form action='SelectedMeal.php'>

              <input type='hidden' id='MealID' name='MealID' value='".$searchmealrows['Meal_ID']."'>

              <div id='learn-more-btn'>
              <input type='submit' id='learn-more' name='learn-more' value='NOT AVAILABLE' style='background-color:#DB4141;'>
              </div>

              </form>

              </div>
              </div>";

        }

        else if ($searchmealrows['Meal_Accept'] == 'Y' && $searchmealrows['Meal_Delete'] == 'N') {

          echo "<div id='menu-desc'>
                <div id='menu-pic'>
                <img src='".$searchmealrows['Meal_Image']."'>
                </div>
                <div id='menu-btn'>

                <div id='menu-name'>
                ".$searchmealrows['Meal_Name']."
                </div>

                <form action='SelectedMeal.php'>

                <input type='hidden' id='MealID' name='MealID' value='".$searchmealrows['Meal_ID']."'>

                <div id='learn-more-btn'>
                <input type='submit' id='learn-more' name='learn-more' value='LEARN MORE'>
                </div>

                </form>

                </div>
                </div>";




        }

      }

    }

      else {


        while ($searchrows = mysqli_fetch_array($resultsearch)) {


          if ($searchrows['Meal_Availability'] == 'N' && $searchrows['Meal_Accept'] == 'Y' && $searchrows['Meal_Delete'] == 'N') {

          echo "<div id='menu-desc'>
                <div id='menu-pic' style='opacity:0.5;'>
                <img src='".$searchrows['Meal_Image']."'>
                </div>
                <div id='menu-btn'>

                <div id='menu-name'>
                ".$searchrows['Meal_Name']."
                </div>

                <form action='SelectedMeal.php'>

                <input type='hidden' id='MealID' name='MealID' value='".$searchrows['Meal_ID']."'>

                <div id='learn-more-btn'>
                <input type='submit' id='learn-more' name='learn-more' value='NOT AVAILABLE' style='background-color:#DB4141;'>
                </div>

                </form>

                </div>
                </div>";

          }

          else if ($searchrows['Meal_Accept'] == 'Y' && $searchrows['Meal_Delete'] == 'N') {

            echo "<div id='menu-desc'>
                  <div id='menu-pic'>
                  <img src='".$searchrows['Meal_Image']."'>
                  </div>
                  <div id='menu-btn'>

                  <div id='menu-name'>
                  ".$searchrows['Meal_Name']."
                  </div>

                  <form action='SelectedMeal.php'>

                  <input type='hidden' id='MealID' name='MealID' value='".$searchrows['Meal_ID']."'>

                  <div id='learn-more-btn'>
                  <input type='submit' id='learn-more' name='learn-more' value='LEARN MORE'>
                  </div>

                  </form>

                  </div>
                  </div>";




          }

        }


      }


  /*    $sql = "SELECT * FROM meal";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {

        while ($rows = mysqli_fetch_array($result)) {





        }


      } */


     ?>

    </div>



    </div>









  <!--  <div id="menu-desc">

      <?php

      $search_key = isset($_GET['searchtext'])? $_GET['searchtext']:'';
      $sql = "SELECT * FROM meal
              WHERE (Meal_Name LIKE '%".$search_key."%')
              OR (Meal_Category_1 LIKE '%".$search_key."%')
              OR (Meal_Category_2 LIKE '%".$search_key."%')
              AND (Meal_Accept = 'Y')";

      $result = mysqli_query($conn , $sql);

        if (mysqli_num_rows($result) <= 0) {


          echo "<script>alert('No Result!')</script>";

          echo "<script>window.history.go(-1)</script>";


        }


        else {

              while ($rows = mysqli_fetch_array($result)){


                if ($rows['Meal_Availability'] == 'N' && $rows['Meal_Accept'] == 'Y') {
                  echo "<div id='meal-image' style='opacity:0.5;cursor:not-allowed;'>

                        <img src='".$rows['Meal_Image']."'>




                        </div>";

                        echo "<div id='meal-info'>

                              <p id='meal-title'>".$rows['Meal_Name']."</p>

                              <br>

                              <div id='meal-desc'>
                              ".$rows['Meal_Description']."
                              </div>


                              <form action='SelectedMeal.php' method='GET'>

                              <label for='go-meal' id='label-go-meal'>

                              <input type='submit' name='go-meal' value='N/A' style='background-color:#DB4141;'>
                              </label>
                              <input type='hidden' name='MealID' value=".$rows['Meal_ID'].">

                              </form>




                              </div>";
                }


                else if($rows['Meal_Accept'] == 'Y')
                {



                echo "<div id='meal-image'>

                      <img src='".$rows['Meal_Image']."'>




                      </div>";

                      echo "<div id='meal-info'>

                            <p id='meal-title'>".$rows['Meal_Name']."</p>

                            <br>

                            <div id='meal-desc'>
                            ".$rows['Meal_Description']."
                            </div>

                            <form action='SelectedMeal.php' method='GET'>

                            <label for='go-meal' id='label-go-meal'>

                            <input type='submit' name='go-meal' value='LEARN MORE'>
                            </label>
                            <input type='hidden' name='MealID' value=".$rows['Meal_ID'].">

                            </form>


                            </div>";
          }


              }
        }


       ?>



    </div> -->








  </div>




   </div>


<script>


$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});

</script>

  </body>
</html>
