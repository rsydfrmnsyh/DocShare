<?php
class User extends Connection
{
    private $user_id = 0;
    private $username = "";
    private $user_password = "";
    private $email = "";
    private $profile_photo = "";
    private $role = "";

    private $result = false;
    private $message = "";

    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        }

    }

    public function __set($attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $value;
        }

    }

    public function SelectUserById()
    {
        $sql = "SELECT user_id, username, email, role, profile_photo FROM tbl_users WHERE user_id='$this->user_id'";
        $resultUser = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($resultUser) == 1) {
            $data = mysqli_fetch_assoc($resultUser);
            $objUser = new User();
            $objUser->user_id = $data["user_id"];
            $objUser->username = $data["username"];
            $objUser->email = $data["email"];
            $objUser->role = $data["role"];
            $objUser->profile_photo = $data["profile_photo"];
            $objUser->result = true;
            print_r($data);
        }
    }

    public function SelectAllUser()
    {
        $sql = "SELECT user_id, username, email, profile_photo FROM tbl_users ORDER BY username ASC";
        $resultUser = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $i = 0;
        if (mysqli_num_rows($resultUser) > 0) {
            while ($data = mysqli_fetch_array($resultUser)) {
                $arrResult[$i] = array(
                    "user_id" => $data["user_id"],
                    "username" => $data["username"],
                    "email" => $data["email"],
                    "profile_photo" => $data["profile_photo"]
                );
                $i++;
            }
        }
        return $arrResult;
    }

    public function SelectAllUserByMember()
    {
        $sql = "SELECT user_id, username, email, profile_photo FROM tbl_users WHERE role='member' ORDER BY username ASC";
        $resultUser = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $i = 0;
        if (mysqli_num_rows($resultUser) > 0) {
            while ($data = mysqli_fetch_array($resultUser)) {
                $objUser = new User();
                $objUser->user_id = $data["user_id"];
                $objUser->username = $data["username"];
                $objUser->email = $data["email"];
                $objUser->profile_photo = $data["profile_photo"];
                $arrResult[$i] = $objUser;
                $i++;
            }
        }
        return $arrResult;
    }

    public function SelectAllUserByAdmin()
    {
        $sql = "SELECT user_id, username, email, profile_photo FROM tbl_users WHERE role='admin' ORDER BY username ASC";
        $resultUser = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $i = 0;
        if (mysqli_num_rows($resultUser) > 0) {
            while ($data = mysqli_fetch_array($resultUser)) {
                $objUser = new User();
                $objUser->user_id = $data["user_id"];
                $objUser->username = $data["username"];
                $objUser->email = $data["email"];
                $objUser->profile_photo = $data["profile_photo"];
                $arrResult[$i] = $objUser;
                $i++;
            }
        }
        return $arrResult;
    }

    public function AddUser()
    {
        $sql = "INSERT INTO tbl_users(username, email, password " . (($this->role !== "") ? ", role" : "") . ") VALUES  ('$this->username', '$this->email', '$this->user_password'" . (($this->role !== "") && ($this->role === "admin") ? ", 'admin'" : "") . ");";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "Data berhasil di tambahkan";
        } else {
            $this->message = "Data gagal di masukkan";
        }
    }

    public function UpdateUser()
    {
        $this->connect();

        $sql = "UPDATE FROM tbl_users SET username='$this->username', email='$this->email', profile_photo='$this->profile_photo', role='$this->role', password='$this->user_password' WHERE user_id='$this->user_id'";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "Data Berhasil ditambahkan";
        } else {
            $this->message = "Data gagal di tmabhakna";
        }
    }

    public function DeleteUser()
    {
        $this->connect();

        $sql = "DELETE FROM tbl_users WHERE user_id='$this->user_id'";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "Data berhasil di tambahkan";
        } else {
            $this->message = "Data gagal di masukkan";
        }
    }

}
?>