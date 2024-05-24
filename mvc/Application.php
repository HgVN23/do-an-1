<?php
require_once "./core/App.php";
require_once "./core/Controller.php";
require_once "./core/DB.php";
require_once "./core/Session.php";


if (isset($_POST['changebtn'])) {
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $userID = $_COOKIE['userid'];
    $qrcrpass = (new DB())->select("SELECT `Password` FROM `nguoidung` WHERE ID = '$userID'");
    $crpass = mysqli_fetch_assoc($qrcrpass)['Password'];
    $checkoldpass = strcmp($oldpass, $crpass);
    $statechangepass = false;
    if ($checkoldpass) {
        $statechangepass = (new DB())->update("UPDATE `nguoidung` SET `Password`= md5('$newpass') WHERE `ID` = '$userID'");
        // $statechangepass = true;
    }
    setcookie("checkoldpass",  $checkoldpass, time() + 60, "/");
    setcookie("statechangepass", $statechangepass, time() + 60, "/");
}

if (isset($_POST['filter'])) {
    $selectValues = array(); // Tạo một mảng để lưu giá trị của các select values
    foreach ($_POST as $key => $value) {
        // Kiểm tra nếu key bắt đầu bằng "selectValue"
        if (strpos($key, 'selectValue') === 0) {
            Session::set($key, $value);
        }
    }
}


// khoa
if (isset($_POST['save'])) {
    $data = json_decode($_POST['data']);
    $dbcon = new DB();
    foreach ($data as $key => $value) {
        $MHP = $value[0];
        $MaLHP = $value[1];
        $MGV = $value[2];

        $query = "UPDATE gvlhp  
                SET MaGV = '$MGV'
                WHERE MaLHP = '$MaLHP'";
        $dbcon->update($query);
    }
}




if (isset($_POST['updateInfo'])) {
    $query = "";
    $values = json_decode($_POST['values'], true);
    session_start();
    $roleuser = Session::Get('role');
    // $HK = Session::Get('selectValue2');
    $HK = null;
    if ($roleuser == 5) {
        $HK = Session::Get('selectValue2');
    }


    if ($roleuser == 4) {
        // khoa
        $magv = $values[0];
        $hotennew = $values[1];
        $ngaysinhnew = $values[2];
        $gioitinhnew = $values[3] == "Nam" ? 1 : 0;
        $hocvinew = $values[4];
        $query = "UPDATE `giangvien` SET `HoTen`='$hotennew',`HocVi`='$hocvinew',`NgaySinh`='$ngaysinhnew',`GT`= $gioitinhnew WHERE  `MaGV`='$magv';";
    } elseif ($roleuser == 5) {
        // ctsv
        $masv = $values[0];
        $drl = $values[2];
        $query = "UPDATE `svdiemrenluyen` 
                SET `DiemRL`= $drl,
                `xeploai`=
                CASE 
                    WHEN DiemRL >= 90 THEN 'Xuất sắc'
                    WHEN (DiemRL >= 80 AND DiemRL < 90) THEN 'Giỏi'
                    WHEN (DiemRL >= 65 AND DiemRL < 80) THEN 'Khá'
                    WHEN (DiemRL >= 40 AND DiemRL < 65) THEN 'Trung bình'
                    ELSE 'Yếu'
                END 
                WHERE `MaSV`= '$masv' AND `MaHK` = '$HK'";
    } elseif ($roleuser == 2) {
        // giảng viên

        // values, ["2110310096","Phạm Đăng Hải","10","7","8","7"]
        $MaHP = $_POST['mahocphan'];
        $MaLHP = $_POST['malophocphan'];
        $MaSV = $values[0];
        $MaD = null;
        $qrcheckmd = "SELECT `MaD` FROM sinhvienhpdiemhk as svhk
                      WHERE svhk.MaSV = '$MaSV' AND svhk.MaHP = '$MaHP'";
        echo ($MaSV . "---" . $MaHP);
        $condb = new DB();
        $rscheckmd = mysqli_fetch_assoc($condb->select($qrcheckmd))['MaD'];
        if (!$rscheckmd) {
            $qrlmd = "SELECT MaD FROM `diem` ORDER BY MaD DESC LIMIT 1";
            $lastmd =  mysqli_fetch_assoc($condb->select($qrlmd))['MaD'];
            $nummd = substr($lastmd, 1);
            $nummd++;
            $MaD = "D" . $nummd;
            $condb->insert("INSERT INTO `diem` (`MaD`) VALUES ('$MaD')");
            $condb->update("UPDATE `sinhvienhpdiemhk` SET `MaD` = '$MaD' WHERE `MaSV` = '$MaSV'");
        } else {
            $MaD = $rscheckmd;
        }

        echo ($MaD);
        if ($MaD) {
            $query = "UPDATE  `diem` SET `DiemCCan`='$values[2]', `DiemHS1`='$values[3]', `DiemHS2`='$values[4]', `DiemTH`='$values[5]'
        WHERE `MaD` = '$MaD'";
        }
    }


    if (!empty($query)) {
        $dbcon = new DB();
        $dbcon->update($query);
        if ($roleuser == 5) {
            $qrxl = "SELECT `DiemRL`, `xeploai` FROM `svdiemrenluyen` WHERE `MaSV`= '$values[0]' AND `MaHK` = '$HK'";
            $rstmp = $dbcon->select($qrxl);
            $rs = mysqli_fetch_assoc($rstmp)['xeploai'];
            setcookie("xeploai", $rs, time() + (86400 * 30), "/");
        }
    }
}

if (isset($_POST['btnSbAdd'])) {
    $query = "";
    $values = json_decode($_POST['values'], true);
    session_start();
    $roleuser = Session::Get('role');
    $checkStateAdd = false;
    $dbcon = new DB();
    if ($roleuser == 4) {

        $gt = (strval($values[3]) == "Nam") ? 1 : 0;
        $query = "INSERT INTO `giangvien`(`MaGV`, `HoTen`, `NgaySinh`, `GT`, `HocVi`, `MaKhoa`) VALUES 
        (
            '$values[0]', '$values[1]', '$values[2]', $gt,'$values[4]','$values[5]'
        )";
    } elseif ($roleuser == 3) {
    }
    $checkStateAdd = $dbcon->insert($query);
    setcookie("checkStateAdd",  $checkStateAdd, time() + 60, "/");
}

if (isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $dbcon = new DB();
    $query = "DELETE FROM `giangvien` WHERE MaGV = '$id'";
    $dbcon->delete($query);
}



// trang ctsv;
if (isset($_POST['selectNH'])) {
    $nam1 = $_POST['nam1'];
    $nam2 = $_POST['nam2'];
    $query = "SELECT `MaHK`, `TenHK`, `NamHoc` FROM `hocky` WHERE (year(NamHoc) = $nam1 and TenHK = 'I') OR (year(NamHoc) = $nam2 and TenHK = 'II')";
    $runqr =  (new DB())->select($query);
    $arrayhk = [];
    while ($row = mysqli_fetch_array($runqr)) {
        $arrayhk[] = $row['MaHK'];
    }

    setcookie("hocKys", json_encode($arrayhk), time() + (86400 * 30), "/");
}

if (isset($_POST['selectKH'])) {
    $makihoc = $_POST['Makihoc'];
    $query = "SELECT DISTINCT ldn.* FROM lopdn as ldn
            INNER JOIN hkhplopdn as hkhpldn 
            ON hkhpldn.MaLop = ldn.MaLop AND hkhpldn.MaHK = '$makihoc'";
    $runqr = (new DB())->select($query);
    $arrlh = [];
    while ($row = mysqli_fetch_array($runqr)) {
        $arrlh[] = array($row['MaLop'], $row['TenLop']);
    }
    print_r(json_encode($arrlh));
    setcookie("lophocs", json_encode($arrlh), time() + (86400 * 30), "/");
}

// giảng viên
if (isset($_POST['selectMonDay'])) {
    $userID = $_COOKIE['userid'];
    $MaHP = $_POST['selectedOption'];

    $query = "SELECT lhp.*, thlhp.Thu,thlhp.Tiet  from lophp as lhp
            JOIN tiethoclhp as thlhp ON thlhp.MaLHP = lhp.MaLHP
            JOIN gvlhp as gvl ON gvl.MaLHP = lhp.MaLHP 
            JOIN giangvien AS GV ON gv.MaGV = gvl.MaGV and gv.ID ='$userID'
            JOIN hocphan as hp ON hp.MaHP = lhp.MaHP AND hp.MaHP = '$MaHP'";
    $runqr = (new DB())->select($query);
    $arrlh = [];
    while ($row = mysqli_fetch_array($runqr)) {
        $arrlh[] = array($row['MaLHP'], $row['TenLopHP'], $row['Thu'], $row['Tiet']);
    }
    setcookie("lophocs", json_encode($arrlh), time() + (86400 * 30), "/");
}


if (isset($_POST['btnUpdateTBQT'])) {
    $arrsmsv = json_decode($_POST['arrsmsv'], true);
    $MaHP = $_POST['mahocphan'];
    $MaLHP = $_POST['malophocphan'];
    $masv_list = implode("','", $arrsmsv);
    $masv_list = "'" . $masv_list . "'";
    $dbcon = new DB();
    $arrvalues = [];

    $rs = $dbcon->select("SELECT svhk.* FROM sinhvienhpdiemhk as svhk 
                        WHERE svhk.MaSV IN ($masv_list) 
                        and svhk.MaHP = '$MaHP' AND svhk.MaD IS NOT NULL;");

    while ($row = mysqli_fetch_array($rs)) {
        $arrMD[$row['MaSV']] = $row['MaD'];
    }
    $maD_list = implode(",", $arrMD);
    $maD_list = "'" . $maD_list . "'";
    $strqr = "CALL UpdatediemTBQT($maD_list, ',')";
    $strqr = "CALL UpdateDiemTKHP($maD_list, ',')";
    $dbcon->query($strqr);

    $qrdtkqt = $dbcon->select("SELECT svhk.MaSV, d.DiemTKQT FROM `sinhvienhpdiemhk` AS svhk
                                JOIN diem as d ON d.MaD = svhk.MaD
                                WHERE svhk.MaSV IN ($masv_list)
                                AND SVHK.MaHP = '$MaHP' 
                                AND svhk.MaD IS NOT NULL 
                                AND D.DiemTKQT IS NOT NULL;");
    $arrMSVTKQT = [];
    while ($rowrs = mysqli_fetch_array($qrdtkqt)) {
        $arrMSVTKQT[$rowrs['MaSV']] = $rowrs['DiemTKQT'];
    }
?>
    <div id="contenthide" style="display:none;"><?php
                                                setcookie("statedatatk", true, time() + 86400, "/");
                                                echo json_encode($arrMSVTKQT);
                                                ?></div>
<?php
}
