<?php
class RegexModel
{
    public function __construct()
    {
    }

    public function checkEmail($email)
    {
    }

    public function checkPassword($password)
    {
        // chữ hoa chữ thường số kí tự đặc biệt ít gồm 6 số
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{6,20}$/";
        $result =  preg_match($regex, $password);
        return  $result;
    }

    public function checkStudentCode($code)
    {
        // $regex = "/^\d{9}$/";
        $regex = "/^(0|[1-9])\d{8}$/";
        $result = preg_match($regex, $code);
        return $result;
    }
}
