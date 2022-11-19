<?php
    // if (session_status() === PHP_SESSION_ACTIVE)
    session_start();
    session_destroy();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
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
<?php
    $authorized = false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/index.php")) {
        $authorized = true;
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin")) {
        $authorized = true;
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
            <!-- <a href="/SSL-Project/signin/index.php" class="navbar__links">LOG&nbsp;IN</a> -->
            <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
          </li>
          <!-- <li class="navbar__btn"><a href="/" class="button">BUS TICKETS</a></li> -->
        </ul>
      </div>
    </nav>
    
    <div class="univ flex-center">
        <div id="register-body">
            <div class="toggle">
                <form class="tgl-btn-deactive flex-center cp" action="index.php" method="post">
                    <button type="submit" class="toggleButton cp">Sign-In</button>
                </form>
                <div class="tgl-btn-active flex-center">Register</div>
            </div>
            <div class="container">
                <div class="form">
                    <div>
                        <br>
                        <?php 

                        if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "register.php")) {
                            if(array_key_exists('username', $_POST)) {
                                $userName=$_POST["username"];
                                $userName=test_input($userName);
                                include('../db.php');
                                $sql="SELECT userName FROM users where userName='".$userName."';";
                                $res=mysqli_query($conn,$sql);
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    echo ('<h5>Username \'<span style="color:rgb(196, 51, 51)">'.$userName.'</span>\' is already taken</h5><br>
                                    <form id="registerForm" autocomplete="off" action="register.php" method="post">
                                        <label for="r1-username" ><p>Username</p><span style="color:red;">*<br><br></span></label>
                                        <input type="text" id="r1-username" size="22" name="username" placeholder="Please set username" required><br>
                                        <div class="submission">
                                            <button class="cp" type="submit">Check Username</button><br><br>
                                        </div>
                                    </form>
                                    ');
                                }
                                else{
                                    // <label for="r2-username">Username<span style="color:red;">*</span></label>
                                    // <input type="text" id="r2-username" size="22" name="username" value="'.$userName.'" style="padding:2px 7px" disabled><br>
                                    echo('
                                    <form id="registerForm" autocomplete="off" action="../index.php" method="post">
                                        <input type="hidden" id="r2-username" size="22" name="username" value="'.$userName.'" style="padding:2px 7px">
                                        <p style="padding-left:2px;font-size:18px">Username \'<span style="color:blue"><b>'.$userName.'</b></span>\' is available</p><br>
                                        <label for="firstName">First Name<span style="color:red;">*</span></label><br>
                                        <input type="text" id="firstName" size="22" name="firstName" placeholder="Please provide first name" required><br><br>
                                        <label for="lastName">Last Name</label><br>
                                        <input type="text" id="lastName" size="22" name="lastName" placeholder="Please provide last name"><br><br>
                                        <label for="r2-password">Password<span style="color:red;">*</span></label><br>
                                        <input type="password" id="r2-password" size="22" name="password" placeholder="Please set password" required><br><br>
                                        <label for="email">Email</label><br>
                                        <input type="email" id="email" size="22" name="email" placeholder="Please provide email"><br><br>
                                       
                                        <div class="submission">
                                            <button class="cp" type="submit">Register</button><br><br>
                                        </div>
                                    </form>
                                    ');    
                                }
                            }
                        }
                        else if($authorized){
                            echo('
                            <form id="registerForm" autocomplete="off" action="register.php" method="post">
                                <label for="r1-username">Username<span style="color:red;">*</span></label><br>
                                <input type="text" id="r1-username" size="22" name="username" placeholder="Please set username" required><br>
                                <div class="submission">
                                    <button class="cp" type="submit">Check Username</button><br><br>
                                </div>
                            </form>
                            ');
                        }
                        else{
                            echo('
                                <div class="fc" style="margin-bottom:40px;"><p>Unauthorized Access!</p></div>
                            ');
                        }
                        ?>
                    </div>
                </div>
                <div class="moreOptions">
                    <div style="text-align: center; margin-top:-20px;padding-bottom:25px;">
                        <a href="/SSL_Project/contactus/index.php">Contact Us</a>
                    </div>
                </div>
              
            </div>
            <br><br><br><br><br><br><br>
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