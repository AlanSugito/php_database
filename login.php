<?php 
    session_start();
    require "lib.php";
   
    
    
    if ( isset($_POST["submit"]) ) {
        
        if (isset($_POST["remember"])) {
            setCookies($_POST['username']);
        }
        login($_POST);

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<h1>Log in</h1>

<form action="" method="post">
    <div>
        <label for="email">
            <span>Email</span>
            <input type="email" name="email" id="email" required>
        </label>
        <span>Password</span>
        <label for="password">
            <input type="password" name="password" id="password" required>
        </label>
        <label for="remember">
            <span>Remember me</span>
            <input type="checkbox" name="remember" id="remember">
        </label>
        <button type="submit" name="submit">Log in</button>
        <a href="register.php">Still not have an account? register here</a>
    </div>
</form>  
</body>
</html>