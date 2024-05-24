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

            $query = "SELECT * FROM nguoidung WHERE Username = '$Username' and nguoidung.`Password` = md5('$Password')";
            $result = $this->select($query);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::Set("dangnhap", true);
                Session::Set("userid", $value['ID']);
                Session::Set("username", $value['Username']);
                Session::Set("role", $value['Role']);
                setcookie("userid",  $value['ID'], time() + (86400 * 30), "/");

                header('location: trang-chu');
            } else {
                $alert = '<p style="color: red">Tên đăng nhập hoặc mật khẩu không đúng</p>';
                return $alert;
            }
        }
    }
}
