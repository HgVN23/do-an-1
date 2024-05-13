<?php
class PhongKhaoThiModel extends DB
{
    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `giangvien` as gv, `nguoidung` as user WHERE user.ID = '$userID'";
        return mysqli_query($this->conn, $SQL);
    }
}
