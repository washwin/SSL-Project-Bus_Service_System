<?php
    $auth=false;
    session_start();
    if(isset($_SESSION['userId'])){
        // echo('User SignedIn<br>');
        $auth = true;
    }
    else{
        // echo('User NOT SignedIn');
        header('location: /SSL-Project/index.php');
    }

    $routeId=$_GET["route_ID"];
    // echo '<br>';

    $validPath = false;
    // echo $_SERVER["HTTP_REFERER"].'<br>';echo $_SERVER["HTTP_REFERER"];
    // echo $_SERVER["HTTP_REFERER"];
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/routes/index.php#availableRoutes")) {
      $validPath = true;
      // echo'<div>**********From SSLP***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/routes/index.php")) {
        $validPath = true;
        // echo'<div>**********From SSLP***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/routes")) {
      $validPath = true;
      // echo'<div>**********From SSLP***********</div>';
    }

    if(! $validPath){
      header('location: /SSL-Project/index.php');
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
  </head>
  <script src="routes/routes.js"></script>
  <body style="background-color: white;">
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
                              <a href="/SSL-Project" class="navbar__links">Home</a>
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
                      if($auth && $validPath){
                      echo('
                      <li class="navbar_item profileSection">
                        <img src="https://cdn.iconscout.com/icon/free/png-256/profile-417-1163876.png" alt="Avatar" class="avatar">
                        <div class="profileContent">
                            <div class="profileMenuContent"><a href="/SSL-Project/edit_profile/index.php">Edit&nbsp;Profile</a></div>
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

    <!-- Main Section -->

    <div class="row"> 
      <div class="column1">
        <h1>Select Seats</h1><br>
        <?php
          if($auth && $validPath){
            include('../db.php');
            $sql_q="SELECT * FROM available WHERE routeId=".$routeId." ;";
            $seats=$conn->query($sql_q);
            $count=mysqli_num_rows($seats);
            if($count==0){
              $sql_create_route_data="INSERT INTO available(routeId) VALUES(".$routeId.") ;";
              $conn->query($sql_create_route_data);
              $sql_q="SELECT * FROM available WHERE routeId=".$routeId." ;";
              $seats=$conn->query($sql_q);
            }
            while($row=mysqli_fetch_assoc($seats))
            {
              echo('<form action="/SSL-Project/payment/" method="POST">');
              for($i=1;$i<11;$i++)
              {
                if($row["seat$i"]==null)
              {
                echo(' <input type="checkbox" id="seat'.$i.'" name="seat[]" value="'.$i.'">
                  <label for="seat'.$i.'">Seat '.$i.'</label><br>');
              }
              else if($row["seat$i"]!=null)
              {
                // echo ("Seat $i is reserved");
                echo '<div><input type="checkbox" id="seat'.$i.'" name="s" value="check" disabled><label for="seat'.$i.'" style="color:rgb(77, 74, 74);">&nbsp;Seat '.$i.'</label></div>';
              }
              if($i!=10){ echo "<br>";} 
              }
            }
          }
          echo '<input type="hidden" name="routeId" value="' . $routeId . '" >';
        ?>
        <button class="main__btndate" type="submit">Proceed to book</button>
      </form>
      </div>
      <div class="column2">
        <!-- <img src="seating_arrangement.jpg"; width=200px; height=500px; alt="bus seating arrangement"; label="bus seating arrangement"> -->
        <img src="seating_arrangement.jpg" alt="bus seating arrangement" class="busImg" label="bus seating arrangement">
      </div>
    </div>
    <div class="footer__container">
      <div class="footer__links">
        <div class="footer__link--wrapper">
          <div class="footer__link--items">
            <h2>About Us</h2>
            <a href="/SSL-Project/about_us/index.php">About&nbsp;Us</a>
            <a href="/SSL-Project/bus_pass/index.php">Bus&nbsp;Pass</a>
            <a href="/SSL-Project/contactus/index.php">Help</a> 
          </div>
          <div class="footer__link--items">
            <h2>Contact Us</h2>
            <a href="/SSL-Project/contactus/index.php">Contact</a>
            <a href="/">Support</a>
            <a href="/SSL-Project/faq/index.php">FAQs</a>
          </div>
          <div class="footer__link--items">
             <h2> <a href="/SSL-Project/admin/index.php" class="navbar__links">Admin Portal</a></h2>
           </div> 
        </div>
        <div class="footer__link--wrapper">

         
        </div>
      </div>
      <section class="social__media">
        <div class="social__media--wrap">
          <div class="footer__logo">
            <a href="/SSL-Project/index.php" id="footer__logo"><i class="fas fa-bus"></i>SSL BUS SERVICE</a>
          </div>
          <p class="website__rights">© SSL 2022. All rights reserved</p>
          <div class="social__icons">
            <a
              class="social__icon--link"
              href="https://www.facebook.com/iitdharwadofficial/"
              target="_blank"
              aria-label="Facebook"
              title="IIT DH Facebook"
            >
              <i class="fab fa-facebook"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.instagram.com/cdc.iitdh/?hl=en"
              target="_blank"
              aria-label="Instagram"
              title="IIT DH Instagram"
            >
              <i class="fab fa-instagram"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.youtube.com/c/iitdharwadofficialchannel"
              target="_blank"
              aria-label="Youtube"
              title="IIT DH Youtube"
            >
              <i class="fab fa-youtube"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://twitter.com/iitdhrwd?lang=en"
              target="_blank"
              aria-label="Twitter"
              title="IIT DH Twitter"
            >
              <i class="fab fa-twitter"></i>
            </a>
            <a
              class="social__icon--link"
              href="https://www.linkedin.com/company/iit-dharwad/"
              target="_blank"
              aria-label="LinkedIn"
              title="IIT DH LinkedIn"
            >
              <i class="fab fa-linkedin"></i>
            </a>
          </div>
        </div>
      </section>
    </div>

    <script src="app.js"></script>
  </body>

</html>