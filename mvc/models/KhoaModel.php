<?php
class KhoaModel extends DB
{

    public function GetOtherQR($SQL)
    {
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

    public function GetHKCTK()
    {
        $SQL = "SELECT `MaHK`, `TenHK`, YEAR(`NamHoc`) AS namhoc FROM `hocky`";
        return $this->select($SQL);
    }

    public function GetGVbyKhoa()
    {
        $MaKhoa = Session::Get('selectValue1');
        $SQL = "SELECT * FROM `giangvien` WHERE `MaKhoa` = '$MaKhoa'";
        return $this->select($SQL);
    }

    public function GetCTKbyKy()
    {
        $MaKhoa = Session::Get('selectValue1');
        $MaHK = Session::Get('selectValue2');
        $SQL = "SELECT DISTINCT  hp.MaHP, hp.SoTC, lhp.MaLHP, lhp.TenLopHP, glhp.MaGV, thlhp.Thu, thlhp.Tiet  FROM hocphan AS hp
                                INNER JOIN lophp AS lhp ON lhp.MaHP = hp.MaHP
                                INNER JOIN gvlhp as glhp ON glhp.MaLHP = lhp.MaLHP
                                INNER JOIN tiethoclhp AS thlhp ON thlhp.MaLHP = lhp.MaLHP
                                INNER JOIN hkhplopdn AS hkhpldn ON hkhpldn.MaHP = hp.MaHP
                                INNER JOIN hocky AS hk ON hk.MaHK = hkhpldn.MaHK and hk.MaHK = '$MaHK'
                                WHERE hp.MaKhoa = '$MaKhoa' ORDER BY LHP.MaLHP ASC;";
        return mysqli_query($this->conn,  $SQL);
    }

    public function GetAllGV()
    {
        $SQL = "SELECT * FROM `giangvien`";
        return $this->select($SQL);
    }
}
