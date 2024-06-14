<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();
} else {
    if ((isset($_GET["user_id"]) && $_SESSION["role"] == "admin") || ($_GET["user_id"] == $_SESSION["user_id"])) {
        require_once ('./class/class.User.php');

        $objUser = new User();
        $objUser->user_id = $_GET["user_id"];
        $objUser->SelectUserById();

        if (isset($_POST["submit"])) {
            $objUser->username = (isset($_POST["username"]) ? $_POST["username"] : $objUser->username);
            $objUser->user_password = (isset($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : $objUser->password);
            $objUser->email = (isset($_POST["email"]) ? $_POST["email"] : $objUser->email);
            $objUser->role = (isset($_POST["role"]) ? $_POST["role"] : $objUser->role);

            if (isset($_FILES["profile_photo"])) {
                // Profile photo reinit
                $imgName = $_FILES["profile_photo"]["name"];
                $imgType = $_FILES["profile_photo"]["type"];
                $imgSize = $_FILES["profile_photo"]["size"];
                $imgLocation = $_FILES["profile_photo"]["tmp_name"];

                // folder tempat upload poto profile
                $folder = "./uploads/profile_photo/";

                // memindahkan file photo ke folder jika type file adalah gambar
                if ($imgType == "image/jpeg" or $imgType == "image/jpg" or $imgType == "image/png") {
                    $isSuccessUpload = move_uploaded_file($imgLocation, $folder . $imgName);
                    if ($isSuccessUpload) {
                        // memasukkan lokasi profile photo ke property
                        $objUser->profile_photo = $folder . $imgName;
                    }
                } else if ($imgLocation == "") {
                    $objUser->profile_photo = (isset($imgType) ? $objUser->profile_photo : "");
                    echo "<script>alert('Bukan anjay $imgType, masukkan ulang!');</script>";
                } else {
                    echo "<script>alert('Bukan type file yang diinginkan $imgType, masukkan ulang!');</script>";
                    echo "<script>window.location = 'index.php?p=updateUser&user_id=$objUser->user_id';</script>";
                }
            }

            $objUser->UpdateUser();
            echo "<script>alert('$objUser->message');</script>";
            header("location: ./index.php?p=listUser");
            exit;
        }
    } else if ((!$_GET["user_id"] && $_SESSION["role"] == "admin")) {
        header("location: ./index.php?p=listUser");
        exit;
    } else {
        header("location: ./index.php?p=signin");
        exit;
    }
}
?>
<main class="w-4/5 h-full flex flex-column flex-wrap justify-center items-center gap-4">
    <div class="w-full h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column flex-wrap justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white w-full">Form Update User</h1>
        <p class="text-white text-center text-xl"><?php echo $objUser->username; ?></p>
    </div>
    <form action="" method="post" enctype="multipart/form-data"
        class="w-full h-2/3 p-10 rounded-lg bg-white shadow flex flex-column flex-wrap justify-center items-center">
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="username" class="font-semibold text-xl w-1/5">Username</label>
            <input type="text" name="username" id="username" value="<?= $objUser->username ?>"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="password" class="font-semibold text-xl w-1/5">Password</label>
            <input type="password" name="password" id="password"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="email" class="font-semibold text-xl w-1/5">Email</label>
            <input type="text" name="email" id="email" value="<?= $objUser->email ?>"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="role" class="font-semibold text-xl w-1/5">Role</label>
            <input type="text" name="role" id="role" value="<?= $objUser->role ?>"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black" disabled>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="profile_photo" class="font-semibold text-xl w-1/5">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <input type="submit" value="Update" name="submit"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-blue hover:bg-black cursor-pointer">
            <?php if ($_SESSION["role"] == "admin") { ?>
                <a href="./index.php?p=listUser"
                    class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-red-600 hover:bg-black cursor-pointer">Cancel</a>
            <?php } else { ?>
                <a href="./index.php?p=dashboardMember"
                    class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-red-600 hover:bg-black cursor-pointer">Cancel</a>
            <?php } ?>
        </div>
    </form>
</main>