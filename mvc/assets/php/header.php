<header class="bg-white px-5 py-2 d-flex flex-wrap justify-content-between align-items-center gap-2 position-sticky top-0">
	<a class="d-flex justify-content-center align-items-center gap-2 text-center link-dark link-underline-opacity-0" href="trang-chu">
		<div class="logo rounded-circle"></div>
		<div class="m-0 h5 fw-medium">Trường Đại Học GOATS</div>
	</a>
	<div class="btn-group">
		<div type="button" class="dropdown-toggle d-flex gap-2 align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
			<div class="logo rounded-circle"></div>
			<?php
			echo mysqli_fetch_assoc($data["sinhvien"])["Username"];
			?>

		</div>
		<ul class="dropdown-menu dropdown-menu-end">
			<li>
				<div class="dropdown-item">Đổi mật khẩu</div>
			</li>
			<li>
				<div class="dropdown-item">Đăng xuất</div>
			</li>
		</ul>
	</div>
</header>