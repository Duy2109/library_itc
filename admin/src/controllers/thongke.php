<?php

$action = "default";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

switch ($action) {
    case 'default':
        $books = new BookModel();
        $result = $books->getBookByMonth();
        $data = $result->fetchAll();
        include "./src/views/thongke/index.php";
        break;
    case 'luachon':
        include "./src/views/thongke/form.php";
        break;
    case 'quy':
        if ($_SERVER['REQUEST_METHOD']) {
            $nam = $_POST['nam'];
            $quy = $_POST['quy'];
            $loai = $_POST['loai'];

            if ($quy == 1) {
                $monthStart = 1;
                $monthEnd = 3;
            } elseif ($quy == 2) {
                $monthStart = 3;
                $monthEnd = 9;
            } elseif ($quy == 3) {
                $monthStart = 1;
                $monthEnd = 3;
            } else {
                $monthStart = 9;
                $monthEnd = 12;
            }

            $thongke = new ThongkeModel();
            $result = $thongke->thongKeBookBorrowByQuy($monthStart, $monthEnd, $nam, $loai);
            include "./src/views/thongke/view.php";
        }
        break;
    case 'thang':
        if ($_SERVER['REQUEST_METHOD']) {
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            $loai = $_POST['loai'];

            $thongke = new ThongkeModel();
            $result = $thongke->thongKeBookBorrowByMonth($thang, $nam, $loai);
            include "./src/views/thongke/view.php";
        }
        break;
}
