<?php
class StudentModel
{
    public function __construct()
    {
    }

    public function getStudentById($studentCode)
    {
        $db = new ConnectModel();
        $sql = "SELECT masv, tensv 
                FROM sinhvien
                WHERE masv = '$studentCode'";
        return $db->getInstance($sql);
    }
}
