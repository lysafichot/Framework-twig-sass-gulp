<?php
namespace MonNamespace;
use Twig_Autoloader;
use Twig_Loader_Filesystem;
use Twig_Environment;

abstract class Controller
{
	public function render($view, $params = null)
	{
		$path_view = explode(':', $view);
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem( '../app/views/' .$path_view[0]);
		$twig = new Twig_Environment($loader, array('debug' => true), array('auto_reload' => true), array('cache' => '../../app/views'));
		echo $twig->render($path_view[1] . ".html", $params);
	}
	public  function getParam($paramName)
	{
		$route = explode('/', htmlspecialchars($_GET['page']));
		$params = array_slice($route, 2);
		foreach ($params as $key => $value) {
			if ($key  == 0 || $key % 2 == 0 ) {
				if ($value == $paramName) {
					return $params[$key + 1];
				}
			}
		}

	}
}
?>