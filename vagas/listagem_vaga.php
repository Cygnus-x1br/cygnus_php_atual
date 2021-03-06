<?php
session_start();
require_once('./_conexao/conexao.php');
if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
?>

<?php

$lista_vaga = "SELECT * FROM tb_vaga ";
$query_send = mysqli_query($conect, $lista_vaga);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/lista.css">
</head>

<body>
    <header>
        <h2>Listagem de vagas</h2>
    </header>
    <main>

        <div id="lista">
            <div class="listagem">
                <ul>
                    <li>Função</li>
                    <li>Tipo</li>
                    <li>Local de Trabalho</li>
                    <li>Status</li>
                    <li>Data Inclusão</li>
                    <li></li>
                </ul>
                <?php
                while ($linha = mysqli_fetch_assoc($query_send)) {
                ?>
                    <ul>
                        <li><?php echo $linha['funcao'] ?></li>
                        <li><?php if ($linha['tipo'] == 'E') {
                                echo 'Efetiva';
                            } elseif ($linha['tipo'] == 'T') {
                                echo 'Temporária';
                            } ?></li>
                        <li><?php
                            $cidade = $linha['ID_CIDADE'];
                            $consulta_cidade = "SELECT * FROM tb_cidade WHERE IDCIDADE = $cidade";
                            $query_send_cid = mysqli_query($conect, $consulta_cidade);
                            if (!$query_send_cid) {
                                die('Falha na conexão');
                            }
                            $localTrab = mysqli_fetch_assoc($query_send_cid);
                            echo $localTrab['nomeCidade'];
                            ?>
                        </li>
                        <li><?php if ($linha['fechamento'] == 'A') {
                                echo 'Aberta';
                            } elseif ($linha['fechamento'] == 'P') {
                                echo 'Preenchida';
                            } elseif ($linha['fechamento'] == 'C') {
                                echo 'Cancelada';
                            } elseif ($linha['fechamento'] == 'F') {
                                echo 'Fechada';
                            }
                            ?></li>
                        <li><?php echo $linha['dataCriacao']; ?></li>
                        <li><a href="./detalha_vaga.php?vaga=<?php echo $linha['IDVAGA'] ?>&edit=disabled">Detalhes</a></li>
                    </ul>
                <?php
                }
                ?>
            </div>
            <div class="opcoes">
                <div class="btn">
                    <a href="./index.php">Voltar ao Inicio</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>