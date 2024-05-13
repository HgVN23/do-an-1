<div class="txtInfo bg-white p-3 d-flex justify-content-between rounded shadow-sm">
    <?php
    if ($data["body"] == "lich-giang-day") {
        $gv = $data["object"]->GetGV();
        // Đặt con trỏ về vị trí đầu tiên của kết quả
        mysqli_data_seek($gv, 0);
        while ($row = mysqli_fetch_array($gv)) {
    ?>
            <div class="d-flex flex-column gap-1 w-50">
                <p id="txtHoTen" class="m-0"><?php echo $row["HoTen"]  ?></p>
                <p id="txtGioiTinh" class="m-0"><?php echo $row["GT"] ? "Nam" : "Nữ";  ?></p>
                <p id="txtNgaySinh" class="m-0"><?php echo date("d/m/Y", strtotime($row["NgaySinh"]));  ?></p>
            </div>
            <div class="d-flex flex-column gap-1 w-50">
                <p id="txtMaGV" class="m-0"><?php echo $row["MaGV"] ?></p>
                <p id="txtKhoa" class="m-0"><?php echo $row["TenKhoa"] ?></p>
            </div>
        <?php }
    } else { ?>
        <div class="d-flex align-items-center gap-3 w-50">
            <select class="form-select form-select-sm w-25" aria-label="Small select example">
                <option selected>Môn</option>
                <option value="1">Lập trình</option>
                <option value="2">Quản trị</option>
            </select>
            <select class="form-select form-select-sm w-25" aria-label="Small select example">
                <option selected>Lớp</option>
                <option value="1">DHTI15A7HN</option>
                <option value="2">DHTI15A8HN</option>
            </select>
            <button class="btn btn-success fw-semibold">Lọc</button>
        </div>
        <div class="d-flex align-items-center justify-content-end gap-3 w-50">
            <button class="btn btn-success fw-semibold">Chỉnh sửa</button>
            <button class="btn btn-primary fw-semibold">Lưu</button>
        </div>
    <?php }



    ?>
</div>