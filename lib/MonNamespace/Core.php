<?php
namespace MonNamespace;
use app\models;
require_once '../vendor/autoload.php';

/*use MonNamespace\Controller;*/
use MonNamespace\exceptions\NotFoundException;

class Core {
	public static function registerAutoload($className)
	{
		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';
		if ($lastNsPos = strrpos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

		if (file_exists('..\\'.$fileName)) {
			require_once ('..\\'.$fileName);
		}
		if (file_exists('..\\lib\\'.$fileName)) {
			require_once ('..\\lib\\'.$fileName);
		}

	}

	public static function run()
	{
		try {
			spl_autoload_register(array(__CLASS__, 'registerAutoload'));
			$controller = _D_CONTROLLER_;
			$method = _D_METHOD_;
			if (!empty($_GET['page'])) {
				$params = explode('/', $_GET['page']);
				if (isset($params[0])) { // verif a faire
					$controller = "app\\controllers\\" . ucfirst($params[0]).'Controller';
					if (isset($params[1])) {
						$method = $params[1] . 'Action';
					}
				}
			}
			$c = new $controller;
			$c->$method();
		} catch (\Exception $e) {
			if ($e instanceof \NotFoundException) {
				header("HTTP/1.1 404 Not Found");
			} else {
				header("HTTP/1.1 500 Internal Server Error");
			}
		}
	}
	public static function loadConfig()
	{
		$ini_path = "..\\app\\config.ini";
		return $ini = parse_ini_file($ini_path, true);
	}
}
?>