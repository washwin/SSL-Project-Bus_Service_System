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
    <title>Routes</title>
    <link rel="stylesheet" href="routes.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
</head>
<script src="routes.js"></script>
<body>
    <div class="univ">
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
                <!-- <li class="navbar__item">
                    <a href="C:\Users\Admin\OneDrive\Documents\IITDh documents\sem3\SSL\Project Bus System\tech.html" class="navbar__links">SIGN&nbsp;IN</a>
                </li> -->
                <!-- <li class="navbar__item">
                    <a href="/" class="navbar__links">SIGN_UP</a>
                </li> -->
                <!-- <li class="navbar__btn"><a href="/" class="button">Booking&nbsp;History</a></li> -->
                </ul>
            </div>
        </nav>

        <main>
            <form name="filter" action="#availableRoutes" method="post" style="width:100%;">
                <div class="searchSection">
                    <div class="searchContainer">
                        <div id="search-from">
                            <p style="color:white;opacity:0.9;padding:0 0 0 8px;font-size:25px;">Boarding City</p>
                            <?php 
                                if(array_key_exists('fromCity', $_POST)) {
                                    echo('
                                        <input id="input-from" class="main__btn" value="'.$_POST["fromCity"].'" type="text" size="16" placeholder=" FROM" onkeyup="javascript:searchPlaces(\'from\',this.value)" name="fromCity" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="input-from" class="main__btn" type="text" size="16" placeholder=" FROM" onkeyup="javascript:searchPlaces(\'from\',this.value)" name="fromCity" required>
                                    ');
                                }
                            ?>
                            <span id="from-suggestions"></span>
                        </div>
                        <div>
                        <br><br>
                            <button class="main__btn" onclick="javascript:swapToAndFrom(event)">
                                  Swap
                            </button>
                        </div>
                        <div>
                            <p style="color:white;opacity:0.9;padding:0 0 0 8px;font-size:25px;">Destination City</p>
                            <?php 
                                if(array_key_exists('toCity', $_POST)) {
                                    echo('
                                        <input id="input-to" class="main__btn" value="'.$_POST["toCity"].'" type="text" size="16" placeholder=" TO" onkeyup="javascript:searchPlaces(\'to\',this.value)" name="toCity" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="input-to" class="main__btn" type="text" size="16" placeholder=" TO" onkeyup="javascript:searchPlaces(\'to\',this.value)" name="toCity" required>
                                    ');
                                }
                            ?>
                            <span id="to-suggestions"></span>
                        </div>
                        <div class="dateSelector">
                            <p style="color:white;opacity:0.9;padding:0 0 0 8px;font-size:25px;">Journey Date</p>
                            <?php
                                if(array_key_exists('date', $_POST)) {
                                    echo('
                                        <input id="date" class="main__btndate" type="date" value="'.$_POST["date"].'" class="search-date" name="date" required>
                                    ');
                                }
                                else{
                                    echo('
                                        <input id="date" class="main__btndate" type="date"  name="date" required>
                                    ');
                                }
                            ?>
                        </div>
                        
                        <button class="main__btn" type="submit">Search</button>
                    </div>
                </div>
            <!-- </form>  -->
        </main>

        <section id="availableRoutes">
            <!-- <div class="routeContainer">
                <div class="routeCard">
                    <div class="routeFrom">
                        <div class="routeCityLabel">From:</div>
                        <div class="routeCity">Nagpur</div>
                        <div class="routeTime">At: <b>21:55</b></div>
                        <div class="routeDate">15 Oct, 2022</div>
                    </div>
                    <div class="routeFrom">
                        <div class="routeCityLabel">To:</div>
                        <div class="routeCity">Pune</div>
                        <div class="routeTime">At: <b>11:30</b></div>
                        <div class="routeDate">16 Oct, 2022</div>
                    </div>
                    <div class="routeDuration">08hr 26min</div>
                    <div class="routeFare">INR 1250</div>
                    <div class="routeBookings">2 Seats Booked</div>
                    <div class="routeBookingsLeft">28 Seats Available</div>
                </div>
                <div class="routeBook">    
                    <button class="bookRoute">Book&nbsp;Now</button>
                </div>
            </div> -->
            
            <?php 
                function sanitize_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                function getPlaceId($place){
                    include('../db.php');
                    $place = sanitize_input($place);
                    $sql_place = "SELECT placeId from places WHERE placeName='".$place."';";
                    $res=mysqli_query($conn,$sql_place);
                    if(mysqli_num_rows($res)>0){
                        $row=mysqli_fetch_assoc($res);
                        return $row['placeId'];
                    }
                    return -1;
                }
                
                function getBusCapacity($busId){
                    $sql_bus="SELECT capacity FROM buses WHERE busId=".$busId." ;";
                    include('../db.php');
                    $res=mysqli_query($conn,$sql_bus);
                    if(mysqli_num_rows($res)>0){
                        $row=mysqli_fetch_assoc($res);
                        return $row['capacity'];
                    }
                    return -1;
                }
                ?>
            <?php 
                 if(array_key_exists('fromCity', $_POST) && array_key_exists('toCity', $_POST) && array_key_exists('date', $_POST) ) {
                    include('../db.php');
                    $fromCity = getPlaceId($_POST['fromCity']);
                    $toCity = getPlaceId($_POST['toCity']);
                    $flag=true;
                    if($fromCity==-1||$toCity==-1){
                        $flag=false;
                    }
                    // echo ($fromCity."  ".$toCity."<br><br>");
                    $sql_routes="SELECT * FROM routes where startingPoint=".$fromCity." and endingPoint=".$toCity." and DATE_FORMAT(startingTime, '%Y-%m-%d') = '".$_POST["date"]."' and routeStatus=1 ";
                    if(array_key_exists('sortBy', $_POST)){
                        $args = explode("_",$_POST["sortBy"]);
                        $sql_routes = $sql_routes.'ORDER BY '.$args[0].' '.$args[1];
                    }
                    $sql_routes = $sql_routes.' ;';
                    // echo $sql_routes;
                    $routes=mysqli_query($conn,$sql_routes);
                    $count=mysqli_num_rows($routes);
                    if($count>0){
                        echo('
                        <div class="leftPanel">
                        <h3>Sort By</h3>
                                <!-- <form action="#availableRoutes" method="post"> -->
                                <div class="sortingCard">
                                    <h4>'.$_POST['fromCity'].' Time</h4>
                                    <div class="fc"><input type="radio" id="startingTime_ASC" name="sortBy" value="startingTime_ASC"><label for="startingTime_ASC" style="font-size:15px">&nbsp;Ascending</label></div>
                                    <div class="fc"><input type="radio" id="startingTime_DESC" name="sortBy" value="startingTime_DESC"><label for="startingTime_DESC" style="font-size:15px">&nbsp;Descending</label></div>
                                </div>
                                <div class="sortingCard">
                                    <h4>'.$_POST['toCity'].' Time</h4>
                                    <div class="fc"><input type="radio" id="endingTime_ASC" name="sortBy" value="endingTime_ASC"><label for="endingTime_ASC" style="font-size:15px">&nbsp;Ascending</label></div>
                                    <div class="fc"><input type="radio" id="endingTime_DESC" name="sortBy" value="endingTime_DESC"><label for="endingTime_DESC" style="font-size:15px">&nbsp;Descending</label></div>
                                </div>
                                <div class="sortingCard">
                                    <h4>Fare</h4>
                                    <div class="fc"><input type="radio" id="fare_ASC" name="sortBy" value="fare_ASC"><label for="fare_ASC" style="font-size:15px">&nbsp;Ascending</label></div>
                                    <div class="fc"><input type="radio" id="fare_DESC" name="sortBy" value="fare_DESC"><label for="fare_DESC" style="font-size:15px">&nbsp;Descending</label></div>
                                </div>
                                <button type="submit" class="main__btn">Apply</button>
                            </form>
                        </div>
                        ');
                        echo('<div class="rightPanel">');
                        while($row=mysqli_fetch_assoc($routes)){
                            // $newdateformat = date("D, d M Y H:i:s", strtotime($row["startingTime"]));echo($newdateformat);
                            // echo(
                            //     $row["routeId"].' '.$row["startingPoint"].' '.$row["endingPoint"].' '
                            //     .$row["startingTime"].' '.$row["endingTime"].' '.$row["travelTime"].' '
                            //     .$row["fare"].' '.$row["busId"].' '.$row["numberOfBookings"]."<br>"
                            // );
                            echo('
                                <div class="routeContainer">
                                    <div class="routeCard">
                                        <div class="routeFrom">
                                            <div class="routeCityLabel">From:</div>
                                            <div class="routeCity">'.$_POST['fromCity'].'</div>
                                            <div class="routeTime">At: <b style="color: #8b0224;">'.substr($row["startingTime"],11,5).'</b></div>
                                            <div class="routeDate"><span  style="color: #8b0224;">'.substr(date("D, d M Y H:i:s", strtotime($row["startingTime"])),0,12).'</span> '.substr($row["startingTime"],0,4).'</div>
                                        </div>
                                        <div class="routeFrom">
                                            <div class="routeCityLabel">To:</div>
                                            <div class="routeCity">'.$_POST['toCity'].'</div>
                                            <div class="routeTime">At: <b style="color: #8b0224;">'.substr($row["endingTime"],11,5).'</b></div>
                                            <div class="routeDate"><span  style="color: #8b0224;">'.substr(date("D, d M Y H:i:s", strtotime($row["endingTime"])),0,12).'</span> '.substr($row["endingTime"],0,4).'</div>
                                        </div>
                                        <div class="routeDuration">');echo(date_diff(new DateTime($row['startingTime']), new DateTime($row['endingTime']))->format('%Hhrs %Imin'));echo('</div>
                                        <div class="routeFare">INR '.$row["fare"].'</div>
                                        <div style="text-align:center;margin-top:-10px;">
                                            <div class="routeBookings">'.$row["numberOfBookings"].' Seats Booked</div>
                                            <div class="routeBookingsLeft">'.(getBusCapacity($row['busId'])-$row["numberOfBookings"]).' Seats Available</div>
                                        </div>
                                    </div>');
                                    if($auth){
                                        echo('
                                            <div class="routeBook">    
                                                <form name="routeData" action="/SSL-Project/availability" method="get">
                                                    <input type="hidden" name="route_ID" value="'.$row['routeId'].'">
                                                    <button class="bookRoute" type="submit">Book&nbsp;Now</button>
                                                </form>
                                            </div>
                                        ');
                                    }
                                    else{
                                        echo('
                                            <div class="routeBook">    
                                                <a href="/SSL-Project/signin/index.php"><button class="bookRoute">SignIn & Book&nbsp;Now</button></a>
                                            </div>
                                        ');
                                    }
                                    echo('
                                </div>
                            ');
                        }
                        echo ('</div>');
                    }
                    else{
                        $flag=false;
                    }
                    if($flag==false){
                        echo "</form><br><br><div style='width:100%;text-align:center;'>No Routes Available !<div><br>";
                    }
                }
            ?>
        </section>
        <!-- <div class="routeBook">    
            <form action="/SSL-Project/availability" method="POST">
                <input type="number" name="route_ID" value="99">
                <button class="bookRoute" type="submit">Book&nbsp;Now</button>
            </form>
        </div> -->
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