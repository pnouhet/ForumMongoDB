<?php
include "./model/Connection.php";

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

<<<<<<< HEAD
$uri = $_ENV["MONGODB_URI"];
$connection = new Connection($uri);
$db = $connection->getDB();
$collection = $db->user;

$filter = ["firstName" => "remi"];
$result = $collection->findOne($filter);
if ($result) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo "Document not found";
}

if (
    isset($_GET["ctrl"]) &&
    !empty($_GET["ctrl"]) &&
    (isset($_GET["action"]) && !empty($_GET["action"]))
) {
    $ctrl = $_GET["ctrl"];
    $action = $_GET["action"];
} else {
    $ctrl = "user";
    $action = "home";
}
require_once "./controller/" . $ctrl . "Controller.php";
$ctrl = $ctrl . "Controller";
$controller = new $ctrl($db);
$controller->$action();
