<div class="bg-white p-3 d-flex align-items-center justify-content-between rounded shadow-sm">
    <div class="d-flex align-items-center gap-3 w-50">
        <select class="select-filter form-select form-select-sm" style="width: 30%;" aria-label="Small select example">
            <option selected>Khoa</option>
            <?php
            $khoa = $data["object"]->GetKhoa();

            while ($row = mysqli_fetch_array($khoa)) {
            ?>
                <option value="<?php echo ($row['MaKhoa']) ?>"><?php echo ($row['TenKhoa']) ?></option>
            <?php

            }
            ?>
        </select>
        <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
    </div>
    <div class="d-flex align-items-center justify-content-end gap-3 w-50">
        <button class="btn btn-secondary px-2 fw-semibold"><i class="bi bi-upload"></i> Thêm giảng viên</button>
        <button class="btn btn-primary fw-semibold">In</button>
    </div>
</div>
<table id="table-container" class="table">
    <thead class="sticky-top">
        <tr>
            <th>STT</th>
            <th>Mã giảng viên</th>
            <th>Họ và Tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Học vị</th>
            <th>Chỉnh sửa</th>
        </tr>
    </thead>


    <tbody id="table-body-content">
        <?php
        $dsgv = $data["object"]->GetGVbyKhoa();
        $i = 1;
        while ($row = mysqli_fetch_array($dsgv)) {
        ?>
            <tr>
                <td><?php echo ($i) ?></td>
                <td><?php echo ($row['MaGV']) ?></td>
                <td><?php echo ($row['HoTen']) ?></td>
                <td><?php echo (date("d/m/Y", strtotime($row['NgaySinh']))) ?></td>
                <td><?php $gt = $row['GT'] == 1 ? "Nam" : "Nữ";
                    echo ($gt); ?></td>
                <td><?php echo ($row['HocVi']) ?></td>
                <td>
                    <div class="d-flex justify-content-center gap-3">
                        <i class="bi bi-pencil-square"></i>
                        <i class="bi bi-trash3"></i>
                    </div>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>

</table>
</div>