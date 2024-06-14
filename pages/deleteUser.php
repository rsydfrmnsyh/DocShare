<?php
session_start();

if (!isset($_SESSION["user_id"]) && $_SESSION["role"] != "admin") {
    header("location: index.php?p=signin");
    exit();
} else {
    require_once ("./class/class.User.php");

    if ($_GET["user_id"]) {
        $objUser = new User();
        $objUser->user_id = $_GET["user_id"];
        $objUser->DeleteUser();

        echo "<script>alert('$objUser->message');</script>";
        echo "<script>window.location = 'index.php?p=listUser';</script>";
    }
}
?>