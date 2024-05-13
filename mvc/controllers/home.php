<?php
class Home extends Controller
{
    public $arr = array(
        1 => array('model' => 'SinhVienModel',      'pathdir' => 'SinhVienViews',       'paramdf' => 'ket-qua-hoc-tap',                 'fileview' => 'trang-chu-sinh-vien'),
        2 => array('model' => 'GiangVienModel',     'pathdir' => 'GiangVienViews',      'paramdf' => 'lich-giang-day',                  'fileview' => 'trang-chu-giang-vien'),
        3 => array('model' => 'PhongDaoTaoModel',   'pathdir' => 'PhongDaoTaoViews',    'paramdf' => 'chuong-trinh-khung',              'fileview' => 'trang-chu-phong-dao-tao'),
        4 => array('model' => 'KhoaModel',          'pathdir' => 'KhoaViews',           'paramdf' => 'chuong-trinh-khung',              'fileview' => 'trang-chu-khoa'),
        5 => array('model' => 'CTSVModel',          'pathdir' => 'CTSVViews',           'paramdf' => 'cap-nhat-diem-ren-luyen',         'fileview' => 'trang-chu-CTSV'),
        6 => array('model' => 'PhongKhaoThiModel',  'pathdir' => 'PhongKhaoThiViews',   'paramdf' => 'cap-nhat-diem-thi',               'fileview' => 'trang-chu-khao-thi'),
    );

    function show($param = "trang-chu")
    {
        $isLogin = Session::checkLogin();
        if ($isLogin) {
            $roleuser = Session::get('role');
            // 1 (sinh vien)
            // 2 (Giang vien)
            // 3 (Phong dao tao)
            // 4 (Khoa)
            // 5 (cap nhat diem ren luyen)
            // 6 (khao thi)

            $filecheck = "../mvc/views/" . $this->arr[$roleuser]['pathdir'] . "/" . $param . ".php";

            if (!file_exists($filecheck)) {

                $param =  $this->arr[$roleuser]['paramdf'];
            }

            $object = $this->model($this->arr[$roleuser]['model']);
            $data = [
                "object" => $object,
                "body" => $param,
            ];
            $Pathdir = $this->arr[$roleuser]['pathdir'];
            $Fileview = $this->arr[$roleuser]['fileview'];
            $this->view($Pathdir, $Fileview, $data);
        } else {
            $this->view("dangnhap", "dang-nhap");
        }
    }
}
