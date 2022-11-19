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
<?php
    $validPath = false;
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/history/index.php")) {
        $validPath = true;
        // echo'<div>**********From SSLP***********</div>';
    }
    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "/SSL-Project/history")) {
    $validPath = true;
    // echo'<div>**********From SSLP***********</div>';
    }
    if(! $validPath){
    header('location: /SSL-Project/history/index.php');
    }
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking History</title>
    <link rel="stylesheet" href="print.css">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
</head>
<script src="print.js"></script>
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
                        <div class="profileMenuContent"><a href="/SSL-project/edit_profile/index.php">Edit&nbsp;Profile</a></div>
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

        <main>
            <div id="card_container">
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
                        include('../../db.php');
                        $sql_place = "SELECT placeName from places WHERE placeId='".$placeId."';";
                        $res=mysqli_query($conn,$sql_place);
                        if(mysqli_num_rows($res)>0){
                            $row=mysqli_fetch_assoc($res);
                            return $row['placeName'];
                        }
                        return "error";
                    }

                    include('../../db.php');
                    $sql_bookings="SELECT * FROM bookings where bookingId = ".$_POST["bookingId"]." ;";
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
                            echo('<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SSL Bus Services</h1><br>
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
                                    <!--<div class="printBtn">
                                        <a href="../"><button class="print">Print</button></a>
                                    </div>-->
                                </div>
                            ');
                            $sql_bus="SELECT numberPlate FROM buses where busId = ".$route["busId"]." ;";
                            $route_bus=mysqli_query($conn,$sql_bus);
                            $row_bus=mysqli_fetch_assoc($route_bus);
                            echo'<div style="width:85%;text-align:center;background:rgb(152, 141, 141);margin:0px auto;border-left:2px solid rgb(212, 205, 205);border-right:2px solid rgb(212, 205, 205);"><b>Bus Number: '.$row_bus["numberPlate"].'</b></div>';
                            echo '<div class="customer_container">';
                            for($i=1;$i<=$row["numberOfSeats"];$i++){
                                $sql_customer="SELECT * FROM customers where customerId = '".$row["bookingId"]."_".$i."' ;";
                                $customer_data=mysqli_query($conn,$sql_customer);
                                $count_cus=mysqli_num_rows($customer_data);
                                if($count_cus>0){
                                    $customer_row=mysqli_fetch_assoc($customer_data);
                                    echo ('
                                        <div class="customer_info">
                                            <p>Name: '.$customer_row["name"].'</p>
                                            <p>Age: '.$customer_row["age"].'</p>
                                            <p>Gender: '.$customer_row["gender"].'</p>
                                            <p>Phone Number: '.$customer_row["phoneNumber"].'</p>
                                            <p>Seat No: '.$customer_row["seatAlloted"].'</p>    
                                        </div>
                                    ');
                                }
                                else{
                                    echo ('
                                        <div class="customer_info">
                                            <p>Customer data not available!</p> 
                                        </div>
                                    ');
                                }
                            }
                            echo('</div>');
                        }
                    }
                ?>
                <div style="width:100%;text-align:center;">
                    <button class="printBtn" onclick="window.print()">Print</button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>