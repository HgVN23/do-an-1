<?php
class CTSVModel extends DB
{
    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `giangvien` as gv, `nguoidung` as user WHERE user.ID = '$userID'";
        return $this->select($SQL);
    }

    public function GetNamHoc()
    {
        $SQL = "SELECT DISTINCT YEAR(NamHoc) AS namhoc FROM hocky";
        return $this->select($SQL);
    }

    public function GetSVLop()
    {
        $MaHK = Session::Get('selectValue2');
        $Lop = Session::Get('selectValue3');
        $SQL = "SELECT sv.*, svdrl.DiemRL, svdrl.Xeploai FROM sinhvien AS sv
                JOIN lopdnsv as ldnsv ON ldnsv.MaSV = sv.MaSV and ldnsv.MaLop = '$Lop '
                JOIN svdiemrenluyen AS svdrl ON svdrl.MaSV = sv.MaSV AND svdrl.MaHK = '$MaHK'";
        return $this->select($SQL);
    }
}
