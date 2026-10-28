<!DOCTYPE html>
<!--
  login.php — View da tela de login.
  Uma "view" é só a parte visual (HTML). Ela recebe variáveis do controller
  (como $erro) e mostra o formulário para o usuário digitar e-mail e senha.
-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login MVC</title>

    <!-- Caminho do arquivo CSS que deixa a tela bonita. -->
    <link rel="stylesheet" href="/app/view/style/autenticacaoStyle.css">
</head>
<body>

<div>

    <h1>Acesse sua conta</h1>

    <!--
      isset($erro) pergunta: "existe uma variável $erro definida?"
      O controller define $erro quando o login falha (ex.: senha errada).
    -->
    <?php if(isset($erro)): ?>
        <p style="color: red;">
            <!--
              htmlspecialchars() converte caracteres especiais (<, >, &) em texto
              seguro, evitando que um texto malicioso vire HTML/JavaScript.
            -->
            <?php echo htmlspecialchars($erro); ?>
        </p>
    <?php endif; ?>

    <!--
      action = para onde o formulário envia os dados.
      method="POST" = os dados vão no corpo da requisição (não aparecem na URL).
      O "?action=autenticarUsuario" diz ao index.php qual método chamar.
    -->
    <form action="/../index.php?action=autenticarUsuario" method="POST">
        <p class="input">
            <label>E-mail</label>
            <!-- name="email" é a chave que chegará em $_POST['email']. -->
            <input type="email" name="email">
        </p>

        <p class="input">
            <label>Senha</label>
            <!-- type="password" esconde os caracteres digitados. -->
            <input type="password" name="senha">
        </p>

        <p>
            <button type="submit">Entrar</button>
            <!-- Link para a tela de cadastro (ação cadastrarUsuario). -->
            <a href="/index.php?action=cadastrarUsuario">Criar</a>
        </p>
    </form>

</div>
</body>
</html>
