<!-- Please execute db.php once before to create db and table -->
<?php
    // if (session_status() === PHP_SESSION_ACTIVE)
    session_start();
    session_destroy();
    // echo session_status();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <style>
    .header{
    margin:10px auto;
    height:10%;
    width: 94%;
    background-color: bisque;
}
    </style>
  </head>
</head>
<body>
<!-- <nav class="navbar"> -->
<!-- <div class="navbar__container">
    <h1> Admin Portal </h1>
</div> -->
<!-- </nav> -->
<div class = "go-back">
    <a href="../index.php"> Home page <a>
</div>
<div class="univ flex-center">
    <div id="signin-body">
        
        <div class=" header flex-center">
            <h1 style="color:black"> Sign-In </h1>
        </div>
        <div class="container">
                <div class="form">
                    <div>
                        <br>
                        <form id="signInForm" autocomplete="off" action="signin.php" method="post">
                            <label for="username">Username</label><br>
                            <input type="text" id="username" size="22" name="username" placeholder="Please enter your username" required><br><br>
                            <label for="password">Password</label><br>
                            <input type="password" id="password" size="22" name="password" placeholder="Please enter your password" required>
                            <div class="submission">
                                <button class="cp" type="submit">Sign In</button><br><br>
                            </div>
                  </div>
                </div>
                <div class="moreOptions">
                    <div style="text-align: center;">
                        <a href="/SSL-Project/admin/forgot_password.php">Forgot Password ?</a><br><br>
                        <a href="/SSL-Project/contactus/index.php">Contact Us</a>
                    </div>
                </div>
            </div>
</div>
</div>
<!-- <form action = "signin.php" method="post">
Only admins can login <br>
Username : <input type='text' name = 'username' required placeholder='username'><br>
Password : <input type='text' name = 'password' required placeholder='username'><br>
<input type = 'submit' value ='Signin'> 
</form> -->

<script>
function validate() {
if((document.getElementById('u').value).length==0)
window.alert("enter username");
elif((document.getElementById('p').value).length==0)
window.alert("enter password");

}
</script>
</body>
</html>

