<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Khoa</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/do-an-1/mvc/assets/bootstrap.min.css">
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/bootstrap.bundle.min.js"></script>

    <!-- CSS/JS -->
    <link rel="stylesheet" type="text/css" href="/do-an-1/mvc/assets/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.0/xlsx.full.min.js" integrity="sha512-0aL+eiYGMyJYhr5BJL3jqKkgn2Jn+N80M+WbKJpHRelUVHNo7NWQbVUfZK6xpRgFl8/5imYahJpCPXd6yaIhag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/jquery-2.2.3.min.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/tableDropdown.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/handelform.js" defer></script>
    <script type="text/javascript" src="/do-an-1/mvc/assets/js/main.js" defer></script>

</head>

<body>
    <?php include './assets/php/header.php'; ?>
    <div class="d-flex">
        <?php include 'sidebar.php'; ?>
        <section class="cSec mx-auto mt-5 d-flex flex-column gap-4">
            <?php
            // include 'KhoaInfo.php';
            include  $data['body'] . '.php';
            ?>
        </section>
    </div>
    <?php
    // Modal
    include './assets/php/modal-changepass.php';
    // Toast
    include './assets/php/toastpass.php';
    include './assets/php/modalEdit.php';
    include './assets/php/modalThem.php';
    ?>


</body>

</html>


<?php

// if (isset($_SESSION['selectValue1'])) {
//     Session::unset('selectValue1');
// }
// if (isset($_SESSION['selectValue2'])) {
//     Session::unset('selectValue2');
// }
?>