<?php
$action = "default";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case "default":
        $history = new HistoryModel();
        $result = $history->getAllStudentBorrowing();
        include "./src/views/history/borrowingbystudent.php";

        break;
    case "borrowingbookbycode":
        if (isset($_SERVER['REQUEST_METHOD']) == "get") {
            if (isset($_GET['masv'])) {
                $student_code = $_GET['masv'];
                $history = new HistoryModel();
                $result = $history->getDetailBorrowByCodeStudent($student_code);
                include "./src/views/history/detailborrowingbystudent.php";
            }
        }
        break;
    case 'returnaction':
        if (isset($_GET['mamuon']) && isset($_GET['masach'])) {

            $mamuon = $_GET['mamuon'];
            $masach = $_GET['masach'];
            $masv = $_GET['masv'];

            $history = new HistoryModel();
            $history->updateStockInBook($masach);

            $book = new BookModel();
            $issetBook = $book->getBookID($masach);

            if ($issetBook) {
                $nhande = $issetBook['nhande'];
                $ngaytra = date("Y-m-d");
                $maadm = $_SESSION['admin'];

                $table = "danhsachtra";
                $data = array(
                    "mamuon" => $mamuon,
                    "masv" => $masv,
                    "masach" => $masach,
                    "nhande" => $nhande,
                    "maadm" => $maadm,
                    "ngaytra" => $ngaytra
                );

                $result = $history->InsertReturnBook($table, $data);
                if ($result) {
                    echo "<script> alert('Đã trả sách!'); </script>";
                    echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=history' />";
                } else {
                    echo "<script> alert('thất bại'); </script>";
                }
            }
        }
        break;
    case 'losebook':
        if (isset($_GET['masv']) && isset($_GET['masach'])) {
            $masach = $_GET['masach'];
            $masv = $_GET['masv'];

            $book = new BookModel();
            $issetBook = $book->getBookID($masach);


            if ($issetBook) {
                $history = new HistoryModel();

                $nhande = $issetBook['nhande'];
                $ngaybaomat = date('Y-m-d');
                $tienphat = $issetBook['gia'] * 2;
                $maadm = $_SESSION['admin'];

                $data = array(
                    "masv" => $masv,
                    "masach" => $masach,
                    "nhande" => $nhande,
                    "ngaybaomat" => $ngaybaomat,
                    "tienphat" => $tienphat,
                    "maadm" => $maadm
                );

                $result = $history->insertLoseABook($table, $data);

                if ($result) {
                    echo "<script> alert('Đã báo mất sách!'); </script>";
                    echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=history' />";
                }
            }
        }
        break;
    case "lated":
        include "./src/views/history/lated.php";
        break;
    case "getallborrowing":
        $book = new HistoryModel();
        $column = "danhsachmuon";
        $result = $book->getDetailInDashboard($column);
        include "./src/views/history/index.php";
        break;
    case "getall_losted":
        $book = new HistoryModel();
        $column = "danhsachmat";
        $result = $book->getDetailInDashboard($column);
        include "./src/views/history/index.php";
        break;
    case "getallreturn":
        $book = new HistoryModel();
        $column = "danhsachtra";
        $result = $book->getDetailInDashboard($column);
        include "./src/views/history/index.php";
        break;
    case 'findstudent':
        if (isset($_POST['textSearch'])) {
            $masv = $_POST['textSearch'];

            $history = new HistoryModel();
            $result = $history->getStudentBorrowing($masv);
            if ($result) {
                include "./src/views/history/borrowingbystudent.php";
            } else {
                echo "<script> alert('Mã sinh viên không tồn tại'); </script>";
            }
        }
        break;
}
