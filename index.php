<?php
// echo $_SERVER["HTTP_REFERER"];
// echo '<br>';
// echo $_SERVER["HTTP_REFERER"];
// echo '<br>';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSL BUS Services</title>
    <link rel="stylesheet" href="styles.css" />
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

  
  <?php

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $auth = false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin")) {
      // echo'<div>**********From signin***********</div>';
    }
    else{
      // echo'<div>********Not from signin*******</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin/register.php")) {
      // echo'<div>**********From register***********</div>';
      if(isset($_POST["password"])&&$_POST["username"]&&$_POST["firstName"]){
        session_start();
        include('./db.php');
        // $passHash=password_hash(test_input($_POST["password"]), PASSWORD_DEFAULT);
        $passHash=$_POST["password"];
        $userName=test_input($_POST["username"]);
        $firstName=test_input($_POST["firstName"]);
        $sql="INSERT INTO users(userName, pass_word, firstName) VALUES('".$userName."', '".$passHash."', '".$firstName."');";
        if(isset($_POST["email"]) && isset($_POST["lastName"])){
          $sql="INSERT INTO users(userName, pass_word, firstName, lastName, email) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["lastName"])."', '".test_input($_POST["email"])."'); ";
        }
        else if(isset($_POST["email"])){
          $sql="INSERT INTO users(userName, pass_word, firstName, email) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["email"])."'); ";
        }
        else if(isset($_POST["lastName"])){
          $sql="INSERT INTO users(userName, pass_word, firstName, lastName) VALUES('".$userName."', '".$passHash."', '".$firstName."', '".test_input($_POST["lastName"])."'); ";
        }
        mysqli_query($conn,$sql);
        $sql1="SELECT userId AS id FROM users WHERE userName ='".$userName."' AND pass_word = '".$passHash."' ;";
        $user=mysqli_query($conn,$sql1);
        $count=mysqli_num_rows($user);
        if ($count>0) {
            while($row=mysqli_fetch_assoc($user)){
                $_SESSION["userId"] = $row['id'];
            }
            // echo('user id '.$_SESSION["userId"].'::');
            $_SESSION["username"] = $userName;
            $_SESSION["password"] = $passHash;
        }
      }
    }
  ?>

  <?php 
    //ADD COMPLAINT/QUERY
    $add_complaint_or_query=false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/contactus/index.php")) {
      $add_complaint_or_query=true;
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/contactus")) {
      $add_complaint_or_query=true;
    }
    if($add_complaint_or_query){
      if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["description"]))
      {
        include('./db.php');
        $sql_add_complaint_or_query="INSERT INTO complaints(name,email,description) VALUES('$_POST[name]','$_POST[email]','$_POST[description]');";
        // echo $sql_add_complaint_or_query;
        mysqli_query($conn,$sql_add_complaint_or_query);
        echo('<div style="width:100%; background:lime; color:green;">Your Complaint/Query is sent!</div>');
      }
    }
  ?>

  <?php
    if (session_status() != PHP_SESSION_ACTIVE)session_start();
    if(isset($_SESSION['userId'])){
      // echo('User SignedIn<br>');
      // echo('UserId '.$_SESSION['userId'].'<br>');
      $auth = true;
    }
    else{
      // echo('User NOT SignedIn');
    }

  ?>
    <!-- Navbar Section -->
    <nav class="navbar">
        <div class="navbar__container">
            <a href="/SSL-Project" id="navbar__logo"><i class="fas fa-bus"></i>SSL Bus Services</a>
            <ul class="navbar__menu">
              <?php
                if($auth){
                  echo('
                    <li class="navbar__item">
                        <a href="/SSL-Project/history/index.php" class="navbar__links">Booking&nbsp;History</a>
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

    <!-- Hero Section -->
    <div class="main">
      <div class="main__container">
        <div class="main__content">
          <h1>SSL BUS SERVICES</h1>
          <br><br><br><br>
          <main>
            <form action="/SSL-Project/routes/index.php#availableRoutes" method="post" style="width:100%;">
                <div class="searchSection">
                    <div class="searchContainer">
                        <div id="search-from">
                            <h3>Boarding City &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination city</h3>
                            <?php 
                                    echo('
                                        <input id="input-from" class="main__btn" type="text" size="16" placeholder=" FROM" onkeyup="javascript:searchPlaces(\'from\',this.value)" name="fromCity" required>
                                    ');
                            ?>
                            <span id="from-suggestions"></span>
                            <button  class="main__btndate" onclick="javascript:swapToAndFrom(event)">
                                <i class="fa-duotone fa-arrow-right-arrow-left" style="color:green;height:20px;width:20px;"></i>
                                Swap
                            </button>
                            <?php 
                                    echo('
                                        <div style="display:inline-block;">
                                          <input id="input-to" class="main__btn" type="text" size="16" placeholder=" TO" onkeyup="javascript:searchPlaces(\'to\',this.value)" name="toCity" required>
                                          <span id="to-suggestions"></span>
                                        </div>
                                    ');
                            ?>

                            <?php
                                    echo('
                                        <input id="date" class="main__btndate" type="date" class="search-date" name="date" required>
                                    ');
                            ?>
                            <button class="main__btn" type="submit">Search Buses</button>
                        </div>
                    </div>
                </div>
            <!-- </form>  -->
        </main>

        </div>
        <!--<div class="main__img--container">
          <img id="main__img" src="alienuforetro-1952pd.svg" />
        </div>-->
      </div>
    </div>

    <!-- Services Section -->
    <div class="services">
      <div class="services__container">
        <div class="services__card">
          <h2>Already booked tickets?</h2>
          <p>See tickets here</p>
          <button> <a href="/SSL-Project/history/index.php">BUS TICKETS</a> </button>
        </div>
        <div class="services__card">
          <h2>Are you a freqeunt traveller?</h2>
          <p>Better purchase a bus pass</p>
          <button> <a href="/SSL-Project/bus_pass/index.php">BUS PASS</a> </button>
        </div>
      </div>
    </div>

    <!-- Footer Section -->
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
            <a href="/SSL-Project/contactus/index.php">Support</a>
            <a href="/SSL-Project/contactus/index.php">FAQs</a>
          </div>
          <div class="footer__link--items">
             <h2>&nbsp;&nbsp;&nbsp;More</h2>
             <a href="/SSL-Project/admin/index.php" class="navbar__links">Admin Portal</a>
             <a href="/SSL-Project/edit_profile/index.php" class="navbar__links">Edit profile</a>
             <a href="/SSL-Project/contactus/index.php" class="navbar__links">Enquiry</a>
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