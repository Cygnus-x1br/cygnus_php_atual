<?php

function cadastraCliente($POST)
{
    if (!empty($_POST['nomeCliente'])) {
        $nomeCliente = $_POST['nomeCliente'];
    } else {
        die('Digite o Nome do Cliente');
    }
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $CNPJ = $_POST['CNPJ'];
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $insere_cliente = "INSERT INTO tb_cliente ";
    $insere_cliente .= "VALUES(null, '$nomeCliente', '$endereco', '$bairro', '$CNPJ', '$contato', '$email', '$telefone', $cidade)";

    return $insere_cliente;
}


function cadastraVaga($POST, $user, $conect)
{
    if (!empty($_POST['funcao'])) {
        $funcao = $_POST['funcao'];
    } else {
        die("<h1>Digite a função da vaga</h1>");
    }
    if (!empty($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
    } else {
        die("<h1>Selecione o tipo de vaga</h1>");
    }
    if (!empty($_POST['cidade'])) {
        $cidade = $_POST['cidade'];
    } else {
        die("<h1>Digite o local de trabalho</h1>");
    }
    $escolaridade = $_POST['escolaridade'];
    $horario = $_POST['horario'];
    $salario = $_POST['salario'];
    $beneficios = $_POST['beneficios'];
    $descricao = $_POST['descricao'];
    if (!empty($_POST['cliente'])) {
        $cliente = $_POST['cliente'];
    } else {
        die('Selecione ou cadastre o Cliente');
    }
    if ($_POST['destaque'] == 'S') {
        $destaque = 'S';
    } else {
        $destaque = '';
    };

    $insere_vaga = "INSERT INTO tb_vaga ";
    $insere_vaga .= "VALUES(null, '$funcao', '$tipo', '$cidade', '$escolaridade', '$horario', '$beneficios', '$descricao', $cliente, now(),'A', null, '$destaque', $salario, $user, $cidade)";
    return $insere_vaga;
}

function atualizaCliente($POST)
{
}
