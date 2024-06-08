<?php

    if(!isset($_SESSION)) 
    {
        session_start();
    }
    if(!isset($_SESSION["role"]))
    {
        echo "<script> alert('Please login to access this page');</script>";
        echo '<script> window.location="index.php"; </script>';
    }
    else
    {
        if($_SESSION["role"]!='admin')
        {
            echo "<script> alert('This page is only accessible to admins');</script>";
            echo '<script> window.location="index.php"; </script>';
        }
    }

?>