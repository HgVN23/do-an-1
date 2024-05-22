<div class="table-responsive type2 shadow-sm">
    <table class="table">
        <thead class="sticky-top">
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Mã học phần</th>
                <th rowspan="2">Tên học phần</th>
                <th rowspan="2">Số tín chỉ</th>
                <th colspan="2">Số tiết</th>
            </tr>

        </thead>


        <?php
        $hk = $data["object"]->GetHK();
        while ($row = mysqli_fetch_array($hk)) {
            $mahk = $row['MaHK'];
        ?>
            <tbody class="tableDropdown">
                <tr class="dClick dActive">
                    <td class="dHeader" colspan="16"><?php
                                                        if ($row['TenHK'] == "I")
                                                            echo ($row['TenHK'] . " (" . $row['namhoc'] . "-" . $row['namhoc'] + 1 . ")");
                                                        else
                                                            echo ($row['TenHK'] . " (" . $row['namhoc'] - 1 . "-" . $row['namhoc'] . ")");
                                                        ?></td>
                </tr>
                <?php
                $ctk = $data["object"]->GetCTK($mahk);
                $i = 1;
                while ($rowctk = mysqli_fetch_array($ctk)) {
                ?>
                    <tr class="dHide dShow">
                        <td align="center"><?php echo ($i) ?></td>
                        <td align="center"><?php echo ($rowctk['MaHP']) ?></td>
                        <td><?php echo ($rowctk['TenHP']) ?></td>
                        <td align="center"><?php echo ($rowctk['SoTC']) ?></td>
                        <td align="center"><?php echo ($rowctk['SoTiet']) ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        <?php
        }
        ?>

    </table>
</div>