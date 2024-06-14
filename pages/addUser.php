<?php

if (!isset($_SESSION["user_id"]) && !$_SESSION["role"] != "admin") {
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
            echo "<script>window.location.href='./index.php?p=listUser';</script>";
        } else {
            echo "<script>alert('$objUser->message');</script>";
            echo "<script>window.location.href='./index.php?p=addUser';</script>";
        }
    }
}
?>
<main class="w-4/5 h-full flex flex-column flex-wrap justify-center items-center gap-4">
    <div class="w-full h-1/3 p-10 rounded-lg bg-blue shadow flex flex-column justify-center items-center">
        <h1 class="font-semibold text-center text-5xl text-white">Add User</h1>
    </div>
    <form action="" method="post"
        class="w-full h-2/3 p-10 rounded-lg bg-white shadow flex flex-column flex-wrap justify-center items-center">
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="username" class="font-semibold text-xl w-1/5">Username</label>
            <input type="text" name="username" id="username"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="password" class="font-semibold text-xl w-1/5">Password</label>
            <input type="password" name="password" id="password"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="email" class="font-semibold text-xl w-1/5">Email</label>
            <input type="text" name="email" id="email"
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue"
                required>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <label for="role" class="font-semibold text-xl w-1/5">Role</label>
            <select name="role" id="role" required
                class="px-4 py-2 w-4/5 text-lg outline-none border-4 rounded-lg border-black focus:border-blue cursor-pointer">
                <option value="" selected disabled>-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="member">member</option>
            </select>
        </div>
        <div class="flex flex-column items-center justify-start gap-4 w-full">
            <input type="submit" value="Add" name="submit"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-blue hover:bg-black cursor-pointer">
            <a href="./index.php?dashboardAdmin.php"
                class="w-1/2 px-4 py-2 text-center font-semibold text-white rounded-lg bg-red-600 hover:bg-black cursor-pointer">Cancel</a>
        </div>
    </form>
</main>