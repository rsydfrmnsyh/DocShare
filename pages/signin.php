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
            $_SESSION["username"] = $objUser->username;
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
<main class="flex justify-center items-center h-full w-full">
    <form action="" method="post" class="border rounded-lg bg-white p-10 gap-6 shadow w-1/3 flex flex-column flex-wrap justify-center items-center">
        <div class="flex flex-row items-center gap-4 text-2xl w-full justify-center mb-4">
            <img src="./assets/logo.svg" alt="" title="DocShare" width="60">
            <h3 class="font-bold">DocShare</h3>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="username" class="font-semibold w-1/3">Username</label>
            <input type="text" name="username" id="username" class="px-4 py-2 text-lg outline-none border-4 rounded-lg border-black focus:border-blue" required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="password" class="font-semibold w-1/3">Password</label>
            <input type="password" name="password" id="password" class="px-4 py-2 text-lg outline-none border-4 rounded-lg border-black focus:border-blue" required>
        </div>
        <div class="flex flex-row flex-wrap items-center justify-center w-full gap-2">
            <input type="submit" value="Login" name="submit" class="w-full px-4 py-2 font-bold bg-blue text-white rounded-lg cursor-pointer">
            <p>Don't have an account? <a href="index.php?p=signup" class="text-blue">Sign Up</a></p>
        </div>
    </form>
</main>