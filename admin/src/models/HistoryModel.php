<?php
class HistoryModel
{
    public function __construct()
    {
    }

    public function getBorrowList()
    {
        $db = new ConnectModel();
        $sql = "SELECT d.masv, d.ngaymuon, d.ngaytra, d.maadm, c.masach, c.nhande 
                FROM danhsachmuon d  
                INNER JOIN chitietmuon c
                ON c.mamuon = d.mamuon
                ORDER BY d.ngaymuon DESC
                LIMIT 5";
        $result = $db->getList($sql);
        return $result;
    }

    public function getAllStudentBorrowing()
    {
        $db = new ConnectModel();
        $sql = "SELECT muon.masv,muon.tensv,muon.maadm, count(muon.masv) as tongmuon
                FROM ( 
                    SELECT ct.masach, ct.nhande, ds.mamuon, ds.masv,ds.tensv, ds.maadm 
                    FROM chitietmuon ct 
                    INNER JOIN danhsachmuon ds 
                    ON ct.mamuon = ds.mamuon
                    GROUP BY ct.id DESC) muon 
                WHERE muon.mamuon NOT IN (SELECT mamuon FROM danhsachtra) 
                OR muon.masach NOT IN (SELECT masach FROM danhsachtra)
                GROUP BY muon.masv DESC";


        $result = $db->getList($sql);
        return $result;
    }

    // tìm theo $masv cung cấp  
    public function getStudentBorrowing($masearch)
    {
        $db = new ConnectModel();
        $sql = "SELECT muon.masv,muon.tensv,muon.maadm, count(muon.masv) as tongmuon
                FROM ( 
                    SELECT ct.masach, ct.nhande, ds.mamuon, ds.masv,ds.tensv, ds.maadm 
                    FROM chitietmuon ct 
                    INNER JOIN danhsachmuon ds 
                    ON ct.mamuon = ds.mamuon
                    WHERE ds.masv LIKE '%$masearch%'
                    GROUP BY ct.id DESC) muon 
                WHERE muon.mamuon NOT IN (SELECT mamuon FROM danhsachtra) 
                OR muon.masach NOT IN (SELECT masach FROM danhsachtra)
                GROUP BY muon.masv DESC";


        $result = $db->getList($sql);
        return $result;
    }

    public function getDetailBorrowByCodeStudent($student_code)
    {
        $db = new ConnectModel();
        $sql = "SELECT muon.masv, muon.tensv, muon.masach, muon.nhande, muon.maadm, muon.mamuon
                FROM ( SELECT ct.masach, ct.nhande, ds.mamuon, ds.masv,ds.tensv, ds.maadm 
                        FROM chitietmuon ct 
                        INNER JOIN danhsachmuon ds 
                        ON ct.mamuon = ds.mamuon
                        WHERE ds.masv = '$student_code' 
                        GROUP BY ct.id DESC) muon 
                WHERE muon.mamuon NOT IN (SELECT mamuon FROM danhsachtra) 
                OR muon.masach NOT IN (SELECT masach FROM danhsachtra) ";
        return $db->getList($sql);
    }

    public function getBorrowListByID($masv)
    {
        $db = new ConnectModel();
        $sql = "SELECT  d.masv, d.ngaymuon, d.ngaytra, d.maadm, c.masach, c.nhande, c.soluong, c.mamuon
                FROM danhsachmuon d  
                INNER JOIN chitietmuon c
                ON c.mamuon = d.mamuon
                WHERE d.masv = '$masv'
                ORDER BY  c.mamuon DESC";
        $result = $db->getList($sql);
        return $result;
    }

    public function getReturnList()
    {
        $db = new ConnectModel();
        $sql = "SELECT * 
                FROM danhsachtra
                ORDER BY ngaytra DESC
                LIMIT 5";
        $result = $db->getList($sql);
        return $result;
    }

    public function getLoseBook()
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM danhsachmat limit 5";
        $result = $db->getList($sql);
        return $result;
    }


    public function insertLoseABook($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }

    public function checkExistBorrowing($mamuon)
    {
        $db = new ConnectModel();
        $sql = "Select * from chitietmuon where mamuon = '$mamuon'";
        $result = $db->getInstance($sql);
        return $result;
    }

    /**
     * Lấy danh sách sinh viên mượn sách quá hạn
     */
    public function getListLated()
    {
        $db = new ConnectModel();
        $sql = "SELECT sv.masv, sv.tensv, c.nhande, d.ngaymuon, d.ngaytra 
                FROM danhsachmuon d, chitietmuon c, sinhvien sv 
                WHERE d.mamuon = c.mamuon 
                AND d.masv = sv.masv";
        $result = $db->getList($sql);
        return $result;
    }

    // chi tiết từng column in dashboard
    public function getDetailInDashboard($column)
    {
        if ($column == "danhsachmuon") {
            $sql = "SELECT ds.masv, ds.ngaytra, ds.maadm, ct.masach, ct.nhande,ds.ngaymuon 
                    FROM $column ds
                    INNER JOIN chitietmuon ct
                    ON ds.mamuon = ct.mamuon
                    ORDER BY ds.ngaymuon  DESC";
        } else {
            $sql = "SELECT * FROM $column ";
        }
        $db = new ConnectModel();
        $result = $db->getList($sql);
        return $result;
    }

    // update stock in sach

    public function updateStockInBook($masach)
    {
        $db = new ConnectModel();
        $sql = "UPDATE sach SET soluong = soluong + 1 WHERE masach = $masach";
        $result = $db->exec($sql);
        return $result;
    }

    // insert in table danhsachtra
    public function InsertReturnBook($table, $data)
    {
        $db = new ConnectModel();
        return $db->insert($table, $data);
    }
}
