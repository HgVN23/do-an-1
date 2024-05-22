	<!-- Modal -->
	<div class="modal fade" id="modaledit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<form class="modal-content col-xl-5" action="" method="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Thông tin giảng viên</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row mt-2">
					<div class="col-lg-12 col-xl-12">
						<div class="row formbody">
							<div class="col-lg-5 my-1">
								<label for="magv" class="form-label">Mã giảng viên</label>
								<input type="text" class="ipvl form-control bg-primary-subtle" id="magv" name="magv" value="" readonly>
							</div>
							<div class="col-lg-7 my-1">
								<label for="hoten" class="form-label">Họ và tên</label>
								<input type="text" class="ipvl form-control" id="hoten" name="hoten" value="" required>
							</div>

							<div class="col-lg-4 my-1">
								<label for="ngaysinh" class="form-label">Ngày sinh</label>
								<input type="date" class="ipvl form-control" id="ngaysinh" name="ngaysinh" value="" required>
							</div>
							<div class="col-lg-2 my-1">
								<label for="gt" class="form-label">Giới tính</label>
								<input type="text" class="ipvl form-control" id="gt" name="gt" value="" required>
							</div>
							<div class="col-lg-6 my-1">
								<label for="hocvi" class="form-label">Học vị</label>
								<input type="text" class="ipvl form-control" id="hocvi" name="hocvi" value="" required>
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