<?php
class CTSVModel extends DB
{
    public function GetUserName()
    {
        $userID = Session::get('userid');
        $SQL = "SELECT `Username`  FROM `giangvien` as gv, `nguoidung` as user WHERE user.ID = '$userID'";
        return $this->select($SQL);
    }
}
