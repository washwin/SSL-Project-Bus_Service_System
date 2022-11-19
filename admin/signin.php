<?php
session_start();
?>
<html>
<body>

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

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "index.php")) {
        $_SESSION["username"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["username"] : $_GET["username"]);
        $_SESSION["password"] = test_input($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST["password"] : $_GET["password"]);
        include('../db.php');
        $sql = "Select * from admins where Username='".$_SESSION["username"]."';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        // echo $result;
        if ($row==NULL || $row['Pass_word']!=$_SESSION['password']) {
        session_destroy();
        echo "Incorrect admin login credentials . <br>
        <form action=\"index.php\">
        <input type=\"submit\" value=\"Back\">
        </form>";
        }
        else {
            header("Location: adminhome.php");
            exit();
        }
    }

    elseif(isset($_SERVER["HTTP_REFERER"]) and strpos($_SERVER["HTTP_REFERER"], "addplaces.php")) {
        
    }
    else
    echo "Unauthenticated access.";
    
?>

</body>
</html>