<div class="d-flex">
    <section class="cSec mx-auto mt-5 d-flex flex-column gap-4">
        <div class="bg-white p-3 d-flex align-items-center justify-content-between rounded shadow-sm">
            <div class="d-flex align-items-center gap-3 w-50">
                <select class="form-select-namhoc select-filter form-select form-select-sm w-25" aria-label="Small select example">
                    <option selected>Năm học</option>
                    <?php
                    $NamHoc = $data["object"]->GetNamHoc();
                    if ($NamHoc) {
                        while ($row = mysqli_fetch_array($NamHoc)) {
                            $namhoc = $row['namhoc'] . "-" . ($row['namhoc'] + 1);
                            echo ("<option value='$namhoc'>$namhoc</option>");
                        }
                    }
                    ?>
                </select>
                <select class="form-select-KH select-filter form-select form-select-sm w-25" aria-label="Small select example">
                    <option selected>Học kỳ</option>

                </select>
                <select class="form-select-lophoc select-filter form-select form-select-sm w-25" aria-label="Small select example">
                    <option selected>Lớp</option>
                </select>

                <button class="btn-filter btn btn-success fw-semibold">Lọc</button>
            </div>
            <div class="d-flex align-items-center justify-content-end gap-3 w-50">
                <button class="btn btn-primary fw-semibold">Lưu</button>
            </div>
        </div>
        <div class="table-responsive type2 shadow-sm">
            <table class="table">
                <thead class="sticky-top">
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Điểm rèn luyện</th>
                        <th>Xếp loại</th>
                        <th data-colums="controls">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody id="table-body-content">
                    <?php
                    $sv = $data["object"]->GetSVLop();
                    if ($sv) {
                        $i = 1;
                        while ($row = mysqli_fetch_array($sv)) {
                    ?>
                            <tr>
                                <td data-hide="hide"><?php echo ($i) ?></td>
                                <td data-show="show"><?php echo ($row['MaSV']) ?></td>
                                <td data-show="show"><?php echo ($row['HoTen']) ?></td>
                                <td data-show="show"><?php echo ($row['DiemRL']) ?></td>
                                <td data-drl="drl"><?php echo ($row['Xeploai']) ?></td>
                                <td data-hide="hide">
                                    <div class="d-flex justify-content-center gap-3">
                                        <i class="btn-edit bi bi-pencil-square"></i>
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
    </section>


</div>