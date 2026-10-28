
<!--
  deletarModal.php — Modal de confirmação para apagar a conta.
  Fica escondido e é exibido pelo botão "Deletar conta" do painel.
-->

<div id="modalConfirmar" class="modal-fundo">
    <div class="modal-caixa">
        <p>Deseja mesmo deletar a conta?<br>Esta ação é irreversível.</p>

        <!-- Envia o id via POST para a action deletarUsuario. -->
        <form action="index.php?action=deletarUsuario" method="POST">
            <!--
              Campo escondido com o id do usuário logado.
              (int) converte para inteiro, evitando valor estranho no HTML.
            -->
            <input type="hidden" name="id" value="<?= (int) $_SESSION['id_usuario'] ?>">
            <button type="submit">Sim</button>

            <!-- type="button" só fecha o modal (não apaga nada). -->
            <button type="button" onclick="fecharConfirmacao()">Não</button>
        </form>
    </div>
</div>
