<?php
require_once ("./class/class.User.php");

$objUsers = new User();
$arrUsers = $objUsers->SelectAllUser();
?>
<main>
    <table border="">
        <thead>
            <tr>
                <th class="border border-black">#</th>
                <th class="border border-black">user_id</th>
                <th class="border border-black">username</th>
                <th class="border border-black">email</th>
                <th class="border border-black">role</th>
                <th class="border border-black">profile_photo</th>
                <th class="border border-black">action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($arrUsers)) {
                $i = 0;
                foreach ($arrUsers as $value) { ?>
                    <tr>
                        <td class="border border-black"><?= ++$i ?></td>
                        <td class="border border-black"><?= $value["user_id"] ?></td>
                        <td class="border border-black"><?= $value["username"] ?></td>
                        <td class="border border-black"><?= $value["email"] ?></td>
                        <td class="border border-black"><?= $value["role"] ?></td>
                        <td class="border border-black"><img src="<?= $value["profile_photo"] ?>" alt="" title="<?= $value["username"] ?>" width="50"></td>
                        <td class="border border-black"><a href="index.php?p=deleteUser&user_id=<?= $value["user_id"] ?>">Delete</a></td>
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
</main>