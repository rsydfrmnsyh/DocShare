<?php
require_once("./class/class.User.php");

if($_GET["user_id"]){
    $objUser = new User();
    $objUser->user_id = $_GET["user_id"];
    $objUser->DeleteUser();

    echo "<script>alert('$objUser->message');</script>";
    echo "<script>window.location = 'index.php?p=listUser';</script>";
}
 ?>