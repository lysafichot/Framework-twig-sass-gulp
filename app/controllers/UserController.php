<?php
/*echo dirname(__FILE__);*/
namespace app\controllers;
use \MonNamespace\Validator;
use \app\models\UserTable;

/*use \MonNamespace\Controller;*/

class UserController extends \MonNamespace\Controller {

	public function indexAction()
	{

		$userTable = new \app\models\UserTable();
		/*var_dump($userTable);*/
		/*$user = $userTable->findAll();*/
		$user = $userTable->select()->where('username = ?, or__lastname = ?')->exec(array('lysa', 'll'), true);
		/*var_dump($user);*/
		/*$user = $userTable->select()->order('username__asc')->exec();*/
		/*$user = $userTable->select()->like('username', '%ly%', true)->exec();*/
		/*$user = $userTable->select()->where('1=1')->like('username', '%m%')->exec();*/
		/*$user = $userTable->select()->limit(2, 1)->exec();*/
		/*$user = $userTable->getId(1);*/
		/*$user = $userTable->insert(['username' => 'jooo', 'firstname' => 'kooo', 'lastname' => 'njjbhb']);*/

		/*$array = ['username' => 'lysa', 'firstname' => 'chouh', 'lastname' => 'ylol'];
		$exe = array_merge($array, ['id' => 1]);
		$user = $userTable->update($array)->where('id_user = :id')->execBind($exe);*/

		if(!is_array($user)) {
			$user = [];
		}
		$this->render('Index:connexion', array('users' => $user));
		/*$this->render('Index:connexion',  array('email' => 'lolololol'));*/

	}
	public function signAction()
	{
			var_dump($_POST);
		if(!empty($_POST['user_sign'])) {
			$username = htmlspecialchars($_POST['user_username']);
			$password = htmlspecialchars($_POST['user_password']);
			$email = htmlspecialchars($_POST['user_email']);
			if(!empty($username) && !empty($password) && !empty($email)) {
				$validator = new Validator($_POST);
				$validator->isAlpha('user_username', 'Username is invalide alphanumeriquement');
				/*$validator->isEmail('user_email', 'Email is invalide');*/
				if($validator->isValid()) {
					$user = new \app\models\UserTable();
					$token = $token = bin2hex(openssl_random_pseudo_bytes(16));
					$user->insert(['username' => $username, 'password' => $password, 'email' => $email, 'token' => $token]);
					$id = $user->lastInsertId();
					mail($email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/PHP_Avance_my_framework/public/user/confirm/id/".$id."/token/".$token);
				} else {
					$errors = $validator->getErrors();
					foreach ($errors as $key => $value) {
						\MonNamespace\Session::setFlash($key, $value);
					}
				}
			}
		}
		$flash = [];
		if(\MonNamespace\Session::hasFlashes()) {
			$flash = \MonNamespace\Session::getFlashes();
		}
		$this->render('Index:sign', array(['flashs' => $flash]));
	}
	public function confirmAction()
	{
		$id = $this->getParam('id');
		$token = $this->getParam('token');
		if($id && $token) {
			$user = new \app\models\UserTable(\MonNamespace\Session::getInstance());
			if($user->confirm($id, $token)) {
				var_dump($user);

			$user->getSession()->set('user', $user);
			$this->render('Index:confirm', array('confirm' => true));

			} else {
				$this->render('Index:confirm', array('confirm' => false));

			}
		}
	}
	public function listAction()
	{
		echo 'je liste';
		$mois = $this->getParam('mois');
		$tag = $this->getParam('tag');
		var_dump($mois);
		var_dump($tag);
	}


	public function logAction()
	{
		$user = new \app\models\UserTable(Session::getInstance());
		$user->restrict_already();
		$this->setView('log');

		if(isset($_POST['user_log'])) {
			$validator = new Validator($_POST);
			$user = new user(SessionManager::getInstance());

			$username = htmlspecialchars($_POST['user_username']);
			$pass = htmlspecialchars($_POST['user_password']);

			if($user->login($username, $pass)) {
				$id = $user->getSession()->get('user')->id_user;
				$this->render('Index:compte', array(['user' => $user->getSession()]));
				return true;
			} else {
				Session::setFlash('danger', 'Identifiants incorrects');
			}
		}
		$this->render('Index:log', array('user' => $user->getSession()));



	}
	public function compteAction()
	{
		$user = new \app\models\UserTable(Session::getInstance());
		$user->restrict();
		Session::getInstance();
		$id = $this->getParam('id');
		if($id != $_SESSION['user']['user_id']) {
			$this->render('Index:index', array());
		}
	}

	public function deconnectAction()
	{
		$session = SessionManager::getInstance();
		$session->get('user');
		$session->destroy();
	}
}

?>