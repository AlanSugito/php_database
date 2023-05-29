<?php 
    require "lib.php";

    if ( isset($_POST["submit"])) {

        if (register($_POST) > 0) {
            echo "<script>
            alert('Sign up succeded')
            document.location.href = 'index.php'
        </script>";
        } else {
           echo "<script>
                alert('Sign up failed')
            </script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reggister</title>
    <link rel="stylesheet" href="css/register.css"
</head>
<body>
    <h1>Sign up</h1>

    <form action="" method="post">
        <div>
            <label for="username">
                <span>Username</span>
                <input type="text" name="username" id="username" required>
            </label>
            <label for="email">
                <span>Email</span>
                <input type="email" name="email" id="email" required>
            </label>
            <span>Password</span>
            <label for="password">
                <input type="password" name="password" id="password" required>
            </label>
            <button type="submit" name="submit">Sign Up</button>
            <a href="login.php">Already have an account? Login here</a>
        </div>
    </form>
</body>
</html>