<?php
namespace app\models;

use MonNamespace\Session;

class UserTable extends \MonNamespace\Model {
	protected static $table = 'user';

	protected $username;
	protected $firstname;
	protected $lastname;
	protected $password;
	protected $email;
	protected $token;
	protected $date_sign;
	protected $active = 0;
	protected $session;

	public function __construct($session = null) {
		parent::__construct();
		if($session) {
		return $this->session = $session;
		}
	}

	public function setUsername($username) {
		$this->username = $username;
	}
	public function getUsername() {
		return $this->username;
	}
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}
	public function getLastname() {
		return $this->lastname;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setToken($token) {
		return $this->token = $token;
	}
	public function getToken() {
		return $this->token;
	}
	public function getSession() {
		return $this->session;
	}

	public function restrict()
	{
		if(!$this->session->get('user')) {
			$this->session->setFlash('danger', "Vous n'avez pas la permission d'acceder a cette page");
			exit();
		}
	}

	public function user()
	{
		if(!$this->session->get('user')) {
			return false;
		}
		return $this->session->get('user');
	}

	public function connect ($user)
	{
		$this->session->set('user', $user);
	}

	public function login($username, $pass)
	{

		$user = new \app\models\UserTable();
		$user = $user->select()->where('username = ?', 'and__active = ?')->exec(array($username, 1), true);
		if($user && password_verify($pass, $user['password'])) {
			$this->connect($user);
			return true;
		}
		return false;
	}

	public function confirm($user_id, $token)
	{
		$query = new \app\models\UserTable(\MonNamespace\Session::getInstance());
		$user = $query->select()->where('id_user= ?')->exec(array($user_id), true);
		if($user && $user['token' ]== $token) {
			$user['token' ] = null;
			$user['actif' ] = 1;
			$now = date("Y-m-d H:i:s");

		$query->update(array('token' => null, 'actif'=>1))->where('id_user = :id')->execBind(array('token' => null, 'actif' => 1, 'id' => $user_id));

			return true;
		}
		return false;
	}
}

?>