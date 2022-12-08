<?php
class ConnectModel
{
	var $db = null;
	public function __construct()
	{
		$dsn = 'mysql:host=localhost;dbname=library';
		$user = 'root';
		$pass = '';
		$this->db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	//	https://megacode.vn/files/view/php-phuong-thuc-getinstance-la-gi-va-tai-sao-dung-getinstance-4922.html
	//	lấy đúng 1 ID nên lấy fetch vô luôn
	public function getInstance($select)
	{
		// echo $select;

		$results = $this->db->query($select);
		$result = $results->fetch();
		return $result;
	}

	//	Lấy nhiều rows
	public function getList($select)
	{
		$results = $this->db->query($select, PDO::FETCH_ASSOC);
		// echo $results;
		return ($results);
	}
	//	https://viblo.asia/p/cai-dat-ung-dung-php-thuan-su-dung-mvc-va-oop-4P856aA3lY3
	public function exec($query)
	{
		$results = $this->db->exec($query);
		// echo $results;
		return ($results);
	}
	// viết phương thức thực thi là prepare riêng vì muốn sau này các phương thức khác gọi nó mà ko cần viết lại
	public function execP($query)
	{
		$statement = $this->db->prepare($query);
		// echo $statement;
		return $statement;
	}

	public function insert($table, $data)
	{

		$keys = implode(",", array_keys($data));
		$values = ":" . implode(", :", array_keys($data));

		$sql = "INSERT INTO $table($keys) VALUE($values)";
		$statement = $this->db->prepare($sql);

		foreach ($data as $key => $value) {
			$statement->bindValue(":$key", $value);
		}
		return $statement->execute();
	}
}
