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