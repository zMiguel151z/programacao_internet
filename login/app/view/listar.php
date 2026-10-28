
<!--
  listar.php — View que mostra as tarefas do usuário.
  Recebe a variável $tarefas do TarefaController (um array de tarefas).
-->

<?php $tarefas = $tarefas ?? []; ?>

<div class="painel_lista">
    <div class="head_lista">
        <h1>TO-DO List</h1>

        <!-- Formulário que envia a nova tarefa via POST para criarTarefa. -->
        <form id="descricao" action="index.php?action=criarTarefa" method="POST">
            <input  type="text" name="descricao" placeholder="Descrição da tarefa">
            <button type="submit">Adicionar</button>
        </form>
    </div>
    
     <h2>Suas tarefas</h2>
     <!-- Se o array de tarefas NÃO está vazio, mostramos a lista. -->
     <?php if(!empty($tarefas)): ?>
            <ul id="lista">
                <!-- foreach percorre cada tarefa do array, uma por vez. -->
                <?php foreach($tarefas as $tarefa): ?>
                    <!-- (int) garante id numérico no atributo id do <li>. -->
                    <li class="tarefas" id="tarefa-<?php echo (int)$tarefa['id']; ?>">
                        <!-- htmlspecialchars() evita que a descrição vire HTML. -->
                        <span><?php echo htmlspecialchars($tarefa['descricao']); ?></span>
            
                        <!-- Link de exclusão: manda o id da tarefa pela URL. -->
                        <a href="index.php?action=excluirTarefa&id=<?php echo (int)$tarefa['id']; ?>">Excluir</a>
            
                        <!--
                          onclick chama abrirModal(id, descricao).
                          json_encode() gera a descrição como string JS segura
                          (com aspas e escapes), evitando quebrar o código.
                        -->
                        <button onclick='abrirModal(
                          <?php echo (int)$tarefa["id"]; ?>,
                          <?php echo json_encode($tarefa["descricao"]); ?>)
                        '>
                            Editar
                        </button>
                    </li>
                <!-- endforeach fecha o laço aberto no foreach. -->
                <?php endforeach; ?>
            </ul>
    
    
     <?php else: ?>    
         <!-- Se o array está vazio, mostramos esta mensagem. -->
         <p>Não há tarefas ainda!</p>
         <!-- endif fecha o if/else iniciado acima. -->
         <?php endif; ?>    
         <!-- Inclui o HTML do modal de edição de tarefa. -->
         <?php include __DIR__ . '/../view/modalEditar.php'; ?>    
         
    
    <script>
         
        /**
         * Abre o modal de edição de tarefa e preenche os campos.
         * @param {number} id id da tarefa
         * @param {string} descricao texto atual da tarefa
         */
        function abrirModal(id, descricao){
            // .value coloca o valor dentro do campo do formulário.
            document.getElementById("editarId").value = id
            document.getElementById("editarDescricao").value = descricao

            // display = "block" mostra o modal.
            document.getElementById("modalEditar").style.display = "block"; 
        }

        /**
         * Esconde o modal de edição.
         */
        function fecharModal(){
            document.getElementById("modalEditar").style.display = "none";
        }

        
       
    </script>
    
</div>
