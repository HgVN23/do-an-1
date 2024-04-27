<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Đăng nhập</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../assets/main.css">
	<script type="text/javascript" src="../assets/js/main.js" defer></script>
</head>
<body class="loginBg">
	<div class="loginPlace w-100 d-flex justify-content-center align-items-center gap-5">
		<img src="../assets/img/login.png" width="400" height="400">
		<form class="w-25" method="POST">
			<h1>Đăng Nhập</h1>
			<input class="w-100 border-0 rounded-top px-2 py-3" type="text" name="user" placeholder="Người dùng"><br>
			<input class="w-100 border-0 rounded-bottom px-2 py-3" type="text" name="password" placeholder="Mật khẩu"><br>
			<div class="my-4 d-flex justify-content-between align-items-center gap-1">
				<input class="form-check-input" type="checkbox" name="remember" id="remember">
				<label class="remember fw-bold text-nowrap" for="remember">Ghi nhớ tài khoản</label>
				<span class="forgot ms-auto fw-bold text-nowrap">Quên mật khẩu</span><br>
			</div>
			<button class="btn btn-primary w-100 fw-bold" type="submit">Đăng nhập</button>
		</form>
	</div>
</body>
</html>