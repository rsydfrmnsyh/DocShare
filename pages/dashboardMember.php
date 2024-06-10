<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();
} 

?><main>
    <h1>dashboardMember </h1>
</main>