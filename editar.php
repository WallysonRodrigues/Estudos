<?php
// inicia uma sessao
session_start();

include "banco.php";
include "ajudantes.php";

$exibir_tabela = false;

// se a variavel super global estiver na memoria e se tiver um valor diferente de nulo
if (isset($_GET['nome']) && $_GET['nome'] != '') {
    // cria um arra pra guarda os registros
    $tarefa = array();


    $tarefa['id'] = $_GET['id'];

    $tarefa['nome'] = $_GET['nome'];


    if (isset($_GET['descricao'])) {
        $tarefa['descricao'] = $_GET['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }

    if (isset($_GET['prazo'])) {
        $tarefa['prazo'] = data_gravacao($_GET['prazo']);
    } else {
        $tarefa['prazo'] = '';
    }

    if (isset($_GET['prioridade'])) {
        $tarefa['prioridade'] = $_GET['prioridade'];
    } else {
        $tarefa['prioridade'] = '';
    }

    if (isset($_GET['concluida'])) {
        $tarefa['concluida'] = 1;
    } else {
        $tarefa['concluida'] = 0;
    }

    editar_tarefa($conexao, $tarefa);
    header('Location: tarefas.php');
    die();
}

$tarefa = buscar_tarefa($conexao, $_GET['id']);

include "template.php";
?>