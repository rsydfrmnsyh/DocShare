<?php
class User extends Connection
{
    private $user_id = 0;
    public $username = "a";
    private $user_password = "a";
    private $email = "a";
    private $profile_photo = "a";
    private $role = "a";

    private $result = false;
    private $message = "";

    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        } else {
            return null;
        }

    }

    public function __set($attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $value;
        }

    }

    public function SelectAllUser()
    {
        $sql = "SELECT user_id, username, role, email, profile_photo FROM tbl_users ORDER BY username ASC";
        $resultUser = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $i = 0;
        if (mysqli_num_rows($resultUser) > 0) {
            while ($data = mysqli_fetch_array($resultUser)) {
                $arrResult[$i] = array(
                    "user_id" => $data["user_id"],
                    "username" => $data["username"],
                    "role" => $data["role"],
                    "email" => $data["email"],
                    "profile_photo" => $data["profile_photo"]
                );
                $i++;
            }
        }
        return $arrResult;
    }
    public function SelectUserById()
    {
        $sql = "SELECT user_id, username, password, email, role FROM tbl_users WHERE user_id='$this->user_id'";
        $resultUser = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($resultUser) == 1) {
            $data = mysqli_fetch_assoc($resultUser);
            $this->user_id = $data["user_id"];
            $this->username = $data["username"];
            $this->user_password = $data["password"];
            $this->email = $data["email"];
            $this->role = $data["role"];

            $this->result = true;
        }
    }
    public function SelectUserByUsername()
    {
        $sql = "SELECT user_id FROM tbl_users WHERE username='$this->username'";
        $resultUser = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($resultUser) == 1) {
            $data = mysqli_fetch_assoc($resultUser);
            $this->user_id = $data["user_id"];
            // $this->user_password = $data["password"];
            // $this->username = $data["username"];
            $this->result = true;
        }
    }

    public function SelectAllUserByMember()
    {
        $sql = "SELECT user_id, username, email, profile_photo FROM tbl_users WHERE role='member' ORDER BY username ASC";
        $resultUser = mysqli_query($this->connection, $sql);

        $arrResult = array();
        $i = 0;
        if (mysqli_num_rows($resultUser) > 0) {
            while ($data = mysqli_fetch_array($resultUser)) {
                $this->user_id = $data["user_id"];
                $this->username = $data["username"];
                $this->email = $data["email"];
                $this->profile_photo = $data["profile_photo"];
                $arrResult[$i] = $this;
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
                $this->user_id = $data["user_id"];
                $this->username = $data["username"];
                $this->email = $data["email"];
                $this->profile_photo = $data["profile_photo"];
                $arrResult[$i] = $this;
                $i++;
            }
        }
        return $arrResult;
    }

    public function AddUser()
    {
        $sql = "INSERT INTO tbl_users(username, email, password , role) VALUE  ('$this->username', '$this->email', '$this->user_password', '$this->role');";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "User added successfully";
        } else {
            $this->message = "Failed to add user";
        }
    }

    public function UpdateUser()
    {
        $this->connect();

        $sql = "UPDATE tbl_users SET username='$this->username', email='$this->email', profile_photo='$this->profile_photo', role='$this->role', password='$this->user_password' WHERE user_id='$this->user_id'";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "User updated successfully";
        } else {
            $this->message = "Failed to update user";
        }
    }

    public function DeleteUser()
    {
        $this->connect();

        $sql = "DELETE FROM tbl_users WHERE user_id='$this->user_id'";
        $this->result = mysqli_query($this->connection, $sql);

        if ($this->result) {
            $this->message = "User deleted successfully";
        } else {
            $this->message = "Failed to delete user";
        }
    }

}
?>