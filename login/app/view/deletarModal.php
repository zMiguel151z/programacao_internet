



<div id="modalConfirmar" class="modal-fundo">
    <div class="modal-caixa">
        <p>Deseja mesmo deletar a conta?<br>Esta ação é irreversível.</p>

        <form action="index.php?action=deletarUsuario" method="POST">
            <input type="hidden" name="id" value="<?= (int) $_SESSION['id_usuario'] ?>">
            <button type="submit">Sim</button>
            <button type="button" onclick="fecharConfirmacao()">Não</button>
        </form>
    </div>
</div>