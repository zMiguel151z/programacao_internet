<?php

require_once __DIR__ . "/../models/Tarefas.php";

class TarefaController{
    private Tarefas $tarefaModel;


    public function __construct(){
       $this->tarefaModel = new Tarefas();
    }

    public function index(){
        $tarefas = $this->tarefaModel->listar();
        include __DIR__ . "/../view/listar.php";
    }

    public function criar(){
        if(isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            $this->tarefaModel->criar($_POST['descricao']);
        }
        header("location: index.php");
    }

    public function deletar(){
        if(isset($_GET['id'])){
            $this->tarefaModel->deletar($_GET['id']);
        }
        header("location: index.php");
    }

    public function atualizar(){
         if(isset($_POST['id']) && isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            $this->tarefaModel->atualizar($_POST['descricao'],$_POST['id']);
         }
         header("location: index.php");
    }

}