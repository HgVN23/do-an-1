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
            <select class="form-select-mon form-select select-filter form-select-sm w-25" aria-label="Small select example">
                <option selected>Môn</option>
                <?php
                $monday = $data["object"]->GetMonDay();
                while ($rowmonday = mysqli_fetch_array($monday)) {
                    echo "<option value='{$rowmonday['MaHP']}'>{$rowmonday['TenHP']}</option>";
                }
                ?>


            </select>
            <select class="form-select-lophoc form-select select-filter form-select-sm w-25" aria-label="Small select example">
                <option selected>Lớp</option>
            </select>
            <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
        </div>
        <div class="d-flex align-items-center justify-content-end gap-3 w-50">
            <button class="btn-updateQT btn btn-primary fw-semibold">Cập nhật TBQT</button>
            <button class="btn btn-primary fw-semibold">Lưu</button>
        </div>
    <?php }



    ?>
</div>