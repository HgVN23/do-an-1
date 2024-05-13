<div class="bg-white p-3 d-flex align-items-center justify-content-between rounded shadow-sm">
    <div class="d-flex align-items-center gap-3 w-50">
        <select class="select-filter form-select form-select-sm" style="width: 30%;" aria-label="Small select example">
            <option selected>Khoa</option>
            <?php
            $khoa = $data["object"]->GetKhoa();

            while ($row = mysqli_fetch_array($khoa)) {
            ?>
                <option value="<?php echo ($row['MaKhoa']) ?>" <?php $row['MaKhoa'] == Session::Get("selectValue1") ? print("selected") : null ?>><?php echo ($row['TenKhoa']) ?></option>
            <?php

            }
            ?>
        </select>
        <select class=" select-filter form-select form-select-sm" style="width: 30%;" aria-label="Small select example">
            <option selected>Kì học</option>
            <!-- <option value="1">II (2023 - 2024)</option> -->
            <?php
            $HKCTK = $data["object"]->GetHKCTK();
            while ($row = mysqli_fetch_array($HKCTK)) {
            ?>
                <option value="<?php echo ($row['MaHK']) ?>" <?php $row['MaHK'] == Session::Get("selectValue2") ? print("selected") : null ?>>
                    <?php echo ($row['TenHK'] . " (" . $row['namhoc'] . "-" . $row['namhoc'] + 1 . ")"); ?>
                </option>
            <?php
            }
            ?>
        </select>

        <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
    </div>
    <div class="d-flex align-items-center justify-content-end gap-3 w-50">
        <button class="btn btn-success fw-semibold">Xuất</button>
        <button class="btn btn-primary fw-semibold">Lưu</button>
    </div>
</div>

<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th>STT</th>
                <th>Mã học phần</th>
                <th>Tín chỉ</th>
                <th>Lớp</th>
                <th>Tiết học</th>
                <th>Giảng viên</th>
            </tr>
        </thead>


        <tbody id="table-body-content">
            <?php
            $ctk = $data["object"]->GetCTKbyKy();
            $i = 1;
            while ($row = mysqli_fetch_array($ctk)) {
            ?>
                <tr>
                    <td><?php echo ($i) ?></td>
                    <td><?php echo ($row['MaHP']) ?></td>
                    <td><?php echo ($row['SoTC']) ?></td>
                    <td><?php echo ($row['TenLop']) ?></td>
                    <td><?php echo ($row['ThoiGian']) ?></td>
                    <td>
                        <select class="select-element form-select form-select-sm" aria-label="Small select example">
                            <option selected>Lựa chọn giảng viên</option>
                            <?php
                            $gv = $data["object"]->GetAllGV();
                            while ($row = mysqli_fetch_array($gv)) {
                            ?>
                                <option value="<?php echo ($row['MaGV']) ?>"><?php echo ($row['HoTen']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>