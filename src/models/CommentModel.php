<?php
class CommentModel
{

    public function insertComment($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }

    public function getComment($masach)
    {
        $db = new ConnectModel();
        $sql = "SELECT bl.mabl, bl.ngaybl, bl.noidung, sv.tensv 
                FROM binhluan bl
                INNER JOIN sinhvien sv
                ON sv.masv = bl.masv
                WHERE masach = $masach          
                ORDER BY mabl DESC";
        return $db->getList($sql);
    }

    public function insertReplyComment($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }

    public function getAllReplyComment($mabl_cha, $masach)
    {
        $db = new ConnectModel();
        $sql = "SELECT tl.mabl, tl.ngaybl, tl.noidung, sv.tensv 
                FROM binhluan bl
                INNER JOIN sinhvien sv
                ON sv.masv = bl.masv 
                INNER JOIN traloi_bl tl
                ON tl.mabl_cha = bl.mabl
                WHERE tl.masach = $masach
                AND tl.mabl_cha = $mabl_cha        
                ORDER BY mabl DESC";

        // echo $sql;
        return $db->getList($sql);
    }

    public function getStarById($bookid)
    {
        $db = new ConnectModel();
        $sql = "SELECT danhgia FROM binhluan WHERE masach = $bookid ";
        return $db->getList($sql);
    }

    public function averageStar($bookid)
    {
        $sum = 0;
        $data = $this->getStarById($bookid);
        $data = $data->fetchAll();

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $sum += (int)($value['danhgia']);
            }
            echo ($sum / count($data));
        } else {
            echo $sum;
        }
    }
}
