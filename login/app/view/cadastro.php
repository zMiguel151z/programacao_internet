<!DOCTYPE html>
<!--
  cadastro.php — View da tela de cadastro.
  Mostra o formulário para criar uma conta nova. O controller define $erro
  quando algum campo está vazio ou quando o e-mail já existe.
-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login MVC</title>

    <!-- Folha de estilo da tela de autenticação. -->
    <link rel="stylesheet" href="/app/view/style/autenticacaoStyle.css">
</head>
<body>
<div>

    <h1>Crie a sua conta</h1>

    <!-- Se o controller definiu $erro, mostramos a mensagem em vermelho. -->
    <?php if(isset($erro)): ?>
        <p style="color: red;">
            <!-- htmlspecialchars() impede que o texto seja interpretado como HTML. -->
            <?php echo htmlspecialchars($erro); ?>
        </p>
    <?php endif; ?>

    <!--
      Envia os dados via POST para index.php?action=criarUsuario.
      O controller criar() valida e grava o usuário no banco.
    -->
    <form action="/../index.php?action=criarUsuario" method="POST">
        <p class="input">
            <label>Nome</label>
            <!-- name="nome" chegará em $_POST['nome']. -->
            <input type="text" name="nome" placeholder="Didite o seu Nome">
        </p>

        <p class="input">
            <label>E-mail</label>
            <!-- name="email" chegará em $_POST['email']. -->
            <input type="email" name="email" placeholder="Didite o seu Email">
        </p>

        <p class="input">
            <label>Senha</label>
            <!-- name="senha" chegará em $_POST['senha']. -->
            <input type="password" name="senha" placeholder="Didite a sua Senha">
        </p>

        <p>
            <button type="submit">Cadastrar</button>
            <!-- Volta para a tela de login. -->
            <a href="/index.php">Voltar</a>
        </p>
    </form>

</div>
</body>
</html>
