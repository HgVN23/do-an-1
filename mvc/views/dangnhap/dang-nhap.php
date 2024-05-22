<?php
include '../mvc/core/UserLogin.php';
$UserLogin = new UserLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$Username = $_POST['user'];
	$Password = $_POST['password'];
	$LoginCheck = $UserLogin->InfoLogin($Username, $Password);
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Đăng nhập</title>

	<!-- Bootstrap 5 -->
	<link rel="stylesheet" href="/do-an-1/mvc/assets/bootstrap.min.css">
	<script type="text/javascript" src="/do-an-1/mvc/assets/js/bootstrap.bundle.min.js"></script>
	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="/do-an-1/mvc/assets/main.css">
	<script type="text/javascript" src="/do-an-1/mvc/assets/js/main.js" defer></script>
</head>

<body class="loginBg">
	<div class="loginPlace w-100 d-flex justify-content-center align-items-center gap-5">
		<img src="/do-an-1/mvc/assets/img/login.png" width="400" height="400">
		<form id="formLogin" class="w-25" action="dang-nhap.php" method="POST">
			<h1>Đăng Nhập</h1>
			<div class="rounded p-1" style="background-color: #e6e8eb8f">
				<input class="w-100 border-0 rounded px-2 py-3" type="text" name="user" placeholder="Người dùng">
				<span class="d-block w-100" style="padding:0.125rem 0; background-color: #e6e8eb8f;"></span>
				<input class="w-100 border-0 rounded px-2 py-3" type="text" name="password" placeholder="Mật khẩu">
			</div>
			<div class="my-4 d-flex justify-content-between align-items-center gap-1">
				<input class="form-check-input" type="checkbox" name="remember" id="remember">
				<label class="remember fw-bold text-nowrap" for="remember">Ghi nhớ tài khoản</label>
				<span class="forgot ms-auto fw-bold text-nowrap">Quên mật khẩu</span><br>
			</div>
			<button class="btn btn-primary w-100 fw-bold" type="submit">Đăng nhập</button>

			<div>
				<?php
				if (isset($LoginCheck)) {
					echo ($LoginCheck);
				}
				?>
			</div>
		</form>
	</div>
</body>

</html>