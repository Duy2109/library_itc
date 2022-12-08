<?php
$action = "";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "add_comment":
        if (isset($_SESSION['user'])) {
            if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
                $noidungbl = $_POST['noidungbl'];
                $masach = $_POST['masach'];
                $ngaybl = date("Y-m-d");
                $rating = $_POST['rating'];
                if ($rating == null) {
                    $rating = "5";
                }


                $data = array(
                    "masv" => $_SESSION["user"],
                    "masach" => $masach,
                    "ngaybl" => $ngaybl,
                    "danhgia" => $rating,
                    "noidung" => $noidungbl
                );
                $table = "binhluan";
                $comment = new CommentModel();
                $result = $comment->insertComment($table, $data);

                if ($result) echo "<script> alert('bình luận thành công');</script>";
                else echo "<script> alert('bình luận thất bại');</script>";

                echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
                exit;
            }
        } else {
            echo "<script> alert('Vui lòng đăng nhập để bình luận');</script>";
            echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login'/>";
        }
        break;

    case "add_reply":
        if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {

            $noidung = $_POST['noidungbl'];
            $mabl_cha = $_POST['mabl_cha'];
            $ngaybl = date("Y-m-d");
            $masach = $_POST['masach'];

            $data = array(
                "mabl_cha" => $mabl_cha,
                "masv" => $_SESSION['user'],
                "noidung" => $noidung,
                "masach" => $masach,
                "ngaybl" => $ngaybl
            );

            $table = "traloi_bl";
            $comment = new CommentModel();
            $result = $comment->insertReplyComment($table, $data);

            if ($result) echo "<script> alert('bình luận thành công');</script>";
            else echo "<script> alert('bình luận thất bại');</script>";
            echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['HTTP_REFERER'] . '">';
        }
        break;
}
