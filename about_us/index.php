<?php
    $auth=false;
    session_start();
    if(isset($_SESSION['userId'])){
        // echo('User SignedIn<br>');
        $auth = true;
    }
    else{
        // echo('User NOT SignedIn');
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSL BUS Services</title>
    <link rel="stylesheet" href="styles1.css" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <script src="routes/routes.js"></script>
  <body>
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
                              <a href="/SSL-Project/history/index.php" class="navbar__links">Booking&nbsp;History</a>
                          </li>
                          <li class="navbar__item">
                              <a href="/SSL-Project" class="navbar__links">Home</a>
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
                              <a href="/SSL-Project/index.php" class="navbar__links">Home</a>
                          </li>
                          <li class="navbar__item">
                            <a href="/SSL-Project/routes/index.php" class="navbar__links">Search&nbsp;Route</a>
                          </li>
                      ');
                      }
                      // <!-- <li class="navbar__btn"><a href="/" class="button">BUS TICKETS</a></li> -->
                      if($auth){
                      echo('
                        <li class="navbar_item profileSection">
                          <img src="https://cdn.iconscout.com/icon/free/png-256/profile-417-1163876.png" alt="Avatar" class="avatar">
                          <div class="profileContent">
                              <div class="profileMenuContent"><a href="/SSL-project/edit_profile/index.php">Edit&nbsp;Profile</a></div>
                              <div class="profileMenuContent"><a href="/SSL-Project/history/index.php">Bookings</a></div>
                              <div class="profileMenuContent"><a href="/SSL-Project/bus_pass/index.php">Bus&nbsp;Pass</a></div>
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
        <h1>ABOUT US</h1>
        <div class="display">
           <p style="padding:10px;">
             SSL Bus Service is an online bus <a href="/SSL-Project/routes/index.php">ticket booking</a> platform which makes the process of booking tickets 
             and traveling easy and convenient. 
             The website also has a feature through which one can create a <a href="/SSL-Project/bus_pass/index.php">bus pass</a> and use it. You can view your <a href="/SSL-Project/history/index.php">older bookings</a>
             and the details. For any query/ complaint or feedback, please visit <a href="/SSL-Project/contactus/index.php">contact&nbsp;us</a> page.
           </p>
       </div> 
       <br>
      <div class="row">
        <div class="column1">
         <img src="1.png">
         <br><br>
         <img src="1.png">
        </div>
        <div class="column1">
         <img src="1.png">
         <br><br>
         <img src="1.png">
        </div>
        <div class="column1">
         <img src="1.png">
         <br><br>
        </div>
        <div class="column1" >
          <h2> The developers are:</h2>
           <ul>
            <div class="list">
             <li>Likhilesh</li>
             <li>Amrutha</li>
             <li>Ashwin</li>
             <li>Tejal</li>
             <li>Dhrutika</li>
                    </div>
           </uL>
         </div>
      </div>




    
    
    </body>             

</html>