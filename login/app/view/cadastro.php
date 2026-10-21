<?php
require_once __DIR__ . "/../controller/LoginController.php";

$controller = new LoginController();

if ($controller->estaLogado()) {
    header("Location: painel.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($nome === "" || $email === "" || $senha === "") {
        $erro = "Preencha todos os campos.";
    } else {
        try {
            if ($controller->criar($nome, $email, $senha)) {
                header("Location: login.php");
                exit;
            }
            $erro = "Não foi possível cadastrar o usuário.";
        } catch (Throwable $e) {
            $erro = "Não foi possível cadastrar. O email já pode estar em uso.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h1>Criar conta</h1>

    <?php if ($erro !== ""): ?>
        <p><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="post" action="cadastro.php">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </p>
        <p>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>

    <p><a href="login.php">Já tenho conta</a></p>
</body>
</html>
