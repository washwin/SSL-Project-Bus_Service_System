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

    $validPath = false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/availability/index.php")) {
        $validPath = true;
        // echo'<div>**********From SSLP***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/availability/")) {
      $validPath = true;
      // echo'<div>**********From SSLP***********</div>';
    }
    

    if(! $validPath){
      header('location: /SSL-Project/index.php');
    }

    if(!isset($_POST["seat"])) header('location: /SSL-Project/index.php');
?>  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SSL BUS Services</title>
  <link rel="stylesheet" href="styles1.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body style="background-color: rgb(90, 90, 90)">
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
        if ($auth) {
          echo ('
            <li class="navbar__item">
              <a href="/SSL-Project/history/index.php" class="navbar__links">Booking&nbsp;History</a>
            </li>
            <li class="navbar__item">
                <a href="/SSL-Project" class="navbar__links">Home</a>
            </li>
            <li class="navbar__item">
              <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
            </li>
            <li class="navbar__item">
                <a href="/SSL-Project" class="navbar__links">About&nbsp;Us</a>
            </li>
            <li class="navbar_item profileSection">
              <img src="https://cdn.iconscout.com/icon/free/png-256/profile-417-1163876.png" alt="Avatar" class="avatar">
              <div class="profileContent">
                  <div class="profileMenuContent">Edit Profile</div>
                  <div class="profileMenuContent">Bookings</div>
                  <div class="profileMenuContent">Bus&nbsp;Pass</div>
                  <div class="profileMenuContent">Help</div>
                  <div class="profileMenuContent"><a href="/SSL-Project/signin/index.php">Logout</a></div>
              </div>
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
            <li class="navbar__item">
                <a href="/SSL-Project" class="navbar__links">About&nbsp;Us</a>
            </li>
          ');
        }
        ?>
      </ul>
    </div>
  </nav>
  <h1>&nbsp&nbsp Payment Options</h1>
  <?php
    $number_of_seats = count($_POST["seat"]);
    $route_id = $_POST["routeId"];
    $valid_bus_pass=false;
    include('../db.php');
    $fare = $conn->query("SELECT fare FROM routes WHERE routeId=$route_id");
    $row = mysqli_fetch_assoc($fare);
    $bus_pass= $conn->query("Select * from bus_pass where busPassId = '".$_SESSION['userId']."_bp' ;");
    $count=mysqli_num_rows($bus_pass);
    if($count>0){
      $sql_check_time="Select * from bus_pass where busPassId = '".$_SESSION['userId']."_bp' and DATE(validTill) >= DATE(NOW()) ;";
      $res_check_time=mysqli_query($conn,$sql_check_time);
      $count=mysqli_num_rows($res_check_time);
      if($count>0){
        $valid_bus_pass=true;
      }
    }
    ?>
  <div class="form">
    <h3>Total Amount : INR <?php echo $row["fare"] * $number_of_seats; ?> </h3>
    <br><br>
    <form method="POST" action="/SSL-Project/customer_info/index.php">
      <input type="radio" name="payment_type" value="3" id="cc" required><label for="cc"> Credit card </label>
      <br><br>
      <input type="radio" name="payment_type" value="2" id="dc" required><label for="dc"> Debit card </label>
      <br><br>
      <input type="radio" name="payment_type" value="4" id="upi" required><label for="upi"> UPI </label>
      <br><br>
      <?php 
        if($valid_bus_pass){
          if($number_of_seats==1){
            echo('
              <input type="radio" name="payment_type" value="5" id="pass" required><label for="pass"> Bus Pass  </label>
            ');
          }
          else{
            echo('
              <input type="radio" name="payment_type" value="5" id="pass" disabled><label for="pass" style="color:grey"> Bus Pass (Can be used for 1 seat booking only)</label>
            ');
          }
        }
        else{
          echo('
            <input type="radio" id="busPass" disabled> <label id="busPass" style="color:grey;">Bus Pass</label>
            <a href="/SSL-Project/bus_pass/index.php" style="color:grey" onMouseOver="this.style.color=\'blue\'" onMouseOut="this.style.color=\'grey\'">Buy Now</a>
          ');
        }
      ?>
      <br>
      <br>
      <?php
      if($number_of_seats>0)for ($i = 0; $i < $number_of_seats; $i++) {
        echo '<input type="hidden" name="seat[]" value="' . $_POST['seat'][$i] . '" >';
      }
      echo '<input type="hidden" name="routeId" value="' . $_POST['routeId'] . '" >';
      ?>
      <button class="main__btndate" type="submit">Proceed to pay</button>
    </form>
  </div>
</body>

</html>
