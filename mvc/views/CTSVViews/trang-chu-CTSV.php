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
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/main.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/tableDropdown.js" defer></script>
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

</body>

</html>