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
    // echo $_SERVER["HTTP_REFERER"].'<br>';echo $_SERVER["HTTP_REFERER"];
    // echo $_SERVER["HTTP_REFERER"];
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/payment")) {
      $validPath = true;
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/payment/index.php")) {
        $validPath = true;
    }

    if(! $validPath){
      header('location: /SSL-Project/index.php');
    }
?>  
<?php
  include('../db.php');
  $number_of_seats = count($_POST["seat"]); 
  $sql_new_booking="INSERT INTO bookings(routeId,userId,paymentType,numberOfSeats) VALUES(".$_POST["routeId"].",".$_SESSION['userId'].",".$_POST["payment_type"].",".$number_of_seats.")";
  mysqli_query($conn,$sql_new_booking);
  $bookingId = $conn->insert_id;
  for ($i = 0; $i < $number_of_seats; $i++) {
    $seat_number=$_POST['seat'][$i];
    $sql_insert_seat_occupancy="UPDATE available SET seat$seat_number = '".$bookingId."_".($i+1)."' WHERE (routeId = ".$_POST["routeId"].");";
    // echo $sql_insert_seat_occupancy;echo '<br>';
    mysqli_query($conn,$sql_insert_seat_occupancy);
  }
  $sql_number_of_bookings="UPDATE `routes` SET `numberOfBookings` = numberOfBookings + $number_of_seats WHERE (`routeId` = '$_POST[routeId]');";
  mysqli_query($conn,$sql_number_of_bookings);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  .error {color: red;}
  </style>
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
    <script type="text/javascript" src="script.js"></script>
  </head>
  <div id="loader"></div>
  <div id="content">
  <script src="routes/routes.js"></script>
  <body style="background-color: white">
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
                          <a href="/SSL-Project" class="navbar__links">About&nbsp;Us</a>
                      </li>
                      ');
                      if($auth){
                      echo('
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
                  ?>
                </ul>
            </div>
        </nav>
        <?php
// define variables and set to empty values
$nameErr = $genderErr = $phonenoErr = $age ="";
$name = $email = $gender = $phoneno = $ageErr = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1 style="padding:10px;">Passenger Information</h1>

<?php
$i=0;

while ($i<$number_of_seats){

 echo '  <div class="form">
  <h3>Passenger '.($i+1).'</h3>
  <h3> Seat '.$_POST["seat"][$i].'</h3>
  <br>
  <form method="post" action="../history/index.php">
    Name <input type="text" name="name'.($i+1).'" required>
    <span class="error">* </span>
    <br><br>
    Age <input type="number" name="age'.($i+1).'" required>
    <span class="error">*</span>
    <br><br>
    Gender
    <span class="error">*</span>
    <br>
    <input type="radio" name="gender'.($i+1).'" value="Female" required > Female
    <br>
    <input type="radio" name="gender'.($i+1).'" value="Male" required > Male
    <br>
    <input type="radio" name="gender'.($i+1).'" value="Other" required > Other
    <br><br>
    Phone Number <input type="mobile" pattern="[0-9]{10}" name="phoneno'.($i+1).'">
    <br><br>
 </div>';
 $i=$i+1;

}
// $sql = "INSERT INTO `customers` (`customerId`, `name`, `phoneNumber`, `bookingId`, `seatAlloted`, `age`, `gender`) 
// VALUES( 1, $name, $phoneno, 1, 1,$age, $gender);";
// $conn->query($sql);
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
for ($i = 0; $i < $number_of_seats; $i++) {
  echo '<input type="hidden" name="seat[]" value="' . $_POST['seat'][$i] . '" >';
}
echo'<input type="text" name="bookingId" value="' . $bookingId . '" hidden>
<button class="main__btndate" type="submit">Proceed to pay</button>
</form>';
?>
<br><br><br><br><br><br>

</div>


    </body>
    </html>