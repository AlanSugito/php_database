<?php 
    $db = mysqli_connect("localhost", "root", "", "phpdasar");

    function getAllMenus() {
     global $db;
        $result = mysqli_query($db, "SELECT * FROM menu");

        $menus = [];

        while ($menu = mysqli_fetch_assoc($result)) {
            $menus[] = $menu; 
        }

        return $menus;
    }


    function addMenu($data) {
        global $db;

        $menuName = htmlspecialchars($data["menu_name"]);
        $price = htmlspecialchars($data["price"]);
        $type = htmlspecialchars($data["type"]);
        $img = uploudImg();

        if (!$img) {
            return false;
        }

        $query = "INSERT INTO menu(menu_name, price, menu_type, img)
                  VALUES('$menuName', $price, '$type', '$img')";
        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    function getMenu($id) {
        global $db;

        $result = mysqli_query($db, "SELECT * FROM menu WHERE id = $id");

        return mysqli_fetch_assoc($result);
    }

    function updateMenu($data, $id) {
        global $db;

        $menuName = htmlspecialchars($data["menu_name"]);
        $price = htmlspecialchars($data["price"]);
        $type = htmlspecialchars($data["type"]);
        $currentImgName = htmlspecialchars($data["current_img_name"]);
        

        if ($_FILES["img"]["error"] == 4) {
            $img = $currentImgName;
        } else {
            $img = uploudImg();
        }

 
        $query = "UPDATE menu SET menu_name = '$menuName', price = $price, menu_type = '$type', img = '$img' WHERE id = $id";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    function uploudImg() {

        $imgName = $_FILES["img"]["name"];
        $tmpDirName = $_FILES["img"]["tmp_name"];
        $errorCode = $_FILES["img"]["error"];

        if ($errorCode == 4) {
            echo "<script>alert('Please insert an image!')</script>";
            return false;
        }
        
        $validImgExtensions = ["jpg", "jpeg", "png"];
        $imgExtension = explode(".", $imgName);
        $imgName = $imgExtension[0];
        $imgExtension = strtolower(end($imgExtension));
        $newFileName = uniqid();
        $imgName .= "-$newFileName." . $imgExtension;

        if (!in_array($imgExtension, $validImgExtensions)) {
            echo "<script>alert('file extension is not valid!')</script>";
            return false;
        }

  

        move_uploaded_file($tmpDirName, "img/$imgName");

        return $imgName;

    }

    function delete($id) {
        global $db;

        mysqli_query($db, "DELETE FROM menu WHERE id = $id");

        return mysqli_affected_rows($db);
    }

    function register($data) {
        global $db;

        $username = $data['username'];
        $email = $data["email"];
        $password = $data['password'];
        
        $username = strtolower($username);
        $username = stripslashes($username);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }


    function login($data) {
        global $db;

        $email = $data["email"];
        $password = $data["password"];

        $result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row["email"] === $email) {
                $verified = password_verify($password, $row["password"]);

                if ( $verified ) {
                    $_SESSION["isLogin"] = true;
                    echo "<script>alert('Login Success!')</script>";
                    header("Location: index.php");
                    exit;
                } else {
                echo "<script>alert('Password is wrong!')</script>";
                }
               
            }
            
        } else {
            echo "<script>alert('Email is wrong!')</script>";
        }

    }


    function search($keyword) {
        global $db;

        $keyword = ucwords($keyword);
        $result = mysqli_query($db, "SELECT * FROM menu WHERE menu_name LIKE '%$keyword%'");

        if (mysqli_num_rows($result) > 0) {
            $menu = mysqli_fetch_assoc($result);
            return [$menu];
        }

        echo "<script>alert('Menu not found')
                document.location.href = 'index.php';    
            </script>";
        
        return false;
    }



    function setCookies($username) {
        global $db;

        $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($result);

        setcookie('key', hash('sha256', $user['username']), time() + 360);

        if (isset($_COOKIE['key'])) {
            $key = $_COOKIE['key'];

            if($_COOKIE['key'] === hash('sha256', $username)) {
                $_SESSION['isLogin'] = true;
            }
        }

    }

?>