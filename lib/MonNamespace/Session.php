<?php
namespace MonNamespace;

class Session
{
    static $instance;
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new  Session();
        }
        return self::$instance;
    }

    public function __construct()
    {
        session_start();
    }

    public function get($paramName)
    {
        return isset($_SESSION[$paramName]) ? $_SESSION[$paramName] : null;
    }

    public function set($paramName, $value)
    {
        $_SESSION[$paramName] = $value;
    }

    public static function setFlash($key, $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    public static function hasFlashes()
    {
        return isset($_SESSION['flash']);
    }

    public static function getFlashes()
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    public function destroy()
    {
        self::$_instance = null;
        session_destroy();
    }
}
