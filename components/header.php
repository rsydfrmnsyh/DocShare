<header>
    <nav class="flex flex-row justify-evenly items-center g-10">
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
            <ul>
                <li><a href="index.php?p=dashboardAdmin">Dashboard</a></li>
                <li><a href="index.php?p=listUser">List All User</a></li>
                <li><a href="index.php?p=listDocuments">List All Documents</a></li>
                <li><a href="index.php?p=signout">Sign Out</a></li>
            </ul>
        <?php } else if (isset($_SESSION["role"]) && $_SESSION["role"] == "member") { ?>
                <ul>
                    <li><a href="index.php?p=dashboardMember">Dashboard</a></li>
                    <li><a href="index.php?p=updateUser&user_id=<?= $_SESSION['user_id'] ?>">Update User</a></li>
                    <li><a href="index.php?p=signin">Sign IN</a></li>
                    <li><a href="index.php?p=signup">Sign Up</a></li>
                    <li><a href="index.php?p=signout">Sign Out</a></li>
                </ul>
        <?php } else { ?>
                <li><a href="index.php?p=signin">Sign IN</a></li>
                <li><a href="index.php?p=signup">Sign Up</a></li>
        <?php } ?>
    </nav>
</header>