<?php
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
    <link rel="stylesheet" href="/app/view/style/style.css">
</head>
<body>
    <center>
        <h1>
            Bem-vindo ao painel,
            <?= htmlspecialchars($_SESSION['nome']) ?>
        </h1>

        <p>
            <button
                data-id="<?= (int) $_SESSION['id_usuario'] ?>"
                data-nome="<?= htmlspecialchars($_SESSION['nome']) ?>"
                data-email="<?= htmlspecialchars($_SESSION['email']) ?>"
                onclick="abrirModalUsuario(this)">
                Editar
            </button>

            <button type="button" onclick="abrirConfirmacao()">Deletar conta</button>
        </p>

        <p>
            <a href="index.php?action=logoutUsuario">Sair</a>
        </p>
    </center>

    <?php include __DIR__ . '/modalEditarUser.php'; ?>
    
    <?php include __DIR__ . '/deletarModal.php'; ?>

    

    <script>

        

        function abrirModalUsuario(botao) {

            document.getElementById("editarUsuarioId").value = botao.dataset.id;
            document.getElementById("editarNome").value = botao.dataset.nome;
            document.getElementById("editarEmail").value = botao.dataset.email;
            document.getElementById("editarSenha").value = "";
            document.getElementById("usuarioEditar").style.display = "block";
        
        }
        
        function fecharModalUsuario() {
            document.getElementById("usuarioEditar").style.display = "none";
        }

        function abrirConfirmacao() {
            document.getElementById("modalConfirmar").style.display = "flex";
        }
        
        function fecharConfirmacao() {
            document.getElementById("modalConfirmar").style.display = "none";
        }

        <?php if ($erro_usuario): ?>
            document.getElementById("editareditarUsuarioId").value = <?= json_encode((string) $_SESSION['id_usuario']) ?>;
            document.getElementById("editarNome").value = <?= json_encode($_SESSION['nome']) ?>;
            document.getElementById("editarEmail").value = <?= json_encode($_SESSION['email']) ?>;
            document.getElementById("usuarioEditar").style.display = "block";
        <?php endif; ?>
    </script>
</body>
</html>