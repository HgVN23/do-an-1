<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Giảng viên</title>

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
		<section class="cSec mx-auto mt-3 d-flex flex-column gap-4">
			<div class="txtInfo bg-white p-3 d-flex justify-content-between rounded shadow-sm">
				<div class="d-flex flex-column gap-1 w-50">
					<p id="txtHoTen" class="m-0">Test</p>
					<p id="txtGioiTinh" class="m-0">Test</p>
					<p id="txtNgaySinh" class="m-0">Test</p>
				</div>
				<div class="d-flex flex-column gap-1 w-50">
					<p id="txtMaGV" class="m-0">Test</p>
					<p id="txtKhoa" class="m-0">Test</p>
				</div>
			</div>
			<div class="table-responsive type1 shadow-sm">
				<table class="table">
					<thead class="sticky-top">
						<tr>
							<th>Ca học</th>
							<th>Thứ 2</th>
							<th>Thứ 3</th>
							<th>Thứ 4</th>
							<th>Thứ 5</th>
							<th>Thứ 6</th>
							<th>Thứ 7</th>
							<th>Chủ nhật</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Sáng</th>
							<td>
								<div class="slotLich lichLT rounded p-1">
									<div class="fw-bold">Test</div>
									<div>Test</div>
									<div id="txtTiet"></div>
									<div id="txtPhong"></div>
									<div id="txtGiangVien"></div>
								</div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<th>Chiều</th>
							<td></td>
							<td></td>
							<td>
								<div class="slotLich lichTH rounded p-1">
									<div class="fw-bold">Test</div>
									<div>Test</div>
									<div id="txtTiet"></div>
									<div id="txtPhong"></div>
									<div id="txtGiangVien"></div>
								</div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<th>Tối</th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<div class="slotLich lichThi rounded p-1">
									<div class="fw-bold">Test</div>
									<div>Test</div>
									<div id="txtTiet"></div>
									<div id="txtPhong"></div>
									<div id="txtGiangVien"></div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="bg-white p-3 d-flex align-items-center gap-3 rounded shadow-sm">
				<span>Chú thích:</span>
				<span class="lichLT rounded px-2 py-1">Lịch học lý thuyết</span>
				<span class="lichTH rounded px-2 py-1">Lịch học thực hành</span>
				<span class="lichThi rounded px-2 py-1">Lịch thi</span>
				</div>
			</div>
		</section>
	</div>
</body>
</html>