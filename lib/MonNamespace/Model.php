<?php
namespace MonNamespace;
use \PDO;
abstract class Model {

	protected static $name;
	protected static $table;
	protected static $pdo;

	private $_host = _DB_HOST_;
	private $_dbname = _DB_NAME_;
	private $_unix_socket = _DB_SOCKET_;
	private $_login = _DB_LOGIN_;
	private $_pass = _DB_PASS_;

	private $_sql;

	public function __construct()
	{
		if (!self::$pdo) {
			self::$pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname.';unix_socket='.$this->_unix_socket, $this->_login, $this->_pass);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} else {
			return self::$pdo;
		}
	}
	public function getId($id)
	{
		$req = $this->select()->where('id = :id')->execBind(['id' => 1]);
		$res = $req->fetch();
		return $res;
	}
	public function lastInsertId()
	{
		return $this::$pdo->lastInsertId();
	}
	public function findAll ()
	{
		$this->_sql = "SELECT * FROM " .$this::$table; // VOIR + TARD param table
		$req = self::$pdo->query($this->_sql);
		return $res = $req->fetchAll();
	}
	public function select () // param fiels + tard
	{
		$this->_sql = "SELECT * FROM " .$this::$table;
		return $this;
	}
	public function where ($fields = null)
	{
		$more = strpos($fields, ',');
		if($more) {
			$field = explode(', ', $fields);
			$this->_sql .=" WHERE ".$field[0];
			array_shift($field);
			foreach($field as $f) {
				$type = explode('__', $f);
				if($type[0] == 'and') {
					$this->_sql.= " AND ".$type[1];
				} else if ($type[0] == 'or') {
					$this->_sql .= " OR ".$type[1];
				}
			}
		} else {
			$this->_sql .=" WHERE ".$fields;
		}
		return $this;
	}
	public function insert(Array $fields)
	{
		$key = array_keys($fields);
		$this->_sql = "INSERT INTO ".$this::$table. " (".implode(', ', $key).") VALUES (:".implode(', :', $key).")";
		$this->execBind($fields);

		return $this;
	}
	public function update(Array $fields)
	{
		$this->_sql = "UPDATE ".$this::$table." SET ";

		$first = true;
		foreach ($fields as $field => $value) {

			if (true === $first) {
				$this->_sql .= $field.' = :'.$field;
				$first = false;
			} else {
				$this->_sql .= ', '.$field.' = :'.$field;
			}
		}
		return $this;
	}
	public function order ($field)
	{
		$type = explode("__" , $field);
		$this->_sql.= " ORDER BY ".$type[0]. " ". $type[1];
		return $this;
	}

	public function limit($limit, $offset = null)
	{
		$this->_sql .= ' LIMIT '.$limit;
		if($offset) {
			$this->_sql .= ' OFFSET '.$offset;
		}
		return $this;
	}
	public function like($field, $keyup, $first = false)
	{
		// if first  -> where(1=1)->like('login', '%ly%');
		if($first) {
			$this->_sql .= ' WHERE '.$field.' LIKE "'.$keyup.'"';
		} else {
			$this->_sql .= ' AND '.$field.' LIKE "'.$keyup.'"';
		}
		return $this;
	}

	public function exec(Array $values = [], $one = false)
	{
		if(empty($values)) {
			$req = self::$pdo->query($this->_sql);
		} else {
			$req = self::$pdo->prepare($this->_sql);
			$req->execute($values);
		}
		if($one) {
			return $res = $req->fetch();
		}
		return $res = $req->fetchAll();
	}

	public function execBind(Array $fields)
	{
		$req = self::$pdo->prepare($this->_sql);

		foreach ($fields as $key => &$value) {
			$req->bindParam(":".$key, $value);
		}
		$req->execute();
		return $req;
	}
}
?>