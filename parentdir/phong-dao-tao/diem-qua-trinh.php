<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Phòng đào tạo</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../assets/main.css">
	<script type="text/javascript" src="../assets/js/main.js" defer></script>
</head>
<body>
	<?php include '../assets/php/header.php'; ?>
	<div class="d-flex">
		<?php include 'sidebar.php'; ?>
		<section class="cSec mx-auto mt-5 d-flex flex-column gap-4">
			<div class="bg-white p-3 d-flex align-items-center justify-content-between rounded shadow-sm">
				<div class="d-flex align-items-center gap-3 w-50">
					<select class="form-select form-select-sm w-25" aria-label="Small select example">
						<option selected>Lớp</option>
						<option value="1">DHTI15A7HN</option>
						<option value="2">DHTI15A8HN</option>
					</select>
					<select class="form-select form-select-sm w-25" aria-label="Small select example">
						<option selected>Môn</option>
						<option value="1">Lập trình</option>
						<option value="2">Quản trị</option>
					</select>
					<button class="btn btn-success fw-semibold">Lọc</button>
				</div>
				<div class="d-flex align-items-center justify-content-end gap-3 w-50">
					<button class="btn btn-success fw-semibold">Yêu cầu cập nhật</button>
					<button class="btn btn-primary fw-semibold">Gửi</button>
				</div>
			</div>
			<div class="table-responsive type2 shadow-sm">
				<table class="table">
					<thead class="sticky-top">
						<tr>
							<th rowspan="2">STT</th>
							<th rowspan="2">Mã sinh viên</th>
							<th rowspan="2">Tên sinh viên</th>
							<th rowspan="2">Chuyên cần</th>
							<th colspan="3">Thường xuyên</th>
							<th rowspan="2">TB quá trình</th>
							<th rowspan="2">Được dự thi</th>
						</tr>
						<tr>
							<th>LT Hệ số 1</th>
							<th>LT Hệ số 2</th>
							<th>TH Hệ số 1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>
								<!-- Cần thay đổi -->
								<div class="d-flex justify-content-center">
									<i class="bi bi-check-lg"></i>
								</div>
								<!--  -->
							</td>
						</tr>
						<tr>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>
								<!-- Cần thay đổi -->
								<div class="d-flex justify-content-center">
									<i class="bi bi-x-lg"></i>
								</div>
								<!--  -->
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</body>
</html>