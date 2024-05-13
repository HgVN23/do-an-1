<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Mã học phần</th>
                <th rowspan="2">Tên học phần</th>
                <th rowspan="2">Số tín chỉ</th>
                <th colspan="2">Thông tin lịch</th>
            </tr>
            <tr>
                <th>Thứ</th>
                <th>Tiết</th>
            </tr>
        </thead>


        <?php
        $hk = $data["object"]->GetHK();
        while ($row = mysqli_fetch_array($hk)) {
        ?><tbody class="tableDropdown">
                <tr class="dClick dActive">
                    <td class="dHeader" colspan="16"><?php echo ("Học kì " . $row['TenHK'] . " (" . $row['namhoc'] . "-" . $row['namhoc'] + 1 . ")"); ?></td>
                </tr>
                <tr class="dHide dShow">
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                </tr>
            </tbody>
        <?php
        }
        ?>

    </table>
</div>