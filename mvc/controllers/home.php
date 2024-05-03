<?php
class Home extends Controller
{

    function show()
    {
        $sv = $this->model("sinhVienModel");
        $data = [
            "sinhvien" => $sv->GetSV(),

        ];
        $this->view("SinhVienViews", "sinh-vien-trang-chu", $data);
    }
}
