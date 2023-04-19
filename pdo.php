<?php
require  __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv -> load();

$pdo = new PDO('mysql:host=localhost;port=8889;dbname=DietSite', $_ENV['DB_USERNAME'], $_ENV["DB_PASSWORD"]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>