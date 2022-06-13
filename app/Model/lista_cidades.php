<?php

require_once('../_conexao/conexao.php');
require_once('./dbFunctions.php');


if (isset($_GET['selEstadoId'])) {
    $cod_estado = $_GET['selEstadoId'];
} else {
    $cod_estado = 26;
}

$query_send_cid = consultaCidade($conect, $cod_estado);
$retorno = array();
while ($linha = mysqli_fetch_object($query_send_cid)) {
    $retorno[] = $linha;
}

echo json_encode($retorno);

mysqli_close($conect);
