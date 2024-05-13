<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	Session::destroy();
	setcookie("userid", "", time() - 3600);
}
?>
<header class="bg-white px-5 py-2 d-flex flex-wrap justify-content-between align-items-center gap-2 position-sticky top-0">
	<a class="d-flex justify-content-center align-items-center gap-2 text-center link-dark link-underline-opacity-0" href="trang-chu">
		<div class="logo university rounded-circle">
			<img src="/do-an-1/mvc/assets/img/logouniversity.jpg" alt="">
		</div>
		<div class="m-0 h5 fw-medium">Trường Đại Học GOATS</div>
	</a>
	<div class="btn-group">
		<div type="button" class="dropdown-toggle d-flex gap-2 align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
			<div class="logo rounded-circle">
				<img src="/do-an-1/mvc/assets/img/img-user.png" alt="">
			</div>
			<?php
			$obj = $data["object"]->GetUserName();
			echo (mysqli_fetch_assoc($obj)["Username"]);
			?>

		</div>
		<ul class="dropdown-menu dropdown-menu-end">
			<li>
				<!-- <a href="?action=changepass" class="dropdown-item">Đổi mật khẩu</a> -->
				<button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalChangePass">Đổi mật khẩu</button>
			</li>
			<li>
				<a href="?action=logout" class="dropdown-item">Đăng xuất</a>
			</li>
		</ul>
	</div>
</header>