<?php
require  __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> load();

$data = array(
  'api_key' => $_ENV["MAPS_API_KEY"],
);

header('Content-Type: application/json');
echo json_encode($data);
?>