<?php
    // if (session_status() === PHP_SESSION_ACTIVE)
    session_start();
    session_destroy();
    // echo session_status();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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
<!-- <script src="login.js"></script> -->
<body>
<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<nav class="navbar">
      <div class="navbar__container">
        <a href="/SSL-Project/index.php" id="navbar__logo"><i class="fas fa-bus"></i>HOME</a>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span> <span class="bar"></span>
          <span class="bar"></span> 
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <!-- <a href="/SSL-Project/signin/index.php" class="navbar__links">BUS&nbsp;PASS</a> -->
          </li>
          <li class="navbar__item">
            <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
          </li>
          <!-- <li class="navbar__btn"><a href="/" class="button">BUS TICKETS</a></li> -->
        </ul>
      </div>
    </nav>
    <div class="container">
                <div class="form">
                <div class="prof">
                    <div>
                        <br>
                        <?php 
                              $conn = mysqli_connect("localhost","root","","bus_service_system");
                              if($conn === false){
                                die("ERROR: Could not connect. "
                                    . mysqli_connect_error());
                            }
                       
                        
                                      $sql="UPDATE users
                                      SET userName = '".$_REQUEST["nusername"]."', 
                                      pass_word = '".$_REQUEST["npassword"]."',
                                    email = '".$_REQUEST["email"]."', firstName = '".$_REQUEST["firstName"]."',
                                    lastName ='". $_REQUEST["lastName"]."'
                                      WHERE userName ='". $_REQUEST["ousername"] ."'";
                                      $res=mysqli_query($conn,$sql);
                                    
                                      if(mysqli_query($conn, $sql)){
                                        echo "<h3>Your profile is updated <br>successfully!!!</h3>";
                                    
                                    } else{
                                        echo "ERROR: Hush! Sorry $sql. "
                                            . mysqli_error($conn);
                                    }
                                     
                                    // Close connection
                                    mysqli_close($conn);      
                                  
                              
                        
                        ?>
                          </div>
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
