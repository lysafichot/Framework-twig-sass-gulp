<?php
require_once (dirname(__FILE__) . "/../lib/MonNamespace/Core.php");

$ini = MonNamespace\Core::loadConfig();

define('_DB_HOST_', $ini['database']['host']);
define('_DB_NAME_', $ini['database']['dbname']);
define('_DB_LOGIN_', $ini['database']['login']);
define('_DB_PASS_', $ini['database']['pass']);
define('_DB_SOCKET_', $ini['database']['unix_socket']);

define('_D_CONTROLLER_', $ini['default']['controller']);
define('_D_METHOD_', $ini['default']['method']);

MonNamespace\Core::run();

?>