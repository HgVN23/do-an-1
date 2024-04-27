<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Sinh viên</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../assets/main.css">
	<script type="text/javascript" src="../assets/js/main.js" defer></script>
	<script type="text/javascript" src="../assets/js/tableDropdown.js" defer></script>
</head>
<body>
	<?php include '../assets/php/header.php'; ?>
	<div class="d-flex">
		<?php include 'sidebar.php'; ?>
		<section class="cSec mx-auto mt-3 d-flex flex-column gap-4">
			<div class="txtInfo bg-white p-3 d-flex justify-content-between rounded shadow-sm">
				<div class="d-flex flex-column gap-1 w-50">
					<p id="txtHoTen" class="m-0">Test</p>
					<p id="txtGioiTinh" class="m-0">Test</p>
					<p id="txtNgaySinh" class="m-0">Test</p>
				</div>
				<div class="d-flex flex-column gap-1 w-50">
					<p id="txtMaSV" class="m-0">Test</p>
					<p id="txtKhoa" class="m-0">Test</p>
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
						</tr>
						<tr>
							<th>Thứ</th>
							<th>Tiết</th>
						</tr>
					</thead>
					<tbody class="tableDropdown">
						<tr class="dClick dActive"><td class="dHeader" colspan="16">Test</td></tr>
						<tr class="dHide dShow">
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