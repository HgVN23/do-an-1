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
<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Mã sinh viên</th>
                <th rowspan="2">Tên sinh viên</th>
                <th rowspan="2">Chuyên cần</th>
                <th colspan="3">Thường xuyên</th>
                <th rowspan="2">TB quá trình</th>
                <th rowspan="2">Được dự thi</th>
            </tr>
            <tr>
                <th>LT Hệ số 1</th>
                <th>LT Hệ số 2</th>
                <th>TH Hệ số 1</th>
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
                <td>
                    <!-- Cần thay đổi -->
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <!--  -->
                </td>
            </tr>
            <tr>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>
                    <!-- Cần thay đổi -->
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-x-lg"></i>
                    </div>
                    <!--  -->
                </td>
            </tr>
        </tbody>
    </table>
</div>