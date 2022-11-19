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
    <h2>Add a new bus: <br></h2>
    <h3>Enter bus number : <input type='text' name = 'newnumber' required placeholder='Ex: KA 45 L 1893'><br><h3>
    <!-- Enter bus capacity : <input type='number' name = 'capacity' required placeholder='Ex: 45'><br> -->
    <input type = 'submit' name = 'add' value ='Add'> 
</form>
</div>

<div>
<form action = "" method="post">
    <h2>Remove an existing bus: <br></h2>
    <h3>Enter bus number to be removed : <input type='text' name = 'remnumber' required placeholder='Ex: KA 45 L 1893'><br></h3>
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
        $_SESSION["number"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["newnumber"] : $_GET["newnumber"]);
        include('../db.php');
        $check = "SELECT * FROM buses where numberPlate='".$_SESSION['number']."';";
        $res = $conn->query($check);
        $row = $res->fetch_assoc();
        if ($row) {
            echo "<script>alert('<script>alert('Bus already exists!";
        }
        else {
            $sql = "INSERT INTO buses(numberPlate) VALUES('".$_SESSION["number"]."');";
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "<script>alert('Cannot add new bus')<script> . <br>
            <form action=\"adminhome.php\">
            <input type=\"submit\" value=\"Back\">
            </form>";
            }
            else {
            echo "<script>alert('Successfully added ".$_SESSION['number']." to database!')</script>";
            }
        }
    }

    if (isset($_POST['remove'])) {
        $_SESSION["number"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["remnumber"] : $_GET["remnumber"]);
        include('../db.php');
        $check = "SELECT * FROM buses where numberPlate='".$_SESSION['number']."';";
        $res = $conn->query($check);
        $row = $res->fetch_assoc();
        if ($row!=TRUE) {
            echo "<script>alert('Bus does not exists!')</script>";
        }
        else {
            $sql = "DELETE FROM buses where numberPlate='". $_SESSION["number"] ."';";
            $result = $conn->query($sql);
            if ($result!=True) {
            session_destroy();
            echo "<script>alert('Cannot remove bus!')</script>. <br>
            <form action=\"adminhome.php\">
            <input type=\"submit\" value=\"Back\">
            </form>";
            }
            else {
            echo "<script>alert('Successfully removed ".$_SESSION['number']." from database!')</script>";
            }
        }
    }
    
    // else
    // echo "<script>alert('Unauthenticated access.')</script>";

?>
<form action="adminhome.php">
<input type="submit" value="Go back to admin home page">
</form>
</body>
</html>