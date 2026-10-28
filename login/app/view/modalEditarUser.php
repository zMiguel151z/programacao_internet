
<!--
  modalEditarUser.php — Modal para editar os dados do usuário logado.
  É incluído pelo painel.php e aberto pelo botão "Editar".
-->

<center>

<div id="usuarioEditar" class="modal">

    <div class="modal-conteudo">

        <h2>Editar Usuario</h2>

        <?php
            // Lê a mensagem de erro guardada na sessão (flash message).
            // ?? null = se não existir, usa null (nenhum erro).
            $erro_usuario = $_SESSION['erro_usuario'] ?? null;

            // unset() apaga a mensagem da sessão para ela aparecer só uma vez.
            unset($_SESSION['erro_usuario']);
        ?>
        <!-- Se existe erro, mostra a mensagem em vermelho (com escape seguro). -->
        <?php if($erro_usuario): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($erro_usuario); ?>
            </p>
        <?php endif; ?>

        <!-- Envia os dados via POST para a action atualizarUsuario. -->
        <form action="index.php?action=atualizarUsuario" method="POST">

            <!-- Campo escondido com o id; preenchido pelo JavaScript do painel. -->
            <input type="hidden" name="id" id="editarUsuarioId">

            <!-- required faz o navegador exigir o preenchimento antes de enviar. -->
            <input type="text" name="nome" id="editarNome" required>
            <input type="email" name="email" id="editarEmail" required>
            <input type="password" name="senha" id="editarSenha" required>

            <p>
                <button type="submit"> Salvar </button>
    
                <!-- type="button" só fecha o modal, sem enviar o formulário. -->
                <button type="button" onclick="fecharModalUsuario()">Cancelar</button>
            </p>

        </form>

    </div>

</div>

</center>
