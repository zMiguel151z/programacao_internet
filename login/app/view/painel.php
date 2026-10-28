<?php
    /**
     * painel.php — View do painel do usuário.
     *
     * Mostra o nome do usuário logado, os botões de editar/deletar conta
     * e (mais abaixo, incluída pelo index.php) a lista de tarefas.
     */

    // Guarda de segurança: se não há id na sessão, o usuário não está logado.
    // Nesse caso, manda de volta para o login e encerra.
    if (!isset($_SESSION['id_usuario'])) {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <!-- CSS do painel e das tarefas. -->
    <link rel="stylesheet" href="/app/view/style/style.css">
</head>
<body>


    <!--
      Mensagem "flash" de sucesso (definida no login).
      empty() é false quando a mensagem existe; então mostramos um alert().
      json_encode() transforma o texto em uma string JavaScript segura
      (com aspas e escapes), evitando erro de sintaxe.
      Depois do alert, unset() apaga a mensagem para ela não repetir.
    -->
    <?php if (!empty($_SESSION['sucesso'])) :?>
        <script>alert(<?= json_encode($_SESSION['sucesso']) ?>)</script>
        <?php unset($_SESSION['sucesso']); ?>
    <?php endif;?>
    
    <center>
        <h1>
            Bem-vindo ao painel,
            <!-- htmlspecialchars() evita que o nome seja interpretado como HTML. -->
            <?= htmlspecialchars($_SESSION['nome']) ?>
        </h1>

        <p>
            <!--
              Os atributos data-* guardam dados no próprio botão.
              O JavaScript abaixo lê esses valores com botao.dataset.*.
              (int) garante que o id seja número.
            -->
            <button
                data-id="<?= (int) $_SESSION['id_usuario'] ?>"
                data-nome="<?= htmlspecialchars($_SESSION['nome']) ?>"
                data-email="<?= htmlspecialchars($_SESSION['email']) ?>"
                onclick="abrirModalUsuario(this)">
                Editar
            </button>

            <!-- onclick chama a função JS que abre o modal de confirmação. -->
            <button type="button" onclick="abrirConfirmacao()">Deletar conta</button>
        </p>

        <p>
            <!-- Link de logout: envia a action logoutUsuario para o index.php. -->
            <a href="index.php?action=logoutUsuario">Sair</a>
        </p>
    </center>

    <!-- include "cola" o HTML dos modais aqui dentro da página. -->
    <?php include __DIR__ . '/modalEditarUser.php'; ?>
    
    <?php include __DIR__ . '/deletarModal.php'; ?>

    

    <script>

        

        /**
         * Abre o modal de edição preenchendo os campos com os dados do botão.
         * @param {HTMLElement} botao o botão que foi clicado
         */
        function abrirModalUsuario(botao) {

            // getElementById() busca um elemento pelo id no HTML.
            // .value define o valor de um campo de formulário.
            document.getElementById("editarUsuarioId").value = botao.dataset.id;
            document.getElementById("editarNome").value = botao.dataset.nome;
            document.getElementById("editarEmail").value = botao.dataset.email;
            document.getElementById("editarSenha").value = "";

            // .style.display = "block" torna o modal visível.
            document.getElementById("usuarioEditar").style.display = "block";
        
        }
        
        /**
         * Fecha o modal de edição (display "none" esconde).
         */
        function fecharModalUsuario() {
            document.getElementById("usuarioEditar").style.display = "none";
        }

        /**
         * Abre o modal de confirmação de exclusão da conta.
         */
        function abrirConfirmacao() {
            document.getElementById("modalConfirmar").style.display = "flex";
        }
        
        /**
         * Fecha o modal de confirmação.
         */
        function fecharConfirmacao() {
            document.getElementById("modalConfirmar").style.display = "none";
        }

        // Se o controller gravou um erro em $erro_usuario (vindo da view
        // modalEditarUser.php), reabre o modal já preenchido para o usuário
        // corrigir. json_encode() gera strings JS seguras.
        <?php if ($erro_usuario): ?>
            document.getElementById("editareditarUsuarioId").value = <?= json_encode((string) $_SESSION['id_usuario']) ?>;
            document.getElementById("editarNome").value = <?= json_encode($_SESSION['nome']) ?>;
            document.getElementById("editarEmail").value = <?= json_encode($_SESSION['email']) ?>;
            document.getElementById("usuarioEditar").style.display = "block";
        <?php endif; ?>
    </script>
</body>
</html>
