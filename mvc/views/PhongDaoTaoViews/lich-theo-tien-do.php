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
        <select class="select-filter form-select form-select-sm w-25" aria-label="Small select example">
            <option selected>Lớp</option>
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

<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Mã học phần</th>
                <th rowspan="2">Tên học phần</th>
                <th rowspan="2">Số tín chỉ</th>
                <th colspan="2">Thông tin lịch</th>
                <th colspan="2">Thời gian</th>
                <th rowspan="2">Mã giảng viên</th>
                <th rowspan="2">Giảng viên</th>
            </tr>
            <tr>
                <th>Thứ</th>
                <th>Tiết</th>
                <th>Bắt đầu</th>
                <th>Kết thúc</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
            </tr>
        </tbody>
    </table>
</div>