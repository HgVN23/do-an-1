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
            <option selected>Học kì</option>
            <option value='HK05'>Học kì 1</option>
            <option value='HK06'>Học kì 2</option>
        </select>
        <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
    </div>
    <div class="d-flex align-items-center justify-content-end gap-3 w-50">
        <button class="btn-add btn btn-primary fw-semibold">Thêm</button>
        <button class="btn btn-primary fw-semibold">In</button>
    </div>
</div>
<div class="table-responsive type1 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th>STT</th>
                <th>Học phần</th>
                <th>Mã học phần</th>
                <th>Số tiết học</th>
                <!-- <th>Khoa phụ trách</th> -->
                <th>Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <td>Test</td>
                <!-- <td>
                    <select class="form-select form-select-sm" aria-label="Small select example">
                        <option selected>Lựa chọn...</option>
                        <option value="1">Công nghệ</option>
                        <option value="2">Kinh tế</option>
                    </select>
                </td> -->
                <td>
                    <div class="d-flex justify-content-center gap-3">
                        <i class="bi bi-pencil-square"></i>
                        <i class="bi bi-trash3"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>