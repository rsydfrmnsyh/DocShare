<?php
require_once ('./class/class.User.php');

$objUser = new User();
if (isset($_POST["submit"])) {
    // nge cek username dan email apakah sudah pernah di pakai?
    $arrUser = $objUser->SelectAllUser();
    $objUser->username = $_POST["username"];
    $objUser->email = $_POST["email"];

    $filteredUser = array();
    for ($i = 0; $i < count($arrUser); $i++) {
        if ($arrUser[$i]["username"] === $objUser->username) {
            array_push(
                $filteredUser,
                array(
                    "username" => $arrUser[$i]["username"],
                    "email" => $arrUser[$i]["email"]
                )
            );
            $objUser->result = false;
            $objUser->message = "Username sudah digunakan";
            print_r($filteredUser);
            echo "username sudah digunakan";
        } else if ($arrUser[$i]["email"] === $objUser->email) {
            array_push(
                $filteredUser,
                array(
                    "username" => $arrUser[$i]["username"],
                    "email" => $arrUser[$i]["email"]
                )
            );
            $objUser->result = false;
            $objUser->message = "Email sudah digunakan";
            print_r($filteredUser);
            echo "email sudah digunakan";
        } else {
            $objUser->result = true;
            $objUser->message = "Berhasil menambahkan data user";
        }
    }

    if ($objUser->result && count($filteredUser) > 0) {
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
            <a href="./index.php?signin.php">Cancel</a>
        </div>
    </form>
</main>