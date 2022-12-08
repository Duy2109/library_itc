<?php
class LoginModel
{
    var $user = null;
    var $pass = null;
    public function __construct()
    {
    }
    public function loginAdmin($user, $pass)
    {
        $db = new ConnectModel();
        $select = "select * from admin where tendangnhap='$user' and password='$pass'";
        $result = $db -> getList($select);
        echo gettype($result);
        $set = $result->fetch();
        return $set;
    }
}
