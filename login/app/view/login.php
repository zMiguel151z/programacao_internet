<?php
require_once __DIR__ . "/../controller/LoginController.php";

$controller = new LoginController();

if ($controller->estaLogado()) {
    header("Location: painel.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($email === "" || $senha === "") {
        $erro = "Preencha o email e a senha.";
    } elseif ($controller->login($email, $senha)) {
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Entrar</h1>

    <?php if ($erro !== ""): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>

    <p><a href="cadastro.php">Criar conta</a></p>
</body>
</html>
