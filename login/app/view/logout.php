<?php
require_once __DIR__ . "/../controller/LoginController.php";

$controller = new LoginController();
$controller->logout();

header("Location: login.php");
exit;
