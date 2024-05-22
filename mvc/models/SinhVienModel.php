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


    public function GetDRL($hk)
    {
        $userID = Session::get('userid');
        $SQL = "SELECT svdrl.* FROM `svdiemrenluyen` as svdrl
                INNER JOIN sinhvien as sv ON sv.MaSV = svdrl.MaSV AND svdrl.MaHK = '$hk'
                INNER JOIN nguoidung as nd ON sv.ID = nd.ID
                WHERE nd.ID = '$userID'";
        return $this->select($SQL);
    }

    public function GetCTK($hk)
    {
        $userID = Session::get('userid');
        $SQL = "SELECT hp.* FROM `hocphan` as hp
                INNER JOIN khoa AS K ON K.MaKhoa = HP.MaKhoa
                INNER JOIN sinhvienkhoa as svk ON svk.MaKhoa = k.MaKhoa
                INNER JOIN sinhvien as sv ON sv.MaSV = svk.MaSV AND sv.ID = '$userID'
                INNER JOIN hkhplopdn as hkhpldn ON hp.MaHP = hkhpldn.MaHP
                INNER JOIN lopdnsv as ldnsv ON ldnsv.MaLop = hkhpldn.MaLop and ldnsv.MaSV = sv.MaSV
                WHERE hkhpldn.MaHK = '$hk'";
        return $this->select($SQL);
    }


    public function GetLichTTD($hk)
    {
        $userID = Session::get('userid');
        $SQL = "SELECT hp.*, th.Thu, th.Tiet, gv.MaGV , gv.HoTen FROM hocphan as hp
                JOIN lophp as lhp ON lhp.MaHP = hp.MaHP
                JOIN tiethoclhp as th ON th.MaLHP = lhp.MaLHP
                JOIN gvlhp AS gvp ON gvp.MaLHP = lhp.MaLHP
                JOIN giangvien as gv on gv.MaGV = gvp.MaGV
                JOIN lophpsv as lhpsv ON lhpsv.MaLHP = lhp.MaLHP
                JOIN sinhvienkhoa as svk ON svk.MaSV = lhpsv.MaSV and svk.MaKhoa = hp.MaKhoa
                JOIN hkhplopdn AS hkhpldn ON hkhpldn.MaHP = hp.MaHP and hkhpldn.MaHK = '$hk'
                JOIN lopdnsv as ldnsv on ldnsv.MaLop = hkhpldn.MaLop and ldnsv.MaSV = svk.MaSV
                where svk.MaSV = (SELECT sv.MaSV from sinhvien as sv where sv.ID = '$userID')";
        return $this->select($SQL);
    }

    public function getDiemHP($hk)
    {
        $userID = Session::get('userid');
        $SQL = "SELECT hp.*, d.* FROM `diem` as d 
                JOIN sinhvienhpdiemhk as svhpdhk ON svhpdhk.MaD = d.MaD
                JOIN sinhvien as sv ON sv.MaSV = svhpdhk.MaSV
                JOIN hocphan as hp ON hp.MaHP = svhpdhk.MaHP
                WHERE svhpdhk.MaHK = '$hk' AND sv.MaSV = (SELECT sv.MaSV from sinhvien as sv where sv.ID = '$userID')";
        return $this->select($SQL);
    }


    public function GetKQ($hk)
    {
        $userID = Session::get('userid');
        $SQL = "SELECT kq.* from ketqua as kq
                JOIN ketquasv as kqsv ON kqsv.MaDiemTK = kq.MaDiemTk
                JOIN sinhvien as sv ON sv.MaSV = kqsv.Masv and sv.id = $userID
                where kq.MaHK = '$hk'";
        return $this->select($SQL);
    }
}
