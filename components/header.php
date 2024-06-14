<?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
    <header class="w-1/5 shadow bg-white rounded-lg px-6 py-8 h-full">
        <nav class="flex flex-column flex-wrap gap-4 justify-center items-center w-full">
            <a href="index.php?p=signin" class="font-bold text-2xl flex items-center gap-2 mb-10"><img
                    src="./assets/logo.svg" alt="" class="w-1/4">
                <p class="3/4">DocShare</p>
            </a>
            <a href="index.php?p=dashboardAdmin"
                class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">Dashboard</a>
            <a href="index.php?p=listUser" class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">List All
                User</a>
            <a href="index.php?p=listDocuments" class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">List All
                Documents</a>
            <a href="index.php?p=signout"
                class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-800 text-white w-full font-semibold text-center">Sign
                Out</a>
        </nav>
    </header>
<?php } else if (isset($_SESSION["role"]) && $_SESSION["role"] == "member") { ?>
        <header class="w-1/5 shadow bg-white rounded-lg px-6 py-8 h-full">
            <nav class="flex flex-column flex-wrap gap-4 justify-center items-center">
                <a href="index.php?p=signin" class="font-bold text-2xl flex items-center gap-2 mb-10"><img
                        src="./assets/logo.svg" alt="" class="w-1/4">
                    <p class="3/4">DocShare</p>
                </a>
                <a href="index.php?p=dashboardMember"
                    class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">Dashboard</a>
                <a href="index.php?p=updateUser&user_id=<?= $_SESSION['user_id'] ?>"
                    class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">Update User</a>
                <a href="index.php?p=signin" class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">Sign IN</a>
                <a href="index.php?p=signup" class="px-4 py-2 rounded-lg hover:bg-gray-300 w-full font-semibold">Sign Up</a>
                <a href="index.php?p=signout"
                    class="px-4 py-2 rounded-lg  bg-red-600 hover:bg-red-800 text-white  w-full font-semibold self-end">Sign
                    Out</a>
            </nav>
        </header>
<?php } ?>