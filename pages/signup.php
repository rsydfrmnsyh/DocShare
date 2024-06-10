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
        $_SESSION["username"] = $objUser->user_username;
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
<main>
    <h1>Form Sign Up</h1>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Sign Up" name="submit">
            <a href="./index.php?signin.php">Already have'nt an Account?</a>
        </div>
    </form>
</main>