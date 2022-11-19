<?php
    $auth=false;
    session_start();
    if(isset($_SESSION['userId'])){
        echo('User SignedIn<br>');
        $auth = true;
    }
    else{
        echo('User NOT SignedIn');
        header('location: /SSL-Project/index.php');
    }
?>
<?php
  if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/bus_pass/index.php")) {
    if(array_key_exists('days', $_POST)) {
      $days=$_POST["days"];
      include('../db.php');
      // $date=date('Y-m-d H:i:s',mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$days, date("Y")));
      // echo($date.'<br>');
      // $sql="INSERT INTO bus_pass(busPassId,validTill) values('".$_SESSION["userId"]."_bp', '".$date."' );";
      $sql="Select * from bus_pass where busPassId = '".$_SESSION['userId']."_bp' ;";
      $res=mysqli_query($conn,$sql);
      $count=mysqli_num_rows($res);
      if($count>0){
        $sql="UPDATE bus_pass SET validTill = DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL ".$days." DAY) ;";
        // echo($sql.'<br>');
        // echo($sql.'<br>');
        $res=mysqli_query($conn,$sql);
      }
      else{
        $sql="INSERT INTO bus_pass(busPassId,validTill) values('".$_SESSION["userId"]."_bp', DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL ".$days." DAY) );";
        // echo($sql.'<br>');
        // echo($sql.'<br>');
        $res=mysqli_query($conn,$sql);
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSL BUS Services</title>
    <link rel="stylesheet" href="busPass.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
  </head>
  <!-- <script src="routes/routes.js"></script> -->
  <body style="background-color: #453e3e;">
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar__container">
        <a href="/SSL-Project" id="navbar__logo"><i class="fas fa-bus"></i>SSL Bus Services</a>
        <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span> <span class="bar"></span>
        <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <?php
            if($auth){
              echo('
                <li class="navbar__item">
                    <a href="/SSL-Project/routes" class="navbar__links">Booking&nbsp;History</a>
                </li>
                <li class="navbar__item">
                    <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
                </li>
                ');
              }
              else{
                echo('
                <li class="navbar__item">
                <a href="/SSL-Project/signin/index.php" class="navbar__links">Log&nbsp;In</a>
                </li>
                <li class="navbar__item">
                    <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
                </li>
              ');
            }
            // <!-- <li class="navbar__btn"><a href="/" class="button">BUS TICKETS</a></li> -->
            echo('
              <li class="navbar__item">
                <a href="/SSL-Project/about_us/index.php" class="navbar__links">About&nbsp;Us</a>
              </li>
            ');
            if($auth){
              echo('
              <li class="navbar_item profileSection">
                <img src="https://cdn.iconscout.com/icon/free/png-256/profile-417-1163876.png" alt="Avatar" class="avatar">
                <div class="profileContent">
                    <div class="profileMenuContent"><a href="/SSL-Project/edit_profile/index.php">Edit&nbsp;Profile</a></div>
                    <div class="profileMenuContent"><a href="/SSL-Project/history/index.php">Bookings</a></div>
                    <div class="profileMenuContent"><a href="/SSL-Project/contactus/index.php">Help</a></div>
                    <div class="profileMenuContent"><a href="/SSL-Project/signin/index.php">Logout</a></div>
                </div>
              </li>
              ');
            }
          ?>
        </ul>
      </div>
    </nav>
    <main>
      <div class="univ flex-center">
        <br>
        <div class="container">
          <?php
            include('../db.php');
            $sql="Select * from bus_pass where busPassId = '".$_SESSION['userId']."_bp' ;";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            $form=false;
            $validity='';
            if($count>0){
              // $row=mysqli_fetch_assoc($res);
              $sql="Select * from bus_pass where busPassId = '".$_SESSION['userId']."_bp' and DATE(validTill) >= DATE(NOW()) ;";
              $res=mysqli_query($conn,$sql);
              $count=mysqli_num_rows($res);
              if($count>0){
                $row=mysqli_fetch_assoc($res);
                echo('<h2 style="margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your Bus Pass is Valid Till: </h2>');
                echo('<p style="color:#aaa; font-size:17px;margin:10px 0 0 103px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YYYY-MM-DD HH-MM-SS </p> ');
                echo('<b><p style="color:rgb(122,32,32); font-size:22px;margin:5px 0 20px 100px;">&nbsp;&nbsp;&nbsp; '.$row["validTill"].' </p></b> ');
              }
              else{
                echo('<h3 style="margin-top:10px">It seems your Bus Pass has EXPIRED!</h3>');
                $form=true;
              }
            }
            else{
              echo('<h3 style="margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It seems you don\'t have any BUS PASS!</h3>');
              $form=true;
            }
          ?>
          <?php 
          if($form==true){
            echo('
              <h3 style="margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Want to buy a BUS PASS?</h3>
              <h4 style="margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select number BUS PASS according to number of days</h4>
              <div class="form">
                <h4>24 hours<h4>
                <h4>INR 2,499<h4>
                <form action="#" method="post">
                  <input type="hidden" name="days" value="1">
                  <button class="buyPassBtn">Buy&nbsp;Now</button>
                </form>
              </div>
              <div class="form">
                <h4>3 days<h4>
                <h4>INR 5,499<h4>
                <form action="#" method="post">
                  <input type="hidden" name="days" value="3">
                  <button class="buyPassBtn">Buy&nbsp;Now</button>
                </form>
              </div>
              <div class="form">
                <h4>7 days<h4>
                <h4>INR 10,999<h4>
                <form action="#" method="post">
                  <input type="hidden" name="days" value="7">
                  <button class="buyPassBtn">Buy&nbsp;Now</button>
                </form>
              </div>
            ');
          }
          else{
            echo('
            <div style="text-align:center;">
              <h4 style="margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;Use the Bus Pass to book your Tickets</h4>
              <h1 style="margin-top:10px;color:white;">Happy Journey!</h1>
              <a href="/SSL-Project/index.php" ><button class="homeBtn">Home</button></a>
              <p style="margin-top:30px">Have any query?</p>
              <p style="margin-left:15px"><a href="/SSL-Project/contactus/index.php">Contact Us</a></p>
            </div>
            
            ');
          }
          ?>
        </div>
      </div>
    </main>
  </body>
</html>
