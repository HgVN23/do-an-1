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
				$ltd = $data["object"]->GetLichTTD($mahk);
				$i = 1;
				while ($rowlttd = mysqli_fetch_array($ltd)) {
				?>
					<tr class="dHide dShow">
						<td align="center"><?php echo ($i) ?></td>
						<td align="center"><?php echo ($rowlttd['MaHP']) ?></td>
						<td><?php echo ($rowlttd['TenHP']) ?></td>
						<td align="center"><?php echo ($rowlttd['SoTC']) ?></td>
						<td align="center"><?php echo ($rowlttd['Thu']) ?></td>
						<td align="center"><?php echo ($rowlttd['Tiet']) ?></td>
						<td></td>
						<td></td>
						<td align="center"><?php echo ($rowlttd['MaGV']) ?></td>
						<td><?php echo ($rowlttd['HoTen']) ?></td>
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