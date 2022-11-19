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
    $invalidCredentials=false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project")) {
        $authorized = true;
        // echo'<div>**********From SSLP***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/index.php")) {
        $authorized = true;
        // echo'<div>**********From SSLP index***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin/register.php")) {
        $authorized = true;
        // echo'<div>**********From register***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/routes/index.php")) {
        $authorized = true;
        // echo'<div>**********From register***********</div>';
    }

    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/signin/index.php")) {
        include('../db.php');
        // echo password_hash(test_input($_POST["password"]), PASSWORD_DEFAULT)."<br>";
        // echo $_POST["password"]."<br>";
        // $passHash=password_hash(test_input($_POST["password"]), PASSWORD_DEFAULT);
        $passHash=$_POST["password"];
        $sql="SELECT userId AS id FROM users WHERE userName ='".test_input($_POST["username"])."' AND pass_word = '".$passHash."' ;";
        $user=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($user);
        if ($count<=0) {
            $authorized = true;
            $invalidCredentials=true;
        } else {
            session_start();
            while($row=mysqli_fetch_assoc($user)){
                $_SESSION["userId"] = $row['id'];
            }
            // echo('user id '.$_SESSION["userId"].'::');
            $_SESSION["username"] = test_input($_POST["username"]);
            $_SESSION["password"] = $passHash;
            header('Location: /SSL-Project');
        }
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

    <div class="univ flex-center">
        <div id="signin-body">
            <div class="toggle">
                <div class="tgl-btn-active flex-center">Sign-In</div>
                <form class="tgl-btn-deactive flex-center cp" action="register.php" method="post">
                    <button type="submit" class="toggleButton cp">Register</button>
                </form>
            </div>
            <div class="container">
                <div class="form">
                    <div>
                        <br>
                        <?php
                         if($authorized){
                            echo('
                                <form id="signInForm" autocomplete="off" action="./index.php" method="post">');
                                    if($invalidCredentials){echo('<p style="color:red;">Invalid username or password!</p><br>');}
                                    echo('<label for="username">Username</label><br>
                                    <input type="text" id="username" size="22" name="username" placeholder="Please enter your username" required><br><br>
                                    <label for="password">Password</label><br>
                                    <input type="password" id="password" size="22" name="password" placeholder="Please enter your password" required>
                                    <div class="submission">
                                        <button class="cp" type="submit">Sign In</button><br><br>
                                    </div>
                                </form>
                            ');
                         }
                         else{
                            echo('
                                <div class="fc"><p>Unauthorized Access!</p></div>
                            ');
                        }
                        ?>
                    </div>
                </div>
                <?php
                        echo('
                            <div class="moreOptions">
                                <div style="text-align: center;">');
                                    if($authorized){echo('<a href="/SSL-Project/contactus/index.php">Forgot Password ?</a><br><br>');}
                                    echo('<a href="/SSL-Project/contactus/index.php">Contact Us</a>
                                </div>
                            </div>
                        ');
                ?>

    <br><br><br><br>
    </div>
        </div>
    </div>

    <div class="footer__container">
      <div class="footer__links">
        <div class="footer__link--wrapper">
          <div class="footer__link--items">
            <h2>About Us</h2>
            <a href="/SSL-Project/about_us/index.php">About&nbsp;Us</a>
            <a href="/SSL-Project/bus_pass/index.php">Bus&nbsp;Pass</a>
            <a href="/SSL-Project/
            us/index.php">Help</a> 
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