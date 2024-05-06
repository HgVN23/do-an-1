<?php
class UserLogin extends DB
{
    function InfoLogin($user, $password)
    {
        $Username = trim($user);
        $Password = trim($password);

        $Username = mysqli_real_escape_string($this->conn, $Username);
        $Password = mysqli_real_escape_string($this->conn, $Password);

        if (empty($Username) || empty($Password)) {
            $alert = "Tên đăng nhập và mật khẩu không được để trống";
        } else {
            $query = "SELECT * FROM nguoidung WHERE Username = '$Username' And Password = md5('$Password')";
            $result = $this->select($query);
            if ($result) {
            }
        }
    }
}
