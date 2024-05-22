	<!-- Modal -->
	<div class="modal fade" id="modaledit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<form class="modal-content col-xl-5" action="" method="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Nhập điểm sinh viên</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row mt-2">
					<div class="col-lg-12 col-xl-12">
						<div class="row formbody">
							<div class="col-lg-5 my-1">
								<label for="magv" class="form-label">Mã sinh viên</label>
								<input type="text" class="ipvl form-control bg-primary-subtle" id="magv" name="magv" value="" readonly>
							</div>
							<div class="col-lg-7 my-1">
								<label for="hoten" class="form-label">Họ và tên</label>
								<input type="text" class="ipvl form-control" id="hoten" name="hoten" value="" required>
							</div>

							<div class="col-lg-3 my-1">
								<label for="chuyencan" class="form-label">Chuyên cần</label>
								<input type="number" min=0 max=10 class="ipvl form-control" id="chuyencan" name="chuyencan" value="" required>
							</div>
							<div class="col-lg-3 my-1">
								<label for="lths1" class="form-label">LT Hệ số 1</label>
								<input type="number" min=0 max=10 class="ipvl form-control" id="lths1" name="lths1" value="" required>
							</div>
							<div class="col-lg-3 my-1">
								<label for="lths2" class="form-label">LT Hệ số 2</label>
								<input type="number" min=0 max=10 class="ipvl form-control" id="lths2" name="lths2" value="" required>
							</div>
							<div class="col-lg-3 my-1">
								<label for="thhs1" class="form-label">TH Hệ số 1</label>
								<input type="number" min=0 max=10 class="ipvl form-control" id="thhs1" name="thhs1" value="" required>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn-update btn btn-success">
						<i class="fa fa-save"></i>
						Cập nhật
					</button>
				</div>
			</form>
		</div>
	</div>