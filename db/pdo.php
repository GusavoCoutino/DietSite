<?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=DietSite', 'gustavo','root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>