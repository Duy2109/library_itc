<?php

use LDAP\Result;

$action = "default";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

switch ($action) {
    case 'default':
        include "./src/views/category/index.php";
        break;

    case 'addcategory':
        include "./src/views/category/editcategory.php";
        break;

    case 'add_action':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tentheloai = mb_strtolower($_POST['tentheloai'], "UTF-8");
            $category = new CategoryModel();
            $data = array(
                "tentheloai" => $tentheloai,
            );

            $result = $category->insertCategory($data);
            if ($result) {
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=category&action=default' />";
            } else  echo '<script> alert("Thêm thất bại!!!"); </script>';;
        }
        break;

    case 'editcategory':
        include "./src/views/category/editcategory.php";
        break;

    case 'edit_action':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $tentheloaiNew = mb_strtolower($_POST['tentheloai'], "UTF-8");
            $idmenu = $_POST['idmenu'];

            $category = new CategoryModel();
            $result = $category->getCategoryById($idmenu);
            $tentheloaiOld = mb_strtolower($result['tentheloai'], "UTF-8");

            if ($tentheloaiNew  != $tentheloaiOld) {
                $category = new CategoryModel();

                $result = $category->updateCategory($tentheloaiNew, $idmenu);

                // update lại thể loại trong bảng sách

                $book = new BookModel();
                $book->updateBookByCategory($tentheloaiNew, $tentheloaiOld);

                if ($result) {
                    echo '<script> alert("Cập nhật thành công!!!"); </script>';
                    echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=category&action=default' />";
                } else  echo '<script> alert("Cập nhật thất bại!!!"); </script>';
            } else {
                echo '<script> alert("Ban chưa đổi tên mới!!!"); </script>';
                echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
            }
        }
        break;

    case 'deletecategory':
        $id = $_GET["id"];
        $category = new CategoryModel();
        $result = $category->getCategoryById($id);
        $tentheloai = $result['tentheloai'];

        // delete books by category
        $category->deleteCategory($id);
        $book = new BookModel();
        $book->deleteBookByCategory($tentheloai);
        echo "<script> alert('Deleted id = " . $id . " success'); </script>";
        // echo '<script> alert("Delete success!!!"); </script>';
        echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=category&action=default' />";
        break;
}
