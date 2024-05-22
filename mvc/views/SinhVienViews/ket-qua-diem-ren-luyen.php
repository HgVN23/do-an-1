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

				<!-- <tr class="dHide dShow">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr> -->
				<?php
				$drl = $data["object"]->GetDRL($mahk);
				while ($rowdrl = mysqli_fetch_array($drl)) {
				?>
					<tr class="txtScore dHide dShow">
						<td id="txtDiemRL" class="text-center" colspan="3"></td>
						<td align="center"><?php echo ($rowdrl['DiemRL']) ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr class="txtScore dHide dShow">
						<td id="txtXepLoai" class="text-center" colspan="3"></td>
						<td align="center"><?php echo ($rowdrl['xeploai']) ?></td>
						<td></td>
						<td></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		<?php
		}
		?>
	</table>
</div>