<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="styleadmin.css">
</head>
<body>

<div class="header flex-c<h3> Enter">
<h1> Add/ modify/ remove routes </h1>
</div>

<div>
<form action = "" method="post">
    <h2> Add a new route: <br> </h2>
    <h3> Enter Starting Point : <input type='number' name = 'startpoint' required placeholder='Ex: 1'><br> </h3>
    <h3> Enter Ending Point : <input type='number' name = 'endpoint' required placeholder='Ex: 6'><br> </h3>
    <h3> Enter Starting Time : <input type='datetime-local' name = 'starttime' required placeholder='Ex: 2022-10-05 8:00'><br> </h3>
    <h3> Enter Ending Time : <input type='datetime-local' name = 'endtime' required placeholder='Ex: 2022-10-05 18:00'><br> </h3>
    <h3> Enter Travel Time : <input type='number' name = 'traveltime' required placeholder='Ex: 240'><br> </h3>
    <h3> Enter Fare : <input type='number' name = 'fare' required placeholder='Ex: 1000'><br> </h3>
    <h3> Enter Bus ID : <input type='number' name = 'busid' required placeholder='Ex: 5'><br> </h3>

    <!-- <h3> Enter bus capacity : <input type='number' name = 'capacity' required placeholder='Ex: 45'><br> </h3> -->
    <input type = 'submit' name = 'add' value ='Add'> 
</form>
</div>

<div>
<form action = "" method="post">
    <h2> Remove an existing route: <br> </h2>
    <h3> Enter Route ID to be removed : <input type='number' name = 'remroute' required placeholder='Ex: 2'><br> </h3>
    <input type = 'submit' name = 'remove' value ='Remove'> 
</form>
</div>

<div>
<form action = "" method="post" id="form1">
    <h2> Modify an existing route: <br> </h2>
    <h3> Enter Route ID to be modified : <input type='number' name = 'modifyroute' required placeholder='Ex: 2'><br> </h3>
    <label for="items">Choose item to be modified:</label>
    <select id="items" name="items">
    <option value="startingPoint">Starting Point</option>
    <option value="endingPoint">Ending Point</option>
    <option value="startingTime">Starting Time</option>
    <option value="endingTime">Ending Time</option>
    <option value="travelTime">Travel Duration</option>
    <option value="fare">Fare</option>
    <option value="busId">Bus ID</option>
    </select>
    <input type = 'submit' form='form1' name = 'modify' value ='Modify'> 
</form> 
</div> 

<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bus_service_system";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "addplaces.php")) {
    if (isset($_POST['add'])) {
        foreach($_POST as $key =>$value){
            // do something using key and value
            if ($key=='starttime' or $key=='endtime'){
                $_SESSION[$key]=substr($value,0,10);
                $t = date("H:i", strtotime($value));
                $_SESSION[$key] = $_SESSION[$key] . " " . $t;
                echo $value . " " . $_SESSION[$key];
            }
            else {
                $_SESSION[$key]=$value;
            }
            // echo $_SESSION[$key] . "<br> </h3>";
        }
        include('../db.php');
        // $check = "SELECT * FROM buses where numberPlate='".$_SESSION['number']."';";
        // $res = $conn->query($check);
        // $row = $res->fetch_assoc();
        // if ($row) {
        //     echo "<script>alert('Bus already exists!";
        // }
        // else {
            $sql = "INSERT INTO routes(startingPoint,endingPoint,startingTime,endingTime,travelTime,fare,busId) VALUES
            (".$_SESSION["startpoint"].",".$_SESSION["endpoint"].", '".$_SESSION["starttime"]."', '".$_SESSION["endtime"]."',".
            $_SESSION["traveltime"].",".$_SESSION["fare"].",".$_SESSION["busid"].");";
            // echo $sql;
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "<script>alert('Cannot add new bus')</script>
            <div>
            <form action='adminhome.php'>
            <input type='submit' value='Back'>
            </form>
            </div>";
            }
            else {
            echo "<script>alert('Successfully added new route to database!')</script>";
            }
        // }
    }

    if (isset($_POST['remove'])) {
        $_SESSION["routeid"] = $_POST["remroute"];
        include('../db.php');
        $check = "SELECT * FROM routes where routeId='".$_SESSION['routeid']."';";
        $res = $conn->query($check);
        $row = $res->fetch_assoc();
        if ($row!=TRUE) {
            echo "<script>alert('Route does not exists!')</script>";
        }
        else {
            $sql = "DELETE FROM routes where routeId='". $_SESSION["routeid"] ."';";
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "<script>alert('Cannot remove route')</script> . <br>
            <div>
            <form action='adminhome.php'>
            <input type='submit' value='Back'>
            </form>
            </div>";
            }
            else {
            echo "<script>alert('Successfully removed ".$_SESSION['routeid']." route from database!')</script>";
            }
        }
    }

    if (isset($_POST['modify'])) {
        $_SESSION['routeid'] = $_POST['modifyroute'];
        $_SESSION['parameter'] = $_POST['items'];
        // echo $_SESSION['routeid'] . " " . $_SESSION['parameter'];
        if ($_SESSION['parameter']=='startingTime' or $_SESSION['parameter']=='endingTime') {
            echo "<div> <form action='' method='post' id='form2'>
            <h3> Enter new value: <br> </h3> 
            <input type='datetime-local' name='updated_value'>
            <input type='submit' form='form2' value='Change'>
            </form> </div>";
        }
        else {
            echo "<div> <form action='' method='post' id='form2'>
            <h3> Enter new value: <br> </h3>
            <input type='number' name='updated_value'>
            <input type='submit' form = 'form2' value='Change' name='change'>
            </form> </div>";
         } 
    } 
    // print_r($_POST);
    if (isset($_POST['updated_value'])) {
        // echo "<script>alert('hi";
        $sql = "UPDATE routes set " . $_SESSION['parameter'] . " = '" . $_POST['updated_value'] . "' 
        where routeId = '" . $_SESSION['routeid'] ."';";
        // echo $sql;   
        $result = $conn->query($sql);
        if ($result!=True) {
        session_destroy();
        echo "<script>alert('Cannot modify route')</script><br> </h3>
        <div>
        <form action='adminhome.php'>
        <input type='submit' value='Back'>
        </form>
        </div>";
        }
        else {
        echo "<script>alert('Successfully modify route!')</script>";
        }
    }
    
    // else
    // echo "<script>alert('Unauthenticated access.";

?>
<form action="adminhome.php">
<input type="submit" value="Go back to admin home page">
</form>
</body>
</html>