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
    <title>Booking History</title>
    <link rel="stylesheet" href="history.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
</head>
<script src="routes.js"></script>
<?php
    $uploadData=false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/customer_info/index.php")) {
        $uploadData=true;
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/customer_info")) {
        $uploadData=true;
    }
    if($uploadData && isset($_POST["bookingId"])){
        include('../db.php');
        $bookingId=$_POST["bookingId"];
        for ($i=1; $i<=count($_POST["seat"]);$i++)
        {
            $name=$_POST["name$i"];
            $gender=$_POST["gender$i"];
            $phoneno='';
            if(isset($POST_["phoneno"]))$phoneno=$_POST["phoneno$i"];
            $age=$_POST["age$i"];
            $sql_add="INSERT INTO customers(customerId,name,phoneNumber,gender,age,seatAlloted) 
            VALUES ('".$bookingId."_".$i."', '$name', '$phoneno', '$gender', $age, ".$_POST['seat'][($i-1)].")";
            $res = $conn->query($sql_add);
        }
    }
?>
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
                            <a href="/SSL-Project/routes" class="navbar__links">Search&nbsp;Route</a>
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
                            <div class="profileMenuContent"><a href="/SSL-project/edit_profile/index.php">Edit&nbsp;Profile</a></div>
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

        <main>
            <div class="card_container">
                <!-- <div class="ticket_card">
                    <div class="routeFrom">
                        <div class="routeCityLabel">From:</div>
                        <div class="routeCity">Nagpur</div>
                        <div class="routeTime">At: <b style="color: #8b0224;">11:30</b></div>
                        <div class="routeDate"><span  style="color: #8b0224;">Wed, 12 Oct</span> 2022</div>
                    </div>
                    <div class="routeFrom">
                        <div class="routeCityLabel">To:</div>
                        <div class="routeCity">Pune</div>
                        <div class="routeTime">At: <b style="color: #8b0224;">12:30</b></div>
                        <div class="routeDate"><span  style="color: #8b0224;">Wed, 12 Oct</span> 2022</div>
                    </div>
                    <div class="routeFrom">
                        <div class="routeCityLabel">Duration: 11hr 50min</div>
                        <div class="routeTime">Fare: <b style="color: #8b0224;">INR 1250</b></div>
                        <div class="routeCityLabel">Number of Seats: 2</div>
                    </div>
                    <div class="printBtn">
                        <a href="../"><button class="print">Print</button></a>
                    </div>
                </div> -->

                <?php

                    function getPlaceId($placeId){
                        include('../db.php');
                        $sql_place = "SELECT placeName from places WHERE placeId='".$placeId."';";
                        $res=mysqli_query($conn,$sql_place);
                        if(mysqli_num_rows($res)>0){
                            $row=mysqli_fetch_assoc($res);
                            return $row['placeName'];
                        }
                        return "error";
                    }

                    include('../db.php');
                    $sql_bookings="SELECT * FROM bookings where userId = ".$_SESSION["userId"]." ORDER BY bookingDate DESC;";
                    $bookings=mysqli_query($conn,$sql_bookings);
                    $count=mysqli_num_rows($bookings);
                    if($count>0){
                        while($row=mysqli_fetch_assoc($bookings)){
                            $sql_route="SELECT * FROM routes where routeId = ".$row["routeId"]." ;";
                            $route_query=mysqli_query($conn,$sql_route);
                            $route=mysqli_fetch_assoc($route_query);
                            // $maxDate = date("Y-m-d H:i:s", strtotime($route["endingTime"]));
                            // $now = date("Y-m-d H:i:s");
                            // echo(date_diff(new DateTime($maxDate),new DateTime($now)));
                            // if(date_diff(new DateTime($maxDate),new DateTime($now))){
                            //     echo('<div class="ticket_card bg-active">1');
                            // }
                            // else{
                            //     echo('<div class="ticket_card bg-active">2');
                            // }
                            echo('
                                <div class="ticket_card">
                                    <div class="routeFrom">
                                        <div class="routeCityLabel">From:</div>
                                        <div class="routeCity">'.getPlaceId($route["startingPoint"]).'</div>
                                        <div class="routeTime">At: <b style="color: #8b0224;">'.substr($route["startingTime"],11,5).'</b></div>
                                        <div class="routeDate"><span  style="color: #8b0224;">'.substr(date("D, d M Y H:i:s", strtotime($route["startingTime"])),0,12).'</span> '.substr($route["startingTime"],0,4).'</div>
                                    </div>
                                    <div class="routeFrom">
                                        <div class="routeCityLabel">To:</div>
                                        <div class="routeCity">'.getPlaceId($route["endingPoint"]).'</div>
                                        <div class="routeTime">At: <b style="color: #8b0224;">'.substr($route["endingTime"],11,5).'</b></div>
                                        <div class="routeDate"><span  style="color: #8b0224;">'.substr(date("D, d M Y H:i:s", strtotime($route["endingTime"])),0,12).'</span> '.substr($route["endingTime"],0,4).'</div>
                                    </div>
                                    <div class="routeFrom">
                                        <div class="routeCityLabel">Duration: '.date_diff(new DateTime($route['startingTime']), new DateTime($route['endingTime']))->format('%H hrs %I min').'</div>
                                        <div class="routeTime">Fare: <b style="color: #8b0224;">INR '.$route["fare"].'</b></div>
                                        <div class="routeCityLabel">Number of Seats: '.$row["numberOfSeats"].'</div>
                                    </div>
                                    <div class="printBtn">
                                        <form action="./print/index.php" method="post">
                                            <input type="hidden" name="bookingId" value="'.$row["bookingId"].'">
                                            <button class="print">Print</button>
                                        </form>
                                    </div>
                                </div>
                            ');
                        }
                    }
                    else{
                        echo('
                            <div class="ticket_card">
                                <br>You don\'t have any bookings yet<br><br>
                            </div>
                            <div style="width:100%;text-align:center">
                                <a href="/SSL-Project/routes">Explore Routes</a><br><br>
                            </div>
                        ');
                    }
                ?>
            </div>
        </main>
    </div>
</body>
</html>