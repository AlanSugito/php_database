<?php 
    session_start();
    $isLogin = $_SESSION["isLogin"];
    if (!$isLogin) {
        header("Location: login.php");
        exit;
    }
    require "lib.php";

    $id = $_GET['id'];

    if (delete($id) > 0) {
        echo "<script>
                alert('Menu Deleted')
                document.location.href = 'index.php'
            </script>";
    } else {
        echo "<script>
                alert('Menu failed to delete')
                document.location.href = 'index.php'
            </script>";
    }
