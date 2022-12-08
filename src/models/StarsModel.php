<?php
class StarsModel{
    var $bookid=null;
    var $masv=null;
    var $stars=null;
    // hàm tạo
    function __construct(){}
    // phương thức tính trung bình
    function avg()
    {
        $select="select bookid,round(avg(sodiem),2) as avg from danhgia group by bookid";
        $db=new ConnectModel();
        $result=$db->getList($select);
        $average=[];
        while($set=$result->fetch())
        {
            $average[$set['bookid']]=$set['avg'];
        }
        return $average;
    }

    function getRating($uid,$id)
    {
        $select="select sodiem from danhgia where masv=$uid 
        and bookid=$id";
        $db=new ConnectModel();
        $result=$db->getInstance($select);
        return $result[0];

    }

    function update($pid,$uid,$rating)
    {
        $query="REPLACE INTO danhgia(bookid,masv,sodiem)values(?,?,?)";
        $db=new ConnectModel();
        $stm=$db->execP($query);
        $stm->execute([$pid,$uid,$rating]);
    }
    
}   