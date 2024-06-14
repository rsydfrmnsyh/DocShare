<?php

if (!isset($_SESSION["user_id"]) && $_SESSION["role"] != "admin") {
    header("location: index.php?p=signin");
    exit;
}
?>
<main>
    <h1>Dashboard Admin</h1>
    <h2>Hello, </h2>
</main>