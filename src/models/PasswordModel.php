<?php
include("./src/PHPMailer/src/PHPMailer.php");
include("./src/PHPMailer/src/Exception.php");
include("./src/PHPMailer/src/POP3.php");
include("./src/PHPMailer/src/SMTP.php");
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordModel
{
    var $user = null;
    var $email = null;
    public function __construct()
    {
    }
    public function getPassword($user, $email)
    {
        $db = new ConnectModel();
        $select = "select * from sinhvien where masv='$user' and email='$email'";
        $result = $db -> getList($select);
        echo gettype($result);
        $set = $result->fetch();
        return $set;
    }
 
    public function sendMailPassword($email, $username, $code) {
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'nguyenthanhbinh06051999@gmail.com';                 // SMTP username
            $mail->Password = 'uijqcghvcqhhlmpl';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('nguyenthanhbinh06051999@gmail.com', 'ADMIN');
            $mail->addAddress($email, $username);
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Trả lại mật khẩu';
            $mail->Body    = 'Gửi '.$username.'.<br/>Mã lấy lại mật khẩu: '.$code.'<br/>Sử dụng mã này để lấy lại mật khẩu. Vui lòng không chia sẻ với bất kỳ ai.';
        
            $mail->send();
            echo '<script>alert("Một mã đã được gửi đến email '.$email.'")</script>';
            echo "<meta http-equiv='refresh' content='0;url=./index.php?controller=password&action=changepasswordforgot' />";
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function changePassword($user, $pass, $passnew) {
        $db = new ConnectModel();
        $passnew = md5($passnew);
        $pass = md5($pass);
        $query= "UPDATE sinhvien SET matkhau = '$passnew' where masv='$user' and matkhau='$pass' ";
        $db->exec($query);
    }

    public function confirmResetPassword($user, $code) {
        $db = new ConnectModel();
        $select = "SELECT * FROM sinhvien where masv='$user' and matkhau='$code'";
        $result = $db -> getList($select);
        echo gettype($result);
        $set = $result->fetch();
        return $set;
    }

    public function resetAndChangePassword($user, $code, $passnew) {
        $db = new ConnectModel();
        $passnew = md5($passnew);
        $query= "UPDATE sinhvien SET matkhau = '$passnew' where masv='$user' and matkhau='$code' ";
        $db->exec($query);
    }
}
