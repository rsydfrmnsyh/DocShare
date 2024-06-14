<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();
} else {
    $user_id = $_SESSION["user_id"];

    require_once ("./class/class.User.php");

    $objUsers = new User();
    $arrUsers = $objUsers->SelectAllUser();
}
?>
<main class="w-4/5 h-full">
    <div class="h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white">List All User</h1>
    </div>
    <div class="h-auto py-4 flex flex-column justify-start items-center">
        <a href="index.php?p=addUser"
            class="bg-blue px-4 py-2 rounded-lg shadow font-semibold hover:bg-black text-white">Add User</a>
    </div>
    <div class="h-3/5 bg-white rounded-lg p-10 overflow-y-auto">
        <table border="" class="w-full">
            <thead>
                <tr>
                    <th class="border border-black p-2">#</th>
                    <th class="border border-black p-2">Username</th>
                    <th class="border border-black p-2">Email</th>
                    <th class="border border-black p-2">Role</th>
                    <th class="border border-black p-2">Profile Photo</th>
                    <th class="border border-black p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($arrUsers)) {
                    $i = 0;
                    foreach ($arrUsers as $value) { ?>
                        <tr>
                            <td class="border border-black p-2"><?= ++$i ?></td>
                            <td class="border border-black p-2"><?= $value["username"] ?></td>
                            <td class="border border-black p-2"><?= $value["email"] ?></td>
                            <td class="border border-black p-2"><?= $value["role"] ?></td>
                            <td class="border border-black p-2"><img src="<?= $value["profile_photo"] ?>" alt=""
                                    title="<?= $value["username"] ?>" width="50"></td>
                            <td class="border border-black p-2">
                                <a href="index.php?p=updateUser&user_id=<?= $value["user_id"] ?>" class="bg-blue p-2 rounded-lg font-semibold text-white hover:bg-black">Update</a>
                                <a href="index.php?p=deleteUser&user_id=<?= $value["user_id"] ?>" class="bg-red-600 p-2 rounded-lg font-semibold text-white hover:bg-black">Delete</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">Data tidak ditemukan</td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</main>