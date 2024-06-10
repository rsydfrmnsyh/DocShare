<?php

if (!isset($_SESSION["user_id"])) {
    header("location: index.php?p=signin");
    exit();

} else {
    require_once ('./class/class.User.php');

    $objUser = new User();
    if (isset($_POST["submit"])) {
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

            $objUser->role = $_POST["role"];
            $objUser->user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $objUser->AddUser();
            echo "<script>alert('$objUser->message');</script>";
            echo "<script>window.location.href='./index.php?p=dashboardAdmin';</script>";
        } else {
            echo "<script>alert('$objUser->message');</script>";
            echo "<script>window.location.href='./index.php?p=addUser';</script>";
        }
    }
}
?>
<main>
    <h1>Form Add User</h1>
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
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>
        <div class="flex flex-row justify-center items-center">
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="" selected disabled>-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="member">member</option>
            </select>
        </div>
        <div class="flex flex-row justify-center items-center">
            <input type="submit" value="Add" name="submit">
            <a href="./index.php?dashboardAdmin.php">Cancel</a>
        </div>
    </form>
</main>