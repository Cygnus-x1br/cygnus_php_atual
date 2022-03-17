<?php

function dadosVagasDestaque($conect)
{
    $query_vagas = "SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque FROM tb_vaga ";
    $query_vagas .= " INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO WHERE destaque='S' AND fechamento='A' ";
    $query_vagas .= " ORDER BY dataCriacao DESC";
    $lista_vagas = mysqli_query($conect, $query_vagas);

    if (!$lista_vagas) {
        die('Falha na conexao');
    }

    return $lista_vagas;
}

function dadosVagasAbertas($conect)
{
    $query_vagas = "SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque, dataCriacao, DATE_ADD(dataCriacao, INTERVAL 30 DAY) as dataValidade FROM tb_vaga ";
    $query_vagas .= " INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO WHERE fechamento='A' ORDER BY funcao";
    $lista_vagas = mysqli_query($conect, $query_vagas);
    // var_dump($lista_vagas);
    if (!$lista_vagas) {
        die('Falha na conexao');
    }

    return $lista_vagas;
}

function consultaEstado($conect)
{
    $consulta_estado = 'SELECT * FROM tb_estado ORDER BY siglaEstado';
    $query_send_est = mysqli_query($conect, $consulta_estado);
    if (!$query_send_est) {
        die('Falha na conexão');
    }
    return $query_send_est;
}

function consultaCidade($conect)
{
    $consulta_cidade = "SELECT * FROM tb_cidade ORDER BY nomeCidade";
    $query_send_cid = mysqli_query($conect, $consulta_cidade);
    if (!$query_send_cid) {
        die('Falha na conexão');
    }
    return $query_send_cid;
}

function consultaCliente($conect)
{
    $consulta_cliente = 'SELECT * FROM tb_cliente ORDER BY nomeCliente';
    $query_send_cli = mysqli_query($conect, $consulta_cliente);
    if (!$query_send_cli) {
        die('Falha na conexão');
    }
    return $query_send_cli;
}
