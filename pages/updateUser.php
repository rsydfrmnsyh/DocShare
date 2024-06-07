<?php
require_once ('./class/class.User.php');

$objUser = new User();
if (!$_GET["user_id"]) {
    header("location: ./index.php?p=listUser");
    exit();
} else if ($_GET["user_id"]) {
    $objUser->user_id = $_GET["user_id"];
    $objUser->SelectUserById();
    if (isset($_POST["submit"])) {
        $objUser->username = $_POST["username"] || $objUser->username;
        $objUser->user_password = $_POST["password"] || $objUser->user_password;
        $objUser->email = $_POST["email"] || $objUser->email;
        $objUser->role = $_POST["role"]|| $objUser->role ;
        $objUser->profile_photo = $_POST["profile_photo"] || $objUser->profile_photo;

        $objUser->UpdateUser();
    }
}
?>
<main>
    <h1>Form Update User</h1>
    <h2>c<?php echo $objUser->username ?></h2>
    <form action="" method="post">
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
            <a href="./index.php?signin.php">Cancel</a>
        </div>
    </form>
</main>