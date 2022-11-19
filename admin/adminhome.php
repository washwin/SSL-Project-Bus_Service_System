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
<!DOCTYPE html>
<html>
    <head>

    <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color:#eda6a6;
}

.topnav {
  overflow: hidden;
  background-color: #ad0000;
}

.topnav a {
  float: left;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #570000;;
  color: white;
}

.topnav a.active {
  background-color: #570000;
  color: white;
}

.topnav-right {
  float: right;
}
li a:hover {
  background-color: #111;
}
        .header{
        margin:10px auto;
        height:10%;
        width: 100%;
        background-color: #ad0000;
        text-align: center;
        color : white;
        }
        ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #e27373;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
  text-align: center;
}

/* Change the link color on hover */
li a:hover {
  background-color: #570000;
  color: white;
}
        </style>
    </head>
    <body>
        <!-- <div class="header flex-center">
            <h1>Welcome to Admin Home Page</h1>
        </div> -->
  

<div class="topnav">
  <a class="active" href="#home">Admin Home</h1></a>
  <div class="topnav-right">
    <a href="/SSL-Project/signin/index.php">LOG OUT</a>
  </div>
</div>
<div class="header flex-center">
            <h1>Welcome to Admin Home Page</h1>
        </div>
  
        
<nav>
  <ul>
    <li>
        <a href = "addplaces.php">Add or remove places</a>
        <!-- <form action="addplaces.php">
        <input type="submit" value="Add new or remove places">
        </form> -->
    <li>
        <a href = "addbuses.php">Add or remove buses</a>
        <!-- <form action="addbuses.php">
        <input type="submit" value="Add new or remove buses">
        </form> -->
    <li>
        <a href = "addroutes.php">Add/remove/modify routes</a>
        <!-- <form action="addroutes.php">
        <input type="submit" value="Add new or modify existing routes">
        </form> -->
  </ul>
</nav>
    </body>
</html>