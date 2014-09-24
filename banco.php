<?php
// setando os dados do login da conexao
$bdServidor = '127.0.0.1';
$bdUsuario = 'wallrodrigues';
$bdSenha = 'twkanno';
$bdBanco = 'tarefas';

// variavel com a string de conexao
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

// se nao der erro na conexao a base de daso
if (mysqli_connect_errno($conexao)) {
    echo "Problemas para conectar ao banco de dados. Verifique os dados!";
    die();
}

function buscar_tarefas($conexao) {
    // monta a sql de busca
    $sqlBusca = 'select * from tarefas';

    // executa a query no banco de dados
    $resultado = mysqli_query($conexao, $sqlBusca);

    // cria um array para o retorno da funcao
    $tarefas = array();

    // enquanto nao processar todas as linhas de retorno da funcao
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        // vai associando ao array as linhas retornadas
        $tarefas[] =$tarefa;
    }

    // retorna as strings do array
    return $tarefas;
}

function gravar_tarefa($conexao, $tarefa) {
    $sqlGravar = "Insert into tarefas (nome, descricao, prioridade, prazo, concluida) values ('{$tarefa['nome']}','{$tarefa['descricao']}',{$tarefa['prioridade']},'{$tarefa['prazo']}',{$tarefa['concluida']})";

    return mysqli_query($conexao, $sqlGravar);
}

function buscar_tarefa($conexao, $id){
    $query = "select * from tarefas where id = {$id}";

    $result = mysqli_query($conexao, $query);

    return mysqli_fetch_assoc($result);
}

function editar_tarefa($conexao, $tarefa) {
    $update = "
        update tarefas set
            nome = '{$tarefa['nome']}',
            descricao = '{$tarefa['descricao']}',
            prioridade = {$tarefa['prioridade']},
            prazo = '{$tarefa['prazo']}',
            concluida = {$tarefa['concluida']}
        where id = {$tarefa['id']}
        ";

    mysqli_query($conexao, $update);
}

function remover_tarefa($conexao, $id) {
    $delete = "delete from tarefas where id = {$id}";

    if (mysqli_query($conexao, $delete) == false ) {
        echo "deu ruim";
    };
}
?>