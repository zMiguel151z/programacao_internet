
<?php $tarefas = $tarefas ?? []; ?>

<div class="painel_lista">
    <div class="head_lista">
        <h1>TO-DO List (MVC)</h1>

        <form action="index.php?action=criar" method="POST">
            <input type="text" name="descricao" placeholder="Descrição da tarefa">
            <button type="submit">Adicionar</button>
        </form>
    </div>
    
     <h2>Suas tarefas</h2>
     <?php if(!empty($tarefas)): ?>
            <ul id="lista">
                <?php foreach($tarefas as $tarefa): ?>
                    <li class="tarefas" id="tarefa-<?php echo (int)$tarefa['id']; ?>">
                        <span><?php echo htmlspecialchars($tarefa['descricao']); ?></span>
            
                        <a href="index.php?action=excluir&id=<?php echo (int)$tarefa['id']; ?>">Excluir</a>
            
                        <button onclick='abrirModal(<?php echo (int)$tarefa["id"]; ?>, <?php echo json_encode($tarefa["descricao"]); ?>)'>
                            Editar
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
    
    
     <?php else: ?>    
         <p>Não há tarefas ainda!</p>
         <?php endif; ?>    
         <?php include __DIR__ . '/../view/modalEditar.php'; ?>    
         
    
    <script>
         
        function abrirModal(id, descricao){
            document.getElementById("editarId").value = id
            document.getElementById("editarDescricao").value = descricao
            document.getElementById("modalEditar").style.display = "block"; 
        }

        function fecharModal(){
            document.getElementById("modalEditar").style.display = "none";
        }

        
       
    </script>
    
</div>