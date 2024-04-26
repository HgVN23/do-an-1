<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang phòng đào tạo</title>

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
						<option selected>Khoa</option>
						<option value="1">Công nghệ</option>
						<option value="2">Kinh tế</option>
					</select>
					<select class="form-select form-select-sm w-25" aria-label="Small select example">
						<option selected>Kì</option>
						<option value="1">II (2023 - 2024)</option>
						<option value="2">I (2023 - 2024)</option>
					</select>
					<select class="form-select form-select-sm w-25" aria-label="Small select example">
						<option selected>Khóa</option>
						<option value="1">K15</option>
						<option value="2">K16</option>
					</select>
					<button class="btn btn-success fw-semibold">Lọc</button>
				</div>
				<div class="d-flex align-items-center justify-content-end gap-3 w-50">
					<button class="btn btn-danger fw-semibold">Gửi Khoa</button>
					<button class="btn btn-success fw-semibold">Mở đăng ký học phần</button>
				</div>
			</div>
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
							<td>Test</td>
							<td>Test</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</body>
</html>