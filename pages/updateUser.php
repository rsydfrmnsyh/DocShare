<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();
} else {
    if (($_GET["user_id"] && $_SESSION["role"] == "admin") || ($_GET["user_id"] == $_SESSION["user_id"])) {
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
<main>
    <h1>Form Update User</h1>
    <h2><?php echo $objUser->username; ?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-row justify-center items-center">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $objUser->username ?>">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $objUser->email ?>">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="<?= $objUser->role ?>" disabled>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="profile_photo">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo">
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Update" name="submit">
            <a href="./index.php?p=listUser.php">Cancel</a>
        </div>
    </form>
</main>