<?php
include "./model/Connection.php";

require "vendor/autoload.php";

require_once "./model/entity/Post.php";
require_once "./model/manager/PostManager.php";
require_once "./model/entity/User.php";
require_once "./model/manager/UserManager.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV["MONGODB_URI"];
$connection = new Connection($uri);
$db = $connection->getDB();

$ctrlParam = $_GET["ctrl"] ?? "post";
$action = $_GET["action"] ?? "getPosts";

$ctrlClass = ucfirst(strtolower($ctrlParam)) . "Controller";
$controllerFile = "./controller/{$ctrlClass}.php";

if (!file_exists($controllerFile)) {
    die("Controller not found");
}

require_once $controllerFile;

if (!class_exists($ctrlClass)) {
    die("Controller class not found");
}

$controller = new $ctrlClass($db);

if (!method_exists($controller, $action)) {
    die("Action not found");
}

$controller->$action();
?>
