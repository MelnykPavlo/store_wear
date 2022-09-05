<?php

namespace core;


/**
 * Головний клас ядра системи
 * (синглтон)
 */
class Core
{
    private static $instance;
    private static $mainTemplate;
    private static $db;

    private function __construct()
    {
        global $Config;
        spl_autoload_register('\core\Core::__autoload');
        self::$db = $db = new \core\DB(
            $Config['Database']['Server'],
            $Config['Database']['Username'],
            $Config['Database']['Password'],
            $Config['Database']['Database']
        );
    }

    /**
     * Повертає екземпляр ядра системи
     * @return Core
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
            return self::getInstance();
        } else
            return self::$instance;
    }

    public function getDB()
    {
        return self::$db;
    }
    /**
     * Ініціалізація системи
     */
    public function init()
    {
        session_start();
        self::$mainTemplate = new Template();
    }

    /**
     * Виконує основний процес роботи CMS-системи
     * @return void
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function run()
    {
        $path = $_GET['path'];
        $pathParts = explode('/', $path);
        $className = ucfirst($pathParts[0]);
        if (empty($className))
            $fullClassName = "controllers\\Site";
        else
            $fullClassName = "controllers\\" . $className;
        $methodName = ucfirst($pathParts[1]);
        if (empty($methodName))
            $fullMethodName = 'actionIndex';
        else
            $fullMethodName = 'action' . $methodName;
        if (class_exists($fullClassName)) {
            $controller = new $fullClassName();
            if (method_exists($controller, $fullMethodName)) {
                $method = new \ReflectionMethod($fullClassName, $fullMethodName);
                $paramsArray = [];
                foreach ($method->getParameters() as $parameter) {
                    array_push($paramsArray, isset($_GET[$parameter->name]) ? $_GET[$parameter->name] : null);
                }
                $result = $method->invokeArgs($controller, $paramsArray);
                if (is_array($result)) {
                    self::$mainTemplate->setParams($result);
                }
            } else
                header("Location: /errors/404_errors.php");
        } else
            header("Location: /errors/404_errors.php");
    }

    /**
     * Завершення роботи системи та виведення результату
     * @return void
     */
    public function done()
    {
        self::$mainTemplate->display('views/layout/index.php');
    }

    /**
     * Автозавантажувач класів
     * @param $className
     * @return void
     */
    public static function __autoload($className)
    {
        $fileName = $className . '.php';
        if (is_file($fileName))
            include($fileName);
    }
}