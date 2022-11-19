<?php
// session_start();
?>
<?php
    $auth=false;
    session_start();
    if(isset($_SESSION['username'])){
        // echo('User SignedIn<br>');
        $auth = true;
    }
    else{
        // echo('User NOT SignedIn');
        header("location: /SSL-Project/index.php");
    }
?>
<html>
    <head>
    <link rel="stylesheet" href="styleadmin.css">
    </head>
<body>

<div class="header flex-center">
    <h1> Add new places or remove existing places </h1>
</div>

<div>
<form action = "" method="post">
    <h2> Add a new place: <br></h2>
    <h3> Place : <input type='text' name = 'newplace' required placeholder='Ex: Dharwad'><br> </h3>
    <input type = 'submit' name = 'add' value ='Add'> 
</form>
</div>
<div>
<form action = "" method="post">
    <h2> Remove an existing place: <br> </h2>
    <h3> Place : <input type='text' name = 'remplace' required placeholder='Ex: Dharwad'><br> </h3>
    <input type = 'submit' name = 'remove' value ='Remove'> 
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
        $_SESSION["place"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["newplace"] : $_GET["newplace"]);
        include('../db.php');
        $check = "SELECT * FROM places where placeName='".$_SESSION['place']."';";
        $res = $conn->query($check);
        $row = $res->fetch_assoc();
        if ($row) {
            echo "<script>alert('Place already exists!')</script>";
        }
        else {
            $sql = "INSERT INTO places(placeName) VALUES('".$_SESSION["place"]."');";
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "Cannot add new place . <br>
            <form action=\"adminhome.php\">
            <input type=\"submit\" value=\"Back\">
            </form>";
            }
            else {
            echo "<script>alert('Successfully added ".$_SESSION['place']." to database!')</script>";
            }
        }
    }

    if (isset($_POST['remove'])) {
        $_SESSION["place"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["remplace"] : $_GET["remplace"]);
        include('../db.php');
        $check = "SELECT * FROM places where placeName='".$_SESSION['place']."';";
        $res = $conn->query($check);
        $row = $res->fetch_assoc();
        if ($row!=TRUE) {
            echo "<script>alert('Place does not exists!')</script>";
        }
        else {
            $sql = "DELETE FROM places where placeName='". $_SESSION["place"] ."';";
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "Cannot remove place . <br>
            <form action=\"adminhome.php\">
            <input type=\"submit\" value=\"Back\">
            </form>";
            }
            else {
            echo "<script>alert('Successfully removed ".$_SESSION['place']." from database!')</script>";
            }
        }
    }
    
    // else
    // echo "Unauthenticated access.";

?>
<form action="adminhome.php">
<input type="submit" value="Go back to admin home page">
</form>
</body>
</html>