<?php
class ThongkeModel
{
    public function __construct()
    {
    }

    public function thongKeBookBorrowByMonth($month, $year, $column)
    {
        $db = new ConnectModel();

        if ($column == "danhsachmuon") {

            $sql = "SELECT ct.masach, ct.nhande, COUNT(ct.masach) as soluong
                FROM danhsachmuon ds
                INNER JOIN chitietmuon ct
                ON ds.mamuon = ct.mamuon
                WHERE  MONTH(ds.ngaymuon) = $month
                AND YEAR(ds.ngaymuon) = $year
                GROUP BY ct.masach
                ORDER BY COUNT(ct.masach) DESC
                LIMIT 10 ";
        } elseif ($column == "danhsachmat") {

            $sql = "SELECT masach, nhande, COUNT(masach) as soluong
                    FROM danhsachmat
                    WHERE  MONTH(ngaybaomat) = $month
                    AND YEAR(ngaybaomat) = $year
                    GROUP BY masach
                    ORDER BY COUNT(masach) DESC";
        } else {

            $sql = "SELECT ds.masv, ds.tensv, COUNT(ct.masach) as soluong
                    FROM danhsachmuon ds
                    INNER JOIN chitietmuon ct
                    ON ds.mamuon = ct.mamuon
                    WHERE  MONTH(ds.ngaymuon) = $month
                    AND YEAR(ds.ngaymuon) = $year
                    GROUP BY ds.masv
                    ORDER BY COUNT(ct.masach) DESC
                    LIMIT 10 ";
        }
        return $db->getList($sql);
    }

    public function thongKeBookBorrowByQuy($monthStart, $monthEnd, $year, $column)
    {
        $db = new ConnectModel();

        if ($column == "danhsachmuon") {

            $sql = "SELECT ct.masach, ct.nhande, COUNT(ct.masach) as soluong
                FROM danhsachmuon ds
                INNER JOIN chitietmuon ct
                ON ds.mamuon = ct.mamuon
                WHERE  MONTH(ds.ngaymuon) BETWEEN $monthStart AND $monthEnd
                AND YEAR(ds.ngaymuon) = $year
                GROUP BY ct.masach
                ORDER BY COUNT(ct.masach) DESC
                LIMIT 10 ";
        } elseif ($column == "danhsachmat") {

            $sql = "SELECT masach, nhande, COUNT(masach) as soluong
                    FROM danhsachmat
                    WHERE  MONTH(ngaybaomat) BETWEEN $monthStart AND $monthEnd
                    AND YEAR(ngaybaomat) = $year
                    GROUP BY masach
                    ORDER BY COUNT(masach) DESC";
        } else {

            $sql = "SELECT ds.masv, ds.tensv, COUNT(ct.masach) as soluong
                    FROM danhsachmuon ds
                    INNER JOIN chitietmuon ct
                    ON ds.mamuon = ct.mamuon
                    WHERE  MONTH(ds.ngaymuon) BETWEEN $monthStart AND $monthEnd
                    AND YEAR(ds.ngaymuon) = $year
                    GROUP BY ds.masv
                    ORDER BY COUNT(ct.masach) DESC
                    LIMIT 10 ";
        }
        return $db->getList($sql);
    }
}
