<?php
include './Model/Connection.php';
require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$uri = $_ENV['MONGODB_URI'];
$connection = new Connection($uri);
$db = $connection->getDB();
$collection = $db->user;
$filter = ['firstName' => 'remi'];
$result = $collection->findOne($filter);

if ($result) {
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    echo 'Document not found';
}