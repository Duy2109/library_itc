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
            $user = $_POST["txtusername"];
            $pass = md5($_POST["txtpassword"]);
            $dt = new LoginModel();
            $result = $dt->loginAdmin($user, $pass);

            if ($result != false) {
                $_SESSION['admin'] = $result[0];
                $_SESSION['tenadm'] = $result[2];
                echo "<script> alert('Đăng nhập thành công');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php' />";
            } else {
                echo "<script> alert('Tên đăng nhập hoặc mật khẩu không đúng');</script>";
                echo "<meta http-equiv='refresh' content='0;url=./index.php' />";
            }
        }
        break;
    case 'logout':
        unset($_SESSION['admin']);
        unset($_SESSION['tenadm']);
        echo "<meta http-equiv='refresh' content='0;url=./index.php' />";
        break;
}
