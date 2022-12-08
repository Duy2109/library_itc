<?php
class CategoryModel
{

    private $table = 'theloai';

    public function __construct()
    {
    }

    public function getCategory()
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM $this->table";
        return $db->getList($sql);
    }

    public function getCategoryById($id)
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM theloai WHERE id = $id";
        return $db->getInstance($sql);
    }

    public function insertCategory($data)
    {
        $db = new ConnectModel();
        return $db->insert($this->table, $data);
    }

    public function updateCategory($tentheloai, $id)
    {
        $db = new ConnectModel();
        $sql = "UPDATE $this->table SET tentheloai = '$tentheloai' WHERE id = $id";
        return $db->exec($sql);
    }

    public function deleteCategory($id)
    {
        $db = new ConnectModel();
        $sql = "DELETE FROM $this->table WHERE id = '$id'";
        $db->exec($sql);
    }


    // get khoa

    public function getKhoa()
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM khoa";
        return $db->getList($sql);
    }


    // get ngành
    public function getNganh()
    {
        $db = new ConnectModel();
        $sql = "SELECT * FROM nganh";
        return $db->getList($sql);
    }
}
