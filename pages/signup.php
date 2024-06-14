<?php

if (isset($_POST["submit"])) {
    require_once ('./class/class.User.php');

    $objUser = new User();
    // nge cek username dan email apakah sudah pernah di pakai?
    $arrUser = $objUser->SelectAllUser();
    $objUser->username = $_POST["username"];
    $objUser->email = $_POST["email"];

    $filteredUser = 0;
    for ($i = 0; $i < count($arrUser); $i++) {
        if ($arrUser[$i]["username"] === $objUser->username) {
            ++$filteredUser;
            $objUser->result = false;
            $objUser->message = "Username sudah digunakan";
            break;
        } else if ($arrUser[$i]["email"] === $objUser->email) {
            ++$filteredUser;
            $objUser->result = false;
            $objUser->message = "Email sudah digunakan";
            break;
        } else {
            $objUser->result = true;
            $objUser->message = "Berhasil menambahkan data user";
            continue;
        }
    }

    if ($objUser->result && $filteredUser === 0) {
        // tambah user jika username dan email tidak pernah di pakai
        $objUser->role = "member";
        $objUser->user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $objUser->AddUser();
        $_SESSION["user_id"] = $objUser->user_id;
        $_SESSION["username"] = $objUser->username;
        $_SESSION["role"] = $objUser->role;
        echo "<script>alert('$objUser->message');</script>";
        echo "<script>window.location.href='./index.php?p=dashboardMember';</script>";
    } else {
        echo "<script>alert('$objUser->message');</script>";
        echo "<script>window.location.href='./index.php?p=signUp';</script>";
    }
} else if (isset($_SESSION["user_id"])) {
    header("location: index.php?p=dashboardMember");
    exit;
}
?>
<main class="flex justify-center items-center h-full w-full">
    <form action="" method="post"
        class="border rounded-lg bg-white p-10 gap-6 shadow w-1/3 flex flex-column flex-wrap justify-center items-center">
        <div class="flex flex-row items-center gap-4 text-2xl w-full justify-center mb-4">
            <img src="./assets/logo.svg" alt="" title="DocShare" width="60">
            <h3 class="font-bold">DocShare</h3>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="username" class="font-semibold w-1/3">Username</label>
            <input type="text" name="username" id="username" class="px-4 py-2 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="password" class="font-semibold w-1/3">Password</label>
            <input type="password" name="password" id="password" class="px-4 py-2 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="email" class="font-semibold w-1/3">Email</label>
            <input type="text" name="email" id="email" class="px-4 py-2 text-lg outline-none border-4 rounded-lg border-black focus:border-blue">
        </div>
        <div class="flex flex-row flex-wrap items-center justify-center w-full gap-2">
            <input type="submit" value="Sign Up" name="submit" class="w-full px-4 py-2 font-bold bg-blue text-white rounded-lg cursor-pointer">
            <p>Already have an account? <a href="index.php?p=signin" class="text-blue">Sign In</a></p>
        </div>
    </form>
</main>