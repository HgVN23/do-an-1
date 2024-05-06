<?php
class Home extends Controller
{

    function show($param =  "ket-qua-hoc-tap")
    {
        if (!file_exists("../mvc/views/SinhVienViews/" . $param . ".php")) {
            $param =  "ket-qua-hoc-tap";
        }
        $sv = $this->model("sinhVienModel");
        $data = [
            "sinhvien" => $sv->GetSV(),
            "body" => $param,
        ];
        $this->view("SinhVienViews", "trang-chu-sinh-vien", $data);
    }
}
