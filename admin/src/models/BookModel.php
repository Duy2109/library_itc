<?php

class BookModel
{
    public function __construct()
    {
    }

    public function getAllBook()
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM sach ";
        $result = $db->getList($sql);
        return $result;
    }
    public function getAllBookLimit($start, $limit)
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM sach LIMIT $start,$limit";
        $result = $db->getList($sql);
        return $result;
    }

    public function getBookByName($nhande)
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM sach WHERE nhande LIKE '%$nhande%'";
        $result = $db->getList($sql);
        return $result;
    }

    public function getBookById($masach)
    {
        $db = new ConnectModel();
        $sql = "SELECT masach, nhande, tacgia,anhbia FROM sach WHERE masach = '$masach' AND soluong > 0";
        return $db->getInstance($sql);
    }


    public function getBookByAuthor($author)
    {
        $db = new ConnectModel();
        $sql = "SELECT *  FROM sach WHERE tacgia = '$author'";
        $result = $db->getList($sql);
        return $result;
    }

    public function getBookByCategory($category)
    {
        $db = new ConnectModel();
        $sql = "SELECT *  FROM sach WHERE theloai = '$category'";
        $result = $db->getList($sql);
        return $result;
    }

    public function getAllAuthorBook()
    {
        $db = new ConnectModel();
        $sql = "SELECT DISTINCT tacgia FROM sach ";
        $result = $db->getList($sql);
        return $result;
    }


    function insertBookByCSV($masach, $nhande, $tacgia, $theloai, $bosuutap, $chuyennganh, $anhbia, $thongtinxb, $vitri, $soluong, $gia)
    {
        $db = new ConnectModel();
        $query = "INSERT INTO sach(masach, nhande, tacgia, theloai, bosuutap, chuyennganh, anhbia, thongtinxb, vitri, soluong, gia,soluongmuon) 
        VALUES ($masach, '$nhande', '$tacgia', '$theloai', '$bosuutap', '$chuyennganh', '$anhbia', '$thongtinxb', '$vitri', $soluong, $gia)";
        $result = $db->exec($query);
        return $result;
    }


    public function insertBook($table, $data)
    {
        $db = new ConnectModel();
        // $query = "INSERT INTO sach(masach, nhande, tacgia, theloai, bosuutap, chuyennganh, anhbia, thongtinxb, vitri, soluong, gia) VALUES (null, '$nhande', '$tacgia', '$theloai', '$bosuutap', '$chuyennganh', '$anhbia', '$thongtinxb', '$vitri', $soluong, $gia)";
        return $db->insert($table, $data);
    }

    public function getBookID($masach)
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM sach where masach= $masach";
        $result = $db->getInstance($sql);
        return $result;
    }

    public function updateStockInBook($masach, $soluong)
    {
        $db = new ConnectModel();
        $sql =  "UPDATE sach SET soluong = soluong - $soluong WHERE masach = '$masach'";
        $db->exec($sql);
    }

    public function updateBook($masach, $nhande, $tacgia, $theloai, $bosuutap, $chuyennganh, $anhbia, $thongtinxb, $vitri, $soluong, $gia)
    {
        $db = new ConnectModel();
        $query = "UPDATE sach set 
        masach = '$masach',
        nhande = '$nhande',
        tacgia = '$tacgia',
        theloai = '$theloai',
        bosuutap = '$bosuutap',
        chuyennganh = '$chuyennganh',
        anhbia = '$anhbia',
        thongtinxb = '$thongtinxb',
        vitri = '$vitri',
        soluong =  '$soluong',
        gia = '$gia' 
        WHERE masach = '$masach'";
        $db->exec($query);
    }

    public function updateBookByCategory($categoryNew, $categoryOld)
    {
        $db = new ConnectModel();
        $sql =  "UPDATE sach SET theloai = '$categoryNew' WHERE theloai = '$categoryOld'";
        echo $sql;
        $db->exec($sql);
    }

    public function deleteBook($masach)
    {
        $db = new ConnectModel();
        $query = "DELETE FROM sach WHERE masach = '$masach'";
        $db->exec($query);
    }

    public function deleteBookByCategory($tentheloai)
    {
        $db = new ConnectModel();
        $sql = "DELETE FROM sach WHERE theloai = '$tentheloai'";
        $db->exec($sql);
    }


    // quản lý hoạt động

    public function totalBorrowingByStudent($codeStudent)
    {
        $db = new ConnectModel();
        $sql = "SELECT count(muon.masv) as tongmuon
                FROM ( 
                    SELECT ct.masach, ct.nhande, ds.mamuon, ds.masv,ds.tensv, ds.maadm 
                    FROM chitietmuon ct 
                    INNER JOIN danhsachmuon ds 
                    ON ct.mamuon = ds.mamuon
                    WHERE ds.masv = '$codeStudent'
                    GROUP BY ct.id DESC) muon 
                WHERE muon.mamuon NOT IN (SELECT mamuon FROM danhsachtra) 
                OR muon.masach NOT IN (SELECT masach FROM danhsachtra)
                GROUP BY muon.masv DESC";
        $result = $db->getInstance($sql);
        return $result['tongmuon'] ?? 0;
    }

    public function getBorrowByCodeStudent($codeStudent)
    {
        $db  = new ConnectModel();
        $sql = "SELECT mamuon 
                FROM danhsachmuon 
                WHERE masv = '$codeStudent' 
                ORDER BY mamuon 
                DESC LIMIT 1";
        return $db->getInstance($sql);
    }

    public function insertBorrow($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }

    public function insertBorrowDetailt($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }

    public function getIdBookFromListBorrow($masach, $masv)
    {
        $db = new ConnectModel();
        $sql = "SELECT ds.masv, ds.tensv, ct.masach 
                FROM danhsachmuon ds
                INNER JOIN chitietmuon ct
                ON ds.mamuon = ct.mamuon
                WHERE ct.masach = '$masach'
                AND ds.masv = '$masv'";

        return $db->getInstance($sql);
    }

    public function updateBorrowNumber($masach, $soluong)
    {
        $db = new ConnectModel();
        $sql = "UPDATE sach SET soluongmuon = soluongmuon + $soluong WHERE masach = $masach";
        echo $sql;
        return $db->exec($sql);
    }



    // chart

    public function getBookByMonth()
    {
        $db = new ConnectModel();
        $sql = "SELECT s.nhande, MONTH(ds.ngaymuon) AS thangmuon, ct.tong
                FROM danhsachmuon ds 
                INNER JOIN (SELECT mamuon, masach, COUNT(soluong) AS tong FROM chitietmuon GROUP BY masach) ct 
                ON ds.mamuon = ct.mamuon 
                INNER JOIN sach s   
                ON s.masach = ct.masach";
        return  $db->getList($sql);
    }
}
