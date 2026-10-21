<?php
require_once __DIR__ . "/../controller/LoginController.php";

$controller = new LoginController();
$controller->exigirLogin();

echo "Olá, " . htmlspecialchars($_SESSION['usuario_nome']);