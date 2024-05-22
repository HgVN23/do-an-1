<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Mã sinh viên</th>
                <th rowspan="2">Tên sinh viên</th>
                <th rowspan="2">Chuyên cần</th>
                <th colspan="3">Thường xuyên</th>
                <th rowspan="2">Được dự thi</th>
                <th rowspan="2">TB Quá Trình</th>
                <th rowspan="2" data-colums="controls">Chỉnh sửa</th>
            </tr>
            <tr>
                <th>LT Hệ số 1</th>
                <th>LT Hệ số 2</th>
                <th>TH Hệ số 1</th>
            </tr>
        </thead>
        <tbody id="table-body-content">
            <?php
            $sv = $data["object"]->GetSVLHP();
            if ($sv) {
                $i = 1;
                while ($row = mysqli_fetch_array($sv)) {
            ?>
                    <tr>
                        <td data-hide="hide"><?php echo ($i) ?></td>
                        <td dt-msv='msv' data-show="show"><?php echo ($row['MaSV']) ?></td>
                        <td data-show="show"><?php echo ($row['HoTen']) ?></td>
                        <?php
                        $MaSV = $row['MaSV'];
                        $MaHP = $row['MaHP'];
                        $MaLHP = $row['MaLHP'];
                        $diemsv = $data["object"]->GetdiemLHP($MaSV, $MaHP, $MaLHP);
                        if ($diemsv) {

                            while ($rowdiem = mysqli_fetch_array($diemsv)) {
                        ?>
                                <td dt-dcc="dcc" data-show="show" align="center"><?php echo ($rowdiem['DiemCCan']) ?></td>
                                <td data-show="show" align="center"><?php echo ($rowdiem['DiemHS1']) ?></td>
                                <td data-show="show" align="center"><?php echo ($rowdiem['DiemHS2']) ?></td>
                                <td data-show="show" align="center"><?php echo ($rowdiem['DiemTH']) ?></td>
                                <td align="center">
                                    <!-- Cần thay đổi -->
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        if ($rowdiem['DiemCCan'] > 6) {
                                            echo ('<i class="text-success bi bi-check-circle-fill"></i>');
                                        } else {
                                            echo ('<i class="text-danger bi bi-x-circle-fill"></i>');
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td dt-tkqt="tkqt" data-hide="hide" align="center"><?php echo ($rowdiem['DiemTKQT']) ?></td>

                                <td data-hide="hide">
                                    <div class="d-flex justify-content-center gap-3">
                                        <i class="btn-edit bi bi-pencil-square"></i>
                                    </div>
                                </td>
                            <?php
                            }
                        } else {
                            ?>
                            <td dt-dcc="dcc" data-show="show" align="center"></td>
                            <td data-show="show" align="center"></td>
                            <td data-show="show" align="center"></td>
                            <td data-show="show" align="center"></td>
                            <td data-statethi="check" align="center">
                                <!-- Cần thay đổi -->
                                <div class="state-icon d-flex justify-content-center"></div>
                                <!--  -->
                            </td>
                            <td dt-tkqt="tkqt" data-hide="hide" align="center"></td>
                            <td data-hide="hide">
                                <div class="d-flex justify-content-center gap-3">
                                    <i class="btn-edit bi bi-pencil-square"></i>
                                </div>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>