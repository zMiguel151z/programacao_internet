
<!--
  modalEditar.php — Modal (janela) para editar a descrição de uma tarefa.
  Fica escondido por padrão e é exibido pelo JavaScript de listar.php.
-->

<center>

<div id="modalEditar" class="modal">

    <div class="modal-conteudo">

        <h2>Editar tarefa</h2>

        <!-- Envia os dados via POST para a action editarTarefa. -->
        <form action="index.php?action=editarTarefa" method="POST">

            <!--
              Campo escondido: guarda o id da tarefa que está sendo editada.
              O JavaScript preenche esse valor ao abrir o modal.
            -->
            <input type="hidden" name="id" id="editarId">

            <!-- Campo de texto com a descrição; também é preenchido via JS. -->
            <input type="text" name="descricao" id="editarDescricao">

            <button type="submit"> Salvar </button>

            <!-- type="button" não envia o formulário; só chama fecharModal(). -->
            <button type="button" onclick="fecharModal()">Cancelar</button>

        </form>

    </div>

</div>

</center>
