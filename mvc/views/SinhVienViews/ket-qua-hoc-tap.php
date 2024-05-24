<div class="table-responsive type2 shadow-sm">
	<table class="table">
		<thead class="sticky-top">
			<tr>
				<th rowspan="2">STT</th>
				<th rowspan="2">Mã lớp học phần</th>
				<th rowspan="2">Tên học phần</th>
				<th rowspan="2">Số tín chỉ</th>
				<th rowspan="2">Chuyên cần</th>
				<th colspan="3">Thường xuyên</th>
				<th rowspan="2">TB quá trình</th>
				<th rowspan="2">Được dự thi</th>
				<th rowspan="2">Cuối kỳ</th>
				<th rowspan="2">Điểm tổng kết</th>
				<th rowspan="2">Thang điểm 4</th>
				<th rowspan="2">Điểm chữ</th>
				<th rowspan="2">Xếp loại</th>
				<th rowspan="2">Đạt</th>
			</tr>
			<tr>
				<th>LT Hệ số 1</th>
				<th>LT Hệ số 2</th>
				<th>TH Hệ số 1</th>
			</tr>
		</thead>

		<?php
		$hk = $data["object"]->GetHK();
		while ($row = mysqli_fetch_array($hk)) {
			$mahk = $row['MaHK'];
		?>
			<tbody class="tableDropdown">
				<tr class="dClick dActive">
					<td class="dHeader" colspan="16">
						<?php
						if ($row['TenHK'] == "I")
							echo ($row['TenHK'] . " (" . $row['namhoc'] . "-" . $row['namhoc'] + 1 . ")");
						else
							echo ($row['TenHK'] . " (" . $row['namhoc'] - 1 . "-" . $row['namhoc'] . ")");
						?></td>
				</tr>
				<?php
				$dihp = $data["object"]->getDiemHP($mahk);
				if ($dihp) {
					$i = 1;
					while ($rowdhp = mysqli_fetch_array($dihp)) {

				?>
						<tr class="dHide dShow">
							<td align="center"><?php echo ($i) ?></td>
							<td align="center"><?php echo ($rowdhp['MaHP']) ?></td>
							<td><?php echo ($rowdhp['TenHP']) ?></td>
							<td align="center"><?php echo ($rowdhp['SoTC']) ?></td>
							<td align="center"><?php echo ($rowdhp['DiemCCan']) ?></td>
							<td align="center"><?php echo ($rowdhp['DiemHS1']) ?></td>
							<td align="center"><?php echo ($rowdhp['DiemHS2']) ?></td>
							<td align="center"><?php echo ($rowdhp['DiemTH']) ?></td>
							<td align="center"><?php if ($rowdhp['DiemTKQT']) {
													echo ($rowdhp['DiemTKQT']);
												} ?></td>
							<td>
								<!-- Cần thay đổi -->
								<div class="d-flex justify-content-center">
									<?php
									if ($rowdhp['DiemCCan']) {
										if ($rowdhp['DiemCCan'] > 6) {
											echo ('<i class="text-success bi bi-check-circle-fill"></i>');
										} else {
											echo ('<i class="text-danger bi bi-x-circle-fill"></i>');
										}
									}

									?>
								</div>
								<!--  -->
							</td>
							<td align="center"><?php if ($rowdhp['DiemThi']) {
													echo ($rowdhp['DiemThi']);
												} ?></td>
							<td align="center"><?php if ($rowdhp['DiemTKH10']) {
													echo ($rowdhp['DiemTKH10']);
												} ?></td>
							<td align="center"><?php if ($rowdhp['DiemTKH4']) {
													echo ($rowdhp['DiemTKH4']);
												} ?></td>
							<td align="center"><?php if ($rowdhp['DiemChu']) {
													echo ($rowdhp['DiemChu']);
												} ?></td>
							<td align="center"><?php if ($rowdhp['XepLoai']) {
													echo ($rowdhp['XepLoai']);
												} ?></td>
							<td>
								<!-- Cần thay đổi -->
								<div class="d-flex justify-content-center">
									<div class="d-flex justify-content-center">
										<?php
										if ($rowdhp['DiemTKH4']) {
											if ($rowdhp['DiemTKH4'] > 1) {
												echo ('<i class="text-success bi bi-check-circle-fill"></i>');
											} else {
												echo ('<i class="text-danger bi bi-x-circle-fill"></i>');
											}
										}

										?>
									</div>
								</div>
								<!--  -->
							</td>
						</tr>
					<?php
						$i++;
					}

					?>

					<?php
					$kq = $data["object"]->GetKQ($mahk);
					$tongtc = 0;
					$tongdiemtbhk = 0;
					while ($rowkq = mysqli_fetch_array($kq)) {

					?>
						<tr class="txtScore dHide dShow">
							<td id="txt10" colspan="1"> <?php if ($rowkq['DiemTK10']) {
															echo ($rowkq['DiemTK10']);
														} ?></td>
							<td id="txt4" colspan="1"><?php if ($rowkq['DiemTK4']) {
															echo ($rowkq['DiemTK4']);
														} ?></td>
							<td colspan="14"></td>
						</tr>
						<tr class="txtScore dHide dShow">
							<td id="txtTB1" colspan="1"><?php if ($rowkq['DiemTBTLH10']) {
															echo ($rowkq['DiemTBTLH10']);
														} ?></td>
							<td id="txtTB2" colspan="1"><?php if ($rowkq['DiemTBTLH4']) {
															echo ($rowkq['DiemTBTLH4']);
														} ?></td>
							<td colspan="14"></td>
						</tr>
						<tr class="txtScore dHide dShow">
							<td id="txtTCDK" colspan="1"><?php if ($rowkq['TongSTCDK']) {
																echo ($rowkq['TongSTCDK']);
															} ?></td>
							<td id="txtTCTL" colspan="1"><?php if ($rowkq['TongSTCDK']) {
																echo ($rowkq['TongSTCDK']);
															} ?></td>
							<td colspan="14"></td>
						</tr>
						<!-- <tr class="txtScore dHide dShow">
						<td id="txtTCNo" colspan="2"></td>
						<td id="txtXLTL" colspan="2"></td>
						<td colspan="12"></td>
					</tr> -->
						<!-- <tr class="txtScore dHide dShow">
							<td id="txtXLHK" colspan="1"></td>
							<td id="txtXLHV" colspan="1"></td>
							<td colspan="14"></td>
						</tr> -->

					<?php
					}
					?>
			</tbody>
	<?php
				}
			}
	?>
	</table>
</div>