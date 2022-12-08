<?php
$action = "password";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "password":
        include "./src/views/login/password.php";
        break;
    case "password_action":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["txtusername"];
            $email = $_POST["txtemail"];
            $dt = new PasswordModel();
            $result = $dt->getPassword($user, $email);
            if ($result != false) {
                $dt->sendMailPassword($email, $result[1], $result[5]);
            } else {
                echo "<script> alert('Mã số sinh viên và email không khớp');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php' />";
            }
        }
        break;
    case "changepassword":
        include "./src/views/login/changepassword.php";
        break;
    case "changepassword_action":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["txtuser"];
            $pass = $_POST["txtpass"];
            $passnew = $_POST["txtpassnew"];
            $dt = new UserModel();
            $result = $dt->loginUser($user, $pass);
            $dt1 = new PasswordModel();
            if ($result != false) {
                $dt1->changePassword($user, $pass, $passnew);
                echo "<script> alert('Đổi mật khẩu thành công!');</script>";
                unset($_SESSION['user']);
                unset($_SESSION['tenuser']);
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login' />";
            } else {
                echo "<script> alert('Đổi mật khẩu thất bại');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=password&action=changepassword' />";
            }
        }
        break;
    case "changepasswordforgot":
        include "./src/views/login/changepasswordforgot.php";
        break;
    case "changepasswordforgot_action":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["txtuser"];
            $code = $_POST["txtcode"];
            $passnew = $_POST["txtpassnew"];
            $dt = new PasswordModel();
            $result = $dt->confirmResetPassword($user, $code);
            if ($result != false) {
                $dt->resetAndChangePassword($user, $code, $passnew);
                echo "<script> alert('Lấy lại mật khẩu thành công!');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=login' />";
            } else {
                echo "<script> alert('Lấy lại mật khẩu thất bại');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=password&action=changepasswordforgot' />";
            }
        }
        break;
}
