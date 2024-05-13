<?php
class KhoaModel extends DB
{
    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `giangvien` as gv, `nguoidung` as user WHERE user.ID = '$userID'";
        return mysqli_query($this->conn, $SQL);
    }

    public function GetKhoa()
    {
        $SQL = "SELECT * FROM `khoa`";
        return mysqli_query($this->conn, $SQL);
    }

    public function GetHKCTK()
    {
        $SQL = "SELECT `MaHK`, `TenHK`, YEAR(`NamHoc`) AS namhoc FROM `hocky`";
        return mysqli_query($this->conn, $SQL);
    }

    public function GetGVbyKhoa()
    {
        $MaKhoa = Session::Get('selectValue1');
        $SQL = "SELECT * FROM `giangvien` WHERE `MaKhoa` = '$MaKhoa'";
        return mysqli_query($this->conn, $SQL);
    }

    public function GetCTKbyKy()
    {
        $MaKhoa = Session::Get('selectValue1');
        $MaHK = Session::Get('selectValue2');
        $SQL = "SELECT hp.MaHP, hp.SoTC, ldn.TenLop, thlhp.ThoiGian  FROM hocphan AS hp
                INNER JOIN lophp AS lhp ON lhp.MaHP = hp.MaHP
                INNER JOIN tiethoclhp AS thlhp ON thlhp.MaLHP = lhp.MaLHP
                INNER JOIN hkhplopdn AS hkhpldn ON hkhpldn.MaHP = hp.MaHP
                INNER JOIN lopdn AS ldn ON ldn.MaLop = hkhpldn.MaLop
                INNER JOIN hocky AS hk ON hk.MaHK = hkhpldn.MaHK and hk.MaHK = '$MaHK'
                WHERE hp.MaKhoa = '$MaKhoa';";
        return mysqli_query($this->conn, $SQL);
    }

    public function GetAllGV()
    {
        $SQL = "SELECT * FROM `giangvien`";
        return mysqli_query($this->conn, $SQL);
    }
}
