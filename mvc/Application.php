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
        (new DB())->update("UPDATE `nguoidung` SET `Password`= md5('$newpass') WHERE `ID` = '$userID'");
        $statechangepass = true;
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
