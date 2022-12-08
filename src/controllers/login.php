<?php
$action = "login";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "login":
        include "./src/views/login/login.php";
        break;
    case "login_action":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $err_studentcode = $err_pass = null;

            $code = $_POST["txtcode"];
            $pass = $_POST["txtpassword"];

            // $regex = new RegexModel();
            // // check code user
            // if (!$regex->checkStudentCode($code)) {
            //     $err_studentcode = "mã sinh viên là số, có 9 chữ số";
            // }

            // // check password;
            // if (!$regex->checkPassword($pass)) {
            //     $err_pass = "ít nhất có 1 chữ hoa, chữ thường, kí tự đặc biệt. Tối đa 6 và tối thiểu 20 kí tự";
            // }

            if ($err_studentcode == null && $err_pass == null) {
                $user = new UserModel();

                $result = $user->loginUser($code, $pass);
                if ($result) {
                    $_SESSION['user'] = $result["masv"];
                    $_SESSION['tenuser'] = $result["tensv"];
                    $_SESSION['gender'] = $result['gioitinh'];
                    echo "<script> alert('Đăng nhập thành công');</script>";
                    echo "<meta http-equiv='refresh' content='0;url=./index.php' />";
                } else {
                    echo "<script> alert('Tên đăng nhập hoặc mật khẩu không đúng');</script>";
                    echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login' />";
                }
            } else {
                $mess = array(
                    "mess_pass" => $err_pass,
                    "mess_code" => $err_studentcode
                );
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login&" . http_build_query($mess) . "' />";
            }
        }
        break;
    case 'logout':
        unset($_SESSION['user']);
        unset($_SESSION['tenuser']);
        unset($_SESSION['gender']);
        echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login' />";
        break;
}
