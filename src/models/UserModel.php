<?php

class UserModel
{
    public function __construct()
    {
    }

    public function getUserById($masv)
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM sinhvien WHERE masv = '$masv'";
        return $db->getInstance($sql);
    }

    public function loginUser($user, $pass)
    {

        $pass = md5($pass);
        $db = new ConnectModel();
        $sql = "SELECT * FROM sinhvien WHERE masv='$user' AND matkhau= '$pass'";
        return  $db->getInstance($sql);
    }
}
