<?php
$action = "default";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "default":
        include "./src/views/books/book.php";
        break;
    case "importbooks":
        include "./src/views/books/importbooks.php";
        break;
    case "search":
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $book = new BookModel();
            $text_search = $_POST['text_search'];
            $result = $book->getBookByName($text_search);
            include "./src/views/books/book.php";
        }
        break;

    case "theloai":
        if (isset($_GET['name_category'])) {
            $book = new BookModel();
            $theloai = $_GET['name_category'];
            $result =  $book->getBookByCategory($theloai);
            include "./src/views/books/book.php";
        }
        break;

    case "tacgia":
        if (isset($_GET['name_author'])) {
            $book = new BookModel();
            $tacgia = $_GET['name_author'];
            $result =  $book->getBookByAuthor($tacgia);
            include "./src/views/books/book.php";
        }
        break;
    case "importbooks_action":
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $file = $_FILES['file']['tmp_name'];
            file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));

            $file_open = fopen($file, 'r');
            $db = null;
            while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {
                $masach = $csv[0];
                $nhande = $csv[1];
                $tacgia = $csv[2];
                $theloai =  mb_strtolower($csv[3], 'UTF-8');
                $bosuutap = $csv[4];
                $chuyennganh = $csv[5];
                $anhbia = $csv[6];
                $thongtinxb = $csv[7];
                $vitri = $csv[8];
                $soluong = $csv[9];
                $gia = $csv[10];

                $book = new BookModel();
                $result = $book->insertBookByCSV($masach, $nhande, $tacgia, $theloai, $bosuutap, $chuyennganh, $anhbia, $thongtinxb, $vitri, $soluong, $gia);
            }
            echo "<script>alert('Th??m v??o database th??nh c??ng!')</script>";
            echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=book' />";
        }
        break;
    case "importbook":
        include "./src/views/books/editbook.php";
        break;
    case "importbook_action":
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $masach = $_POST['masach'];
            $nhande = $_POST['nhande'];
            $tacgia = $_POST['tacgia'];
            $theloai = $_POST['theloai'];
            $bosuutap = $_POST['bosuutap'];
            $chuyennganh = $_POST['chuyennganh'];
            $thongtinxb = $_POST['thongtinxb'];
            $vitri = $_POST['vitri'];
            $soluong = $_POST['soluong'];
            $gia = $_POST['gia'];


            // check s??ch t???n t???i (ch??a)
            $book = new BookModel();

            $targetDir = "../public/image/books/";
            $filename = $_FILES["anhbia"]["name"];
            $tmp__filetype = explode('.', $filename);
            $filetype = end($tmp__filetype);
            $randName = md5(time() . $filename) . '.' . $filetype;
            $targetFilePath = $targetDir . $randName;

            //  Ki????m tra xem a??nh g????i qua co?? thu????c 1 trong ca??c ??i??nh da??ng nh?? d??????i kh??ng
            $allowTypes = array(
                'jpg',
                'png',
                'jpeg',
                'gif',
                'pdf'
            );

            if (in_array($filetype, $allowTypes)) {
                //Chuy????n file t????i public/uploads tr??n server ?????? l??u a??nh
                move_uploaded_file($_FILES["anhbia"]["tmp_name"], $targetFilePath);
                $table = "sach";
                $data = array(
                    "nhande" => $nhande,
                    "tacgia" => $tacgia,
                    "theloai" => $theloai,
                    "bosuutap" => $bosuutap,
                    "chuyennganh" => $chuyennganh,
                    "anhbia" => "books/$randName",
                    "thongtinxb" => $thongtinxb,
                    "vitri" => $vitri,
                    "soluong" => $soluong,
                    "gia" => $gia,
                );
                $result = $book->insertBook($table, $data);
                if ($result) {
                    echo '<script> alert("Th??m th??nh c??ng!!!"); </script>';
                    echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=book&action=default' />";
                } else {
                    echo '<script> alert("Th??m th???t b???i!!!"); </script>';
                    echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
                }
            } else {
                //Tra?? v???? l????i n????u kh??ng ??u??ng ??i??nh da??ng
                echo '<script> alert("file ???nh kh??ng ????ng ?????nh d???ng"); </script>';
                echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
            }
            break;
        }
        break;


    case "findstudent":
        $_SESSION['books'] = array();
        include_once("./src/views/books/findstudent.php");
        break;

    case "borrow":
        if (isset($_SERVER['REQUEST_METHOD']) == "post") {
            $student_code = $_POST['mssv'];
            $student = new StudentModel();
            $result =  $student->getStudentById($student_code);
            if ($result) {
                $_SESSION['masv'] = $result['masv'];
                $_SESSION['tensv'] = $result['tensv'];
            } else {
                unset($_SESSION['masv']);
                unset($_SESSION['tensv']);
            }
            include_once("./src/views/books/borrowbook.php");
        }
        break;


    case "findbook":
        // do h??? th???ng th??m v??o v?? load l???i trang th?? l???n nh???n t??m ti???p theo h??m count m???i b???t ?????u ?????m
        $limitBorrowBook = 2;
        $book = new BookModel();

        // ki???m tra s??ch m?????n v?? s??ch tr??? ????? ti???n h??nh cho m?????n ti???p ho???c kh??ng 
        $totalBorrow = $book->totalBorrowingByStudent($_SESSION['masv']);


        if ($totalBorrow < $limitBorrowBook  && ($totalBorrow + count($_SESSION['books'])) < $limitBorrowBook) {
            if (isset($_SERVER['REQUEST_METHOD']) == "post") {
                $masach = $_POST['masach'];
                $result = $book->getBookById($masach);
                if ($result) {
                    // ki???m tra xem m?? s??ch ???? t???n t???i trong danh s??ch m?????n ch??a
                    $exist_masach = $book->getIdBookFromListBorrow($result['masach'], $_SESSION['masv']);
                    if ($exist_masach) {
                        echo '<script> alert("S??ch ???? m?????n r???i!!!"); </script>';
                    } else {
                        $item = array(
                            "masach" => $result["masach"],
                            "nhande" => $result["nhande"],
                            "tacgia" => $result["tacgia"],
                            "anhbia" => $result["anhbia"],
                        );
                        $_SESSION['books'][$result["masach"]] = $item;
                    }
                } else {
                    echo '<script> alert("M?? s??ch kh??ng t???n t???i, ho???c s??? l?????ng s??ch cho m?????n ???? h???t"); </script>';
                }
            }
        } else {
            echo '<script> alert("M???i sinh vi??n ch??? ???????c m?????n t???i ??a 2 quy???n s??ch"); </script>';
        }
        include_once("./src/views/books/borrowbook.php");
        break;

    case "remove_borrowbooks":
        if (isset($_GET['masach'])) {
            unset($_SESSION['books'][$_GET['masach']]);
        }
        include_once("./src/views/books/borrowbook.php");

        break;
    case "borrow_action":
        if (isset($_SESSION['masv'])) {
            // t??nh to??n ng??y m?????n v?? ng??y tr???
            $daysBorrowLimit = 14;
            $monthReturnBooks = date("m");
            $yearReturnBooks = date("Y");
            $dayReturnBooks = date("d") + $daysBorrowLimit;

            $dateBorrow = date("Y-m-d");
            $dateReturnBooks = date("Y-m-d", mktime(0, 0, 0,  $monthReturnBooks, $dayReturnBooks, $yearReturnBooks));

            $book = new BookModel();

            // th??m v??o b???ng danh s??ch m?????n
            $tableBorrow = 'danhsachmuon';
            $dataBorrow = array(
                "masv" => $_SESSION['masv'],
                "tensv" => $_SESSION['tensv'],
                "ngaymuon" => $dateBorrow,
                "ngaytra" => $dateReturnBooks,
                "maadm" => $_SESSION['admin']
            );
            $result = $book->insertBorrow($tableBorrow, $dataBorrow);

            // khi th??m v??o b???ng danh s??ch m?????n th??nh c??ng th?? khi n??y ta m???i th??m v??o danh s??ch chi ti???t m?????n
            if ($result) {
                $codeBorrow = $book->getBorrowByCodeStudent($_SESSION['masv']);
                if ($codeBorrow) {
                    $tableDetail = "chitietmuon";
                    foreach ($_SESSION['books'] as $key => $value) {
                        $dataDetail = array(
                            "mamuon" => $codeBorrow['mamuon'],
                            "masach" => $value['masach'],
                            "soluong" => 1,
                            "nhande" => $value['nhande'],
                        );
                        // $book->insertBorrowDetailt($tableDetail, $dataDetail);
                        $insertSuccess = $book->insertBorrowDetailt($tableDetail, $dataDetail);
                        $book->updateStockInBook($value['masach'], 1);
                        $book->updateBorrowNumber($value['masach'], 1);
                    }
                }
            }
            echo $insertSuccess ? '<script> alert("M?????n s??ch th??nh c??ng"); </script>' : '<script> alert("M?????n s??ch th???t b???i"); </script>';

            unset($_SESSION['books']);
            unset($_SESSION['masv']);
            unset($_SESSION['tensv']);
            include_once("./src/views/dashboard/index.php");
        }
        break;

    case "editbookform":
        include "./src/views/books/editbook.php";
        break;


    case "updatebook_action":
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $masach = $_POST['masach'];
            $nhande = $_POST['nhande'];
            $tacgia = $_POST['tacgia'];
            $theloai = $_POST['theloai'];
            $bosuutap = $_POST['bosuutap'];
            $chuyennganh = $_POST['chuyennganh'];
            $anhbia = $_POST['anhbia'];
            $thongtinxb = $_POST['thongtinxb'];
            $vitri = $_POST['vitri'];
            $soluong = $_POST['soluong'];
            $gia = $_POST['gia'];
            $ub = new BookModel();
            $ub->updateBook($masach, $nhande, $tacgia, $theloai, $bosuutap, $chuyennganh, $anhbia, $thongtinxb, $vitri, $soluong, $gia);
            if (isset($ub)) {
                echo '<script> alert("Updated success!!!"); </script>';
            } else {
                echo '<script> alert("Updated fail!!!"); </script>';
            }
            include './src/views/books/book.php';
        }
        break;


    case "deletebook":
        if (isset($_GET["id"])) {
            $masach = $_GET["id"];
            $book = new BookModel();
            $issetBook = $book->getBookID($masach);

            // x??a s??ch ?????ng th???i x??a lu??n file ???nh trong th?? m???c
            $file_img = "../public/image/$issetBook[anhbia]";
            $book->deleteBook($masach);
            unlink($file_img);

            echo "<script> alert('Deleted id = " . $masach . " success'); </script>";
            // echo '<script> alert("Delete success!!!"); </script>';
            echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
        }
        break;
}
