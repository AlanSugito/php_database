<?php
    session_start();
    require "lib.php";

    $isLogin = $_SESSION["isLogin"];
    if (!$isLogin) {
        header("Location: login.php");
        exit;
    }
    
    $menus = getAllMenus();
    
    if (isset( $_GET["search"])) {
        $query = $_GET["keyword"];

        if (!search($query)) {
            $menus = getAllMenus();
        } else {
            $menus = search($query);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Caffe Database</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h3><a href="logout.php" class="logout">Logout</a></h3>
    <h1>Menu List</h1>
    <div class="search">
        <form action="" method="get">

            <input type="text" name="keyword" placeholder="Search menu name...">
            <button type="submit" name="search">Search</button>
        </form>
    </div>
    <div class="add-section">
        <button class="add"><a href="add_menu.php">Add menu</a></button>
    </div>

    <table border="2" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
        <?php foreach ($menus as $menu) : ?>
            <tr>
                <td><?= $menu["id"] ?></td>
                <td><img src="img/<?php echo $menu['img'] ?>" alt="..."></td>
                <td><?= $menu["menu_name"] ?></td>
                <td class="price"><?= $menu["price"] ?></td>
                <td><?= $menu["menu_type"] ?></td>
                <td><span class="edit"><a href="update.php?id=<?= $menu["id"] ?>">Edit</a></span> | <span class="delete"><a href="delete.php?id=<?= $menu["id"] ?>" onclick="return confirm('Are you sure to delete the data?')">Delete</a></span></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>

        const price = document.querySelectorAll('.price');
        price.forEach(p => {
            let num = Number(p.innerText)

            formattedNum = num.toLocaleString("id-ID");
            p.innerText = `Rp. ${formattedNum}`;
        })

    </script>
</body>

</html>