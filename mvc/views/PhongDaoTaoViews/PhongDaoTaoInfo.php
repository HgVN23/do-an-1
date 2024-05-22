<div class="bg-white p-3 d-flex align-items-center justify-content-between rounded shadow-sm">
    <div class="d-flex align-items-center gap-3 w-50">

        <select class="select-filter form-select form-select-sm w-25" aria-label="Small select example">
            <option selected>Khoa</option>
            <?php
            $Khoa = $data['object']->GetKhoa();
            while ($rowk = mysqli_fetch_array($Khoa)) {
                echo ("<option value='{$rowk['MaKhoa']}'>{$rowk['TenKhoa']}</option>");
            }
            ?>
        </select>
        <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
    </div>
    <div class="d-flex align-items-center justify-content-end gap-3 w-50">
        <button class="btn-add btn btn-primary fw-semibold">Thêm</button>
        <button class="btn btn-primary fw-semibold">In</button>
    </div>
</div>