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
                    <div>
                        <br>
                        
                                  <form  action="change.php" method="post">
                                        <label for="username">Username<span style="color:red;">*</span></label><br>
                                        <input type="text" id="username" size="22" name="username" value="" style="padding:2px 7px" required><br>
                                        <label for="npassword">New Password<span style="color:red;">*</span></label><br>
                                        <input type="password" id="npassword" size="22" name="npassword" placeholder="Please set password" required><br><br>
                                        
                                        <div class="submission">
                                            <button class="cp" type="submit">Submit</button><br><br>
                                        </div>
                                  </form>
                    </div>
                </div>
                
    </div>
</body>
</html>
