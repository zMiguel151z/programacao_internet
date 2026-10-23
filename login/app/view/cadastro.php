<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login MVC</title>

    <link rel="stylesheet" href="/app/view/style/autenticacaoStyle.css">
</head>
<body>
<div>

    <h1>Crie a sua conta</h1>

    <?php if(isset($erro)): ?>
        <p style="color: red;">
            <?php echo htmlspecialchars($erro); ?>
        </p>
    <?php endif; ?>

    <form action="/../index.php?action=criarUsuario" method="POST">
        <p class="input">
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Didite o seu Nome">
        </p>

        <p class="input">
            <label>E-mail</label>
            <input type="email" name="email" placeholder="Didite o seu Email">
        </p>

        <p class="input">
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Didite a sua Senha">
        </p>

        <p>
            <button type="submit">Cadastrar</button>
            <a href="/index.php">Voltar</a>
        </p>
    </form>

</div>
</body>
</html>
