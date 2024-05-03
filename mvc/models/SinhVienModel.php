<?php
class SinhVienModel extends DB
{


    public function GetSV()
    {
        $SQL = "SELECT `MaSV`, `HoTen`, `GT`, `NgaySinh`, `Nganh`, `Username`  FROM `sinhvien` as sv, `nguoidung` as user WHERE user.id = sv.ID limit 1";
        return mysqli_query($this->conn, $SQL);
    }
}
