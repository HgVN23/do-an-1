<?php
class GiangVienModel extends DB
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

    public function GetMonDay()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT DISTINCT hp.* from hocphan as hp
                JOIN lophp as lhp ON lhp.MaHP = hp.MaHP
                JOIN gvlhp as glp ON glp.MaLHP = lhp.MaLHP
                JOIN giangvien as gv ON gv.MaGV = glp.MaGV and gv.ID = '$userID';";
        return $this->select($SQL);
    }

    public function GetSVLHP()
    {
        $userID = Session::get('userid');
        $MaHP = Session::Get('selectValue1');
        $MaLHP = Session::Get('selectValue2');
        $SQL = "SELECT sv.*, hp.*, lhp.MaLHP from sinhvien as sv
                JOIN lophpsv as lhpsv ON lhpsv.MaSV = sv.MaSV
                JOIN lophp as lhp ON lhp.MaLHP = lhpsv.MaLHP
                JOIN hocphan as hp ON hp.MaHP = lhp.MaHP AND hp.MaHP = '$MaHP' and lhp.MaLHP ='$MaLHP'
                JOIN gvlhp as gvl ON gvl.MaLHP = lhp.MaLHP AND gvl.MaGV = (SELECT gv.MaGV from giangvien as gv WHERE gv.id = $userID)";
        return $this->select($SQL);
    }

    public function GetdiemLHP($MaSV, $MaHP, $MaLHP)
    {
        $SQL = "SELECT * FROM diem as d 
                JOIN sinhvienhpdiemhk as svhk ON svhk.MaSV = '$MaSV' AND d.MaD = svhk.MaD
                JOIN hocphan as hp ON hp.MaHP= svhk.MaHP AND hp.MaHP = '$MaHP'
                JOIN lophp as lhp ON hp.MaHP = lhp.MaHP and lhp.MaLHP ='$MaLHP'";
        return $this->select($SQL);
    }
}
