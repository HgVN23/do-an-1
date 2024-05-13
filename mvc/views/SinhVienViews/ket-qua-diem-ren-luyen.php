<div class="table-responsive type2 shadow-sm">
	<table class="table">
		<thead class="sticky-top">
			<tr>
				<th>STT</th>
				<th>Ngày vi phạm</th>
				<th>Nội dung</th>
				<th>Hình thức</th>
				<th>Ghi chú</th>
				<th>Điểm<br>Cộng/Trừ</th>
			</tr>
		</thead>
		<?php
		$hk = $data["object"]->GetHK();
		while ($row = mysqli_fetch_array($hk)) {
		?>
			<tbody class="tableDropdown">
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
				<tr class="txtScore dHide dShow">
					<td id="txtDiemRL" class="text-center" colspan="3"></td>
					<td>Test</td>
					<td colspan="2"></td>
				</tr>
				<tr class="txtScore dHide dShow">
					<td id="txtXepLoai" class="text-center" colspan="3"></td>
					<td>Test</td>
					<td colspan="2"></td>
				</tr>
			</tbody>
		<?php
		}
		?>
	</table>
</div>