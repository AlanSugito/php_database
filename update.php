<?php 
    session_start();
    require "lib.php";

    $isLogin = $_SESSION["isLogin"];
    if (!$isLogin) {
        header("Location: login.php");
        exit;
    }

    $id = $_GET["id"];
    $menu = getMenu($id);

    if(isset($_POST["submit"])) {
        
        if (updateMenu($_POST, $id) > 0) {
            echo "<script>
                alert('Menu updated')
                document.location.href = 'index.php'
            </script>";
        } else {
            echo "<script>
            alert('Menu update failed')
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
    <title>Update Menu</title>
    <link rel="stylesheet" href="css/add_menu.css">
</head>
<body>
    <h1>Update menu</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="field">
            <input type="hidden" name="current_img_name" value="<?= $menu['img']?>">
            <label for="menu_name"><span>Menu name</span>
                <input type="text" name="menu_name" id="menu_name" value="<?= $menu["menu_name"]?>">
            </label>
            <label for="price"><span>Price</span>
                <input type="number" name="price" id="price" value="<?= $menu["price"]?>">
            </label>
            <label for="type"><span>Menu Category</span>
                <input type="text" name="type" id="type" value="<?= $menu["menu_type"]?>">
            </label>
            <label for="img"><span>Picture</span>
                <img src="img/<?= $menu['img']?>" alt="..." width="100">
                <input type="file" name="img" id="img">
            </label>
            <button name="submit">Add</button>
        </div>
    </form>
</body>
</html>