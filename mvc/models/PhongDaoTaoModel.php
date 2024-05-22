<?php
class PhongDaoTaoModel extends DB
{
    public function GetGV()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `MaGV`, `HoTen`, `GT`, `NgaySinh`, k.TenKhoa  FROM `giangvien` as gv, `khoa` as k, `nguoidung` as user WHERE user.ID = '$userID' and user.ID = gv.ID and gv.MaKhoa = k.MaKhoa;";
        return $this->select($SQL);
    }

    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `giangvien` as gv, `nguoidung` as user WHERE user.ID = '$userID'";
        return $this->select($SQL);
    }


    public function GetKhoa()
    {
        $SQL = "SELECT * FROM `khoa`";
        return $this->select($SQL);
    }


    public function Getldnkhoa()
    {
        $MaKhoa = Session::Get('selectValue1');
        $SQL = "SELECT * FROM `lopdn` WHERE MaKhoa = '$MaKhoa'";
        return $this->select($SQL);
    }
}
