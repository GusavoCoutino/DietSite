<?php
session_start();
unset($_SESSION['firstName']);
unset($_SESSION['lastName']);
header('Location: index.php');
?>