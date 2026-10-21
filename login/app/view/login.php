<?php
require_once __DIR__ . "/../controller/UserController.php";

$controller = new UserController();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Entrar</h1>

    <?php if ($erro !=  ""): ?>
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
