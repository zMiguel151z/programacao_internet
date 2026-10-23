
<center>

<div id="usuarioEditar" class="modal">

    <div class="modal-conteudo">

        <h2>Editar Usuario</h2>

        <?php
            $erro_usuario = $_SESSION['erro_usuario'] ?? null;
            unset($_SESSION['erro_usuario']);
        ?>
        <?php if($erro_usuario): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($erro_usuario); ?>
            </p>
        <?php endif; ?>

        <form action="index.php?action=atualizarUsuario" method="POST">

            <input type="hidden" name="id" id="editarUsuarioId">

            <input type="text" name="nome" id="editarNome" required>
            <input type="email" name="email" id="editarEmail" required>
            <input type="password" name="senha" id="editarSenha" required>

            <p>
                <button type="submit"> Salvar </button>
    
                <button type="button" onclick="fecharModalUsuario()">Cancelar</button>
            </p>

        </form>

    </div>

</div>

</center>