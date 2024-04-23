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
</head>
<body>
	<?php include '../assets/php/header.php'; ?>
	<div class="d-flex">
		<?php include '../assets/php/sidebar.php'; ?>
		<section class="cSec mx-auto mt-5 d-flex flex-column gap-4">
			<div class="bg-white rounded p-3 d-flex align-items-center gap-2 shadow-sm">
				<div class="dropdown">
					<button class="btnDropdown btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kì</button>
					<ul class="dropdown-menu">
						<li><div class="dropdown-item">II (2023 - 2024)</div></li>
						<li><div class="dropdown-item">I (2023 - 2024)</div></li>
					</ul>
				</div>
				<div class="dropdown">
					<button class="btnDropdown btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Khoa</button>
					<ul class="dropdown-menu">
						<li><div class="dropdown-item">Công nghệ</div></li>
						<li><div class="dropdown-item">Kinh tế</div></li>
					</ul>
				</div>
				<button class="btn btn-success">Lọc</button>
			</div>
			<div class="table-responsive shadow-sm">
				<table class="table">
					<thead class="sticky-top z-1">
						<tr>
							<th>STT</th>
							<th>Học phần</th>
							<th>Mã học phần</th>
							<th>Số tiết học</th>
							<th>Khoa phụ trách</th>
							<th>Chỉnh sửa</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>Test</td>
							<td>
								<div class="dropdown">
									<button class="btnDropdown btn dropdown-toggle z-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">Lựa chọn...</button>
									<ul class="dropdown-menu">
										<li><div class="dropdown-item">Công nghệ</div></li>
										<li><div class="dropdown-item">Kinh tế</div></li>
									</ul>
								</div>
							</td>
							<td><div class="d-flex justify-content-center gap-3">
								<i class="bi bi-pencil-square"></i>
								<i class="bi bi-trash3"></i>
							</div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="bg-white rounded p-3 d-flex justify-content-end align-items-center gap-2 shadow-sm">
				<button class="btn btn-success">Thêm mới</button>
				<button class="btn btn-primary">In</button>
			</div>
		</section>
	</div>
</body>
</html>