<?php
// echo $_SERVER["HTTP_REFERER"];
// echo '<br>';
// echo $_SERVER["HTTP_REFERER"];
// echo '<br>';
?>
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
<body >
<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<?php 
    //ADD COMPLAINT/QUERY
    $edit_mail=false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/edit_profile/index.php")) {
      $edit_mail=true;
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/edit_profile")) {
      $edit_mail=true;
    }
    if($edit_mail){
      if(isset($_POST["password"]) && isset($_POST["email"]))
      {
        include('../db.php');
        $sql_check_password="SELECT pass_word from users WHERE userId = $_SESSION[userId] ;";
        $res=mysqli_query($conn,$sql_check_password);
        $row=mysqli_fetch_assoc($res);
        if(strcmp($_POST["password"],$row["pass_word"])==0){
          $sql_change_email="UPDATE `users` SET `email` = '$_POST[email]' WHERE (`userId` = '$_SESSION[userId]');";
          $res=mysqli_query($conn,$sql_change_email);
          echo('
          <div style="width:100%; background:lime;color:green;padding:10px;">
            Your email has been changed!
          </div>
          ');
        }
        else{
          echo('
          <div style="width:100%; background:lime;color:brown;padding:10px;">
            Email change request denied (wrong password)!
          </div>
          ');
        }
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
            <a href="/SSL-Project/index.php" class="navbar__links">Home</a>
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
          <div>
              <br>
              <?php 
                include('../db.php');
                $sql_place = "SELECT * from users WHERE userId='".$_SESSION["userId"]."';";
                $res=mysqli_query($conn,$sql_place);
                if(mysqli_num_rows($res)>0){
                    $row=mysqli_fetch_assoc($res);
                    echo('
                      <p>Hi '.$row["firstName"].'</p>
                      <p>Your username is <b>'.$row["userName"].'</b></p><br>
                      ');
                    if(strlen($row["email"])>0){
                      echo('
                        <p>Your linked email is <b>'.$row["email"].'</b></p><br>
                        <p style="font-size:16px;">If you wish to change your linked email, 
                        please provide the following details: </p><br>
                      ');
                    }
                    else{
                      echo('
                        <p>Your don\'t have any linked email </b></p><br>
                        <p style="font-size:16px;">If you wish to change your linked email, 
                        please provide the following details: </p><br>
                      ');
                    }
                  }
              ?>
              <form action="./index.php" method="post">    
                <label for="email">New Email<span style="color:red;">*</span></label><br><br>
                <input type="email" id="email" size="22" name="email" placeholder="Provide new email" required><br><br>
                <label for="password">Password<span style="color:red;">*</span></label><br><br>
                <input type="password" id="password" size="22" name="password" placeholder="Enter your password" required><br><br>
                <div class="submission">
                    <button class="main__btn" type="submit">Submit</button><br><br>
                </div>
              </form>
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
