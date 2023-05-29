<?php 
session_start();
require "lib.php";
$isLogin = $_SESSION["isLogin"];
if (!$isLogin) {
    header("Location: login.php");
    exit;
}
    if(isset($_POST["submit"])) {

        
        if (addMenu($_POST) > 0) {
            echo "<script>
                alert('Menu added to the database')
                document.location.href = 'index.php'
            </script>";
        } else {
            echo "<script>
            alert('Menu insertion failed')
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
    <title>Add Menu</title>
    <link rel="stylesheet" href="css/add_menu.css">
</head>
<body>
    <h1>Add menu</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="field">
            <label for="menu_name"><span>Menu name</span>
                <input type="text" name="menu_name" id="menu_name">
            </label>
            <label for="price"><span>Price</span>
                <input type="number" name="price" id="price">
            </label>
            <label for="type"><span>Menu Category</span>
                <select name="type" id="type">
                    <option value="Food">Food</option>
                    <option value="Drink">Drink</option>
                </select>
            </label>
            <label for="img"><span>Picture</span>
                <input type="file" name="img" id="img">
            </label>
            <button name="submit">Add</button>
        </div>
    </form>
</body>
</html>