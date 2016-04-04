<?php
namespace app\controllers;
use \app\models\UserTable;

/*use \MonNamespace\Controller;*/

class IndexController extends \MonNamespace\Controller {

	public function indexAction() {
		$this->render('Index:index', []);
	}
}
?>