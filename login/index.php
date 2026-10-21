<?php
require_once __DIR__ . "/app/controller/LoginController.php";

$controller = new LoginController();
$controller->exigirLogin();

header("Location: /app/view/painel.php");
exit;
