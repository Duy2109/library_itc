<?php


class BookModel
{
    public function __construct()
    {
    }
    public function getAllBook()
    {
        $db = new ConnectModel();
        $select = "select * from sach";
        $res = $db->getList($select);
        return $res;
    }

    public function getNewBook()
    {
        $limit = 7;
        $db = new ConnectModel();
        $sql = "SELECT * FROM sach ORDER BY masach DESC LIMIT $limit";
        return $db->getList($sql);
    }

    public function onSearch($cloumn, $txtSearch)
    {
        $db = new ConnectModel();
        $select = "SELECT * FROM sach WHERE $cloumn like '%$txtSearch%'";
        $result = $db->getList($select);
        return $result;
    }
    public function getListITBook()
    {
        $db = new ConnectModel();
        $select = "select * from sach where bosuutap like '%CNTT%' ";
        $result = $db->getList($select);
        return $result;
    }
    public function getListECBook()
    {
        $db = new ConnectModel();
        $select = "select * from sach where bosuutap like '%KT%' ";
        $result = $db->getList($select);
        return $result;
    }
    public function getDetailInformation($id)
    {
        $db = new ConnectModel();
        $select = "select * from sach where masach = $id ";
        $result = $db->getInstance($select);
        return $result;
    }
    public function checkStatusOfThisUser($masv, $masach)
    {
        $db = new ConnectModel();
        $select = "select * from yeuthich  where masv = '$masv' and masach = '$masach'";
        $result = $db->getInstance($select);
        return $result;
    }
    public function removeLike($masv, $masach)
    {
        $db = new ConnectModel();
        $select = "delete from yeuthich where masv = '$masv' and masach = '$masach'";
        $result = $db->exec($select);
        return $result;
    }
    public function insertLike($masv, $masach)
    {
        $db = new ConnectModel();
        $select = "insert into yeuthich(mayeuthich, masv, masach) values(null, '$masv' ,'$masach')";
        $result = $db->exec($select);
        return $result;
    }
    public function getSumLike($masach)
    {
        $db = new ConnectModel();
        $select = "select count(masv) as sl from yeuthich where masach='$masach'";
        $result = $db->getInstance($select);
        return $result;
    }
    public function getTop5Like()
    {
        $db = new ConnectModel();
        $select = "select s.masach, nhande, tacgia, anhbia,count(masv) as sl from yeuthich y, sach s where s.masach = y.masach group by masach order by sl desc limit 5";
        $result = $db->getList($select);
        return $result;
    }
    public function getTop5Read()
    {
        $db = new ConnectModel();
        $select = "select masach, nhande, tacgia, anhbia,soluongmuon as sl from sach order by sl desc limit 5";
        $result = $db->getList($select);
        return $result;
    }
    public function getMyLikeBook($masv)
    {
        $db = new ConnectModel();
        $select = "select s.masach, nhande, tacgia, anhbia from yeuthich y, sinhvien sv, sach s where s.masach = y.masach and y.masv = sv.masv and sv.masv= '$masv' ";
        $result = $db->getList($select);
        return $result;
    }
    public function getBorrowByStudentCode($stu_code)
    {
        $db = new ConnectModel();
        $sql = "SELECT sa.masach, sa.nhande, sa.anhbia, sa.tacgia
                FROM danhsachmuon ds
                INNER JOIN chitietmuon ct
                ON ds.mamuon = ct.mamuon
                INNER JOIN sach sa
                ON sa.masach = ct.masach
                WHERE ds.masv = '$stu_code'";
        return $db->getList($sql);
    }


    // tìm kiếm theo category

    public function getBookByCategoryLimit($table, $name_category, $start, $limit)
    {
        $db = new ConnectModel();
        $sql = "SELECT *
                FROM $table   
                WHERE theloai = '$name_category' LIMIT $start, $limit";
        $result = $db->getList($sql);
        return $result;
    }
    public function getBookByCategory($table, $name_category)
    {
        $db = new ConnectModel();
        $sql = "SELECT *
                FROM $table   
                WHERE theloai = '$name_category' ";
        $result = $db->getList($sql);
        return $result;
    }
}
