	<!-- Modal -->
	<?php
	$roleuser = Session::Get('role');
	if ($roleuser == 4) {
	?>
		<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content col-xl-5">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Thông tin giảng viên</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row mt-2">
						<div class="col-lg-12 col-xl-12">
							<div class="row formbody">
								<div class="col-lg-5 my-1">
									<label for="mgv" class="form-label">Mã giảng viên</label>
									<input type="text" class="ipvlt form-control" id="mgv" name="mgv" value="">
								</div>
								<div class="col-lg-7 my-1">
									<label for="ht" class="form-label">Họ và tên</label>
									<input type="text" class="ipvlt form-control" id="ht" name="ht" value="" required>
								</div>

								<div class="col-lg-4 my-1">
									<label for="ns" class="form-label">Ngày sinh</label>
									<input type="date" class="ipvlt form-control" id="ns" name="ns" value="" required>
								</div>
								<div class="col-lg-2 my-1">
									<label for="gtinh" class="form-label">Giới tính</label>
									<input type="text" class="ipvlt form-control" id="gtinh" name="gtinh" value="" required>
								</div>
								<div class="col-lg-6 my-1">
									<label for="hvi" class="form-label">Học vị</label>
									<input type="text" class="ipvlt form-control" id="hvi" name="hvi" value="" required>
								</div>
								<div class="col-lg-6 my-1">
									<label for="khoa" class="form-label">Khoa</label>
									<select id="khoa" class="ipvlt select-filter form-select form-select-sm " style="width: 30%;" aria-label="Small select example">
										<option selected>Khoa</option>
										<?php
										$khoa = $data["object"]->GetKhoa();
										if ($khoa) {
											while ($row = mysqli_fetch_array($khoa)) {
										?>
												<option value="<?php echo ($row['MaKhoa']) ?>"><?php echo ($row['TenKhoa']) ?></option>
										<?php

											}
										}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btnSubmitAdd btn btn-success">
							<i class="fa fa-save"></i>
							Thêm
						</button>
					</div>
				</div>
			</div>
		</div>
	<?php
	} elseif ($roleuser == 3) {
	?>
		<!-- Modal -->
		<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content col-xl-5">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Thông tin lớp danh nghĩa</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row mt-2">
						<div class="col-lg-12 col-xl-12">
							<div class="row formbody">
								<div class="col-lg-5 my-1">
									<label for="mgv" class="form-label">Mã lớp danh nghĩa</label>
									<input type="text" class="ipvlt form-control" id="mgv" name="mgv" value="">
								</div>
								<div class="col-lg-7 my-1">
									<label for="ht" class="form-label">Tên lớp danh nghĩa</label>
									<input type="text" class="ipvlt form-control" id="ht" name="ht" value="" required>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btnSubmitAdd btn btn-success">
							<i class="fa fa-save"></i>
							Thêm
						</button>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>