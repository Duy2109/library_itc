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
}
