<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit;
}


?>
<main class="">
    <div class="p-10"><h1>Hello, </h1></div>
</main>