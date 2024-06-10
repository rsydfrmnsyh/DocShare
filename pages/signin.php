<?php
if (isset($_POST["submit"])) {
    require_once ("./class/class.User.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $objUser = new User();
    $objUser->username = $username;
    $objUser->SelectUserByUsername();

    if ($objUser->result) {
        // cek password apakah sama
        $objUser->SelectUserById();
        $resultPassword = password_verify($password, $objUser->user_password);
        if ($resultPassword) {
            $_SESSION["user_id"] = $objUser->user_id;
            $_SESSION["username"] = $objUser->user_username;
            $_SESSION["role"] = $objUser->role;
            if ($_SESSION["role"] == "admin") {
                echo "<script>alert('Berhasil Login');</script>";
                header("location: index.php?p=dashboardAdmin");
                exit;
            } else {
                echo "<script>alert('Berhasil Login');</script>";
                header("location: index.php?p=dashboardMember");
                exit;
            }
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Akun Tidak di temukan');</script>";
    }

} else if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin") {
        header("location: index.php?p=dashboardAdmin");
        exit;
    } else {
        header("location: index.php?p=dashboardMember");
        exit;
    }
}

?>
<main>
    <h1>Form Login</h1>
    <form action="" method="post">
        <div class="flex flex-row justify-center items-center">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Login" name="submit">
        </div>
    </form>
</main>