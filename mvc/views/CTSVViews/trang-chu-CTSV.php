<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Cập nhật điểm rèn luyện</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/do-an-1/mvc/assets/bootstrap.min.css">
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/bootstrap.bundle.min.js"></script>

    <!-- CSS/JS -->
    <link rel="stylesheet" type="text/css" href="/do-an-1/mvc/assets/main.css">
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/jquery-2.2.3.min.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/tableDropdown.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/handelform.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/main.js" defer></script>
</head>

<body>
    <?php include './assets/php/header.php';
    include  $data['body'] . '.php';
    ?>
    <?php
    // Modal
    include './assets/php/modal-changepass.php';
    // Toast
    include './assets/php/toastpass.php';
    ?>

    <!-- modal change drl  -->
    <div class="modal" id="modaledit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content row" action="" method="">
                <div class="modal-header">
                    <h5 class="modal-title fs-5s">Cập nhật điểm rèn luyện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-xl-12">
                        <div class="row formbody">
                            <div class="col-lg-12 my-1">
                                <label for="msv" class="form-label">Mã sinh viên: </label>
                                <input type="text" readonly class="ipvl form-control" id="msv" name="msv" value="">
                            </div>
                            <div class="col-lg-12 my-1">
                                <label for="hoten" class="form-label">Họ và tên: </label>
                                <input type="text" readonly class="ipvl form-control" id="hoten" name="hoten" value="">
                            </div>
                            <div class="col-lg-12 my-1">
                                <label for="diemrl" class="form-label">Nhập điểm: </label>
                                <input type="number" class="ipvl form-control" id="diemrl" name="diemrl" require value="" min="0">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-update btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



</body>

</html>