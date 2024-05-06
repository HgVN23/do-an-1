<div class="txtInfo bg-white p-3 d-flex justify-content-between rounded shadow-sm">
    <?php
    // Đặt con trỏ về vị trí đầu tiên của kết quả
    mysqli_data_seek($data["sinhvien"], 0);

    while ($row = mysqli_fetch_array($data["sinhvien"])) {
    ?>

        <div class="d-flex flex-column gap-1 w-50">
            <p id="txtHoTen" class="m-0"><?php echo $row["HoTen"]  ?></p>
            <p id="txtGioiTinh" class="m-0"><?php echo $row["GT"] ? "Nam" : "Nữ";  ?></p>
            <p id="txtNgaySinh" class="m-0"><?php echo date("d/m/Y", strtotime($row["NgaySinh"]));  ?></p>
        </div>
        <div class="d-flex flex-column gap-1 w-50">
            <p id="txtMaSV" class="m-0"><?php echo $row["MaSV"]  ?></p>
            <p id="txtKhoa" class="m-0"><?php echo $row["Nganh"]  ?></p>
        </div>
    <?php } ?>
</div>