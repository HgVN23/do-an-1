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
<div class="table-responsive type1 shadow-sm">
    <table class="table" id="table-body-content">
        <thead class="sticky-top">
            <tr>
                <th>STT</th>
                <th>Tên lớp</th>
                <th data-colums="controls">Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ldn = $data["object"]->Getldnkhoa();
            if ($ldn) {
                $i = 1;
                while ($row = mysqli_fetch_array($ldn)) {
            ?>
                    <tr>
                        <td align="center" data-hide="hide"><?php echo ($i) ?></td>
                        <td align="center" data-show="show"><?php echo ($row['TenLop']) ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                <i class="btn-edit bi bi-pencil-square"></i>
                                <!-- <i class="bi bi-trash3"></i> -->
                            </div>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>