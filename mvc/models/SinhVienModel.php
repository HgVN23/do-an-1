<?php
class SinhVienModel extends DB
{

    public function GetSV()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `MaSV`, `HoTen`, `GT`, `NgaySinh`, `Nganh`, `Username`  FROM `sinhvien` as sv, `nguoidung` as user WHERE user.ID = '$userID' and user.ID = sv.ID";
        return $this->select($SQL);
    }

    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `sinhvien` as sv, `nguoidung` as user WHERE user.ID = '$userID' and user.ID = sv.ID";
        return $this->select($SQL);
    }

    public function GetHK()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT DISTINCT hk.MaHK, hk.TenHK,  YEAR(hk.NamHoc) as namhoc FROM hocky AS hk  
                INNER JOIN hkhplopdn AS T ON T.MaHK = hk.MaHK 
                INNER JOIN lopdnsv AS ldnsv ON ldnsv.MaLop = T.MaLop 
                INNER JOIN sinhvien AS sv ON sv.MaSV = ldnsv.MaSV
                INNER JOIN nguoidung as user ON user.ID = sv.ID and user.ID = $userID";
        return $this->select($SQL);
    }
}
