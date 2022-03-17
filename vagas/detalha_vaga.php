<?php
session_start();
require_once('./_conexao/conexao.php');
require_once('../php/dbFunctions.php');
require_once('../php/post_data.php');

if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
$user = $_SESSION["cygnus_login"];
?>

<?php

if (isset($_GET['vaga'])) {
    $cod_vaga = $_GET['vaga'];
    $edit = $_GET['edit'];

    $consulta_vaga = "SELECT * FROM tb_vaga ";
    $consulta_vaga .= " WHERE IDVAGA= $cod_vaga";
    $query_send = mysqli_query($conect, $consulta_vaga);
    $detalha_vaga = mysqli_fetch_assoc($query_send);

    $funcao = $detalha_vaga['funcao'];
    $tipo = $detalha_vaga['tipo'];
    $cidade = $detalha_vaga['ID_CIDADE'];
    $escolaridade = $detalha_vaga['escolaridade'];
    $horario = $detalha_vaga['horario'];
    $salario = $detalha_vaga['salario'];
    $beneficios = $detalha_vaga['beneficios'];
    $descricao = $detalha_vaga['descricao'];
    $cliente = $detalha_vaga['ID_CLIENTE'];
    $IDVAGA = $detalha_vaga['IDVAGA'];
    $destaque = $detalha_vaga['destaque'];
    $fechamento = $detalha_vaga['fechamento'];
}

if (isset($_POST['funcao'])) {
    $codigo_vaga = $_POST['id_vaga'];
    if (!empty($_POST['funcao'])) {
        $funcao = $_POST['funcao'];
    } else {
        die('Digite a função da vaga');
    }
    if (!empty($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
    } else {
        die('Selecione o tipo de vaga');
    }
    if (!empty($_POST['cidade'])) {
        $cidade = $_POST['cidade'];
    } else {
        die('Digite o local de trabalho');
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

    if (empty($_POST['destaque'])) {
        $destaque = '';
    } elseif ($_POST['destaque'] == 'S') {
        $destaque = 'S';
    };

    if (!empty($_POST['fechamento'])) {
        $fechamento = $_POST['fechamento'];
    } else {
        die('Selecione o status da vaga');
    }

    $altera_vaga = "UPDATE tb_vaga ";
    $altera_vaga .= " SET funcao='$funcao', tipo='$tipo', escolaridade='$escolaridade', horario='$horario', beneficios='$beneficios', descricao='$descricao', ID_CLIENTE=$cliente, fechamento='$fechamento', dataAlteracao=now(), destaque='$destaque', ID_USUARIO=$user , salario=$salario, ID_CIDADE=$cidade";
    $altera_vaga .= " WHERE IDVAGA = $codigo_vaga";
    $query_send = mysqli_query($conect, $altera_vaga);
    header("location:listagem_vaga.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h2>Cadastro de vagas</h2>
    </header>
    <main>
        <div id="formulario">
            <form action="detalha_vaga.php" method="POST">
                <input type="text" name="funcao" placeholder="Função" value="<?php echo $funcao ?>" <?php echo $edit ?>>
                <div class="radio">
                    <?php
                    $e = '';
                    $t = '';
                    if ($tipo == 'E') {
                        $e = 'checked';
                    } elseif ($tipo == 'T') {
                        $t = 'checked';
                    }
                    ?>
                    <input type='radio' name='tipo' id='efetivo' value='E' <?php echo $e ?> <?php echo $edit ?>>
                    <label for='efetivo'>Efetiva</label>
                    <input type='radio' name='tipo' id='temporario' value='T' <?php echo $t ?> <?php echo $edit ?>>
                    <label for='temporario'>Temporária</label>
                </div>
                <select name="cidade" id="" <?php echo $edit ?>>
                    <?php
                    $query_send_cid = consultaCidade($conect, $cod_estado);
                    while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                    ?>
                        <option value="<?php echo $show_cidade['IDCIDADE'] ?>" <?php if ($cidade == $show_cidade['IDCIDADE']) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $show_cidade['nomeCidade']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="text" name="escolaridade" placeholder="Escolaridade" value="<?php echo $escolaridade ?>" <?php echo $edit ?>>
                <input type="text" name="horario" placeholder="Horário de trabalho" value="<?php echo $horario ?>" <?php echo $edit ?>>
                <input type="text" name="salario" class="valor" placeholder="Salário" value="<?php echo $salario ?>" <?php echo $edit ?>>
                <input type="text" name="beneficios" placeholder="Beneficios" value="<?php echo $beneficios ?>" <?php echo $edit ?>>
                <textarea name="descricao" placeholder="Descrição atividades" id="" <?php echo $edit ?>><?php echo $descricao ?></textarea>
                <select name="cliente" id="" <?php echo $edit ?>>
                    <?php
                    $query_send_cli = consultaCliente($conect);
                    while ($show_cliente = mysqli_fetch_assoc($query_send_cli)) {
                    ?>
                        <option value="<?php echo $show_cliente['IDCLIENTE'] ?>" <?php if ($cliente == $show_cliente['IDCLIENTE']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo $show_cliente['nomeCliente'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="btn">
                    <a href="./cadastro_cliente.php">Cadastro Cliente</a>
                </div>
                <div class="check">
                    <?php
                    if ($destaque == 'S') {
                        $check = 'checked';
                    } else {
                        $check = '';
                    }
                    ?>
                    <label for="destaque">Vaga em destaque</label>
                    <input type="checkbox" name="destaque" id="destaque" value="S" <?php echo $check; ?> <?php echo $edit ?>>
                </div>
                <div class="radio">
                    <?php
                    $a = '';
                    $p = '';
                    $c = '';
                    $f = '';
                    if ($fechamento == 'A') {
                        $a = 'checked';
                    } elseif ($fechamento == 'P') {
                        $p = 'checked';
                    } elseif ($fechamento == 'C') {
                        $c = 'checked';
                    } elseif ($fechamento == 'F') {
                        $f = 'checked';
                    }
                    ?>
                    <input type="radio" name="fechamento" id="aberta" value='A' <?php echo $a ?> <?php echo $edit ?>>
                    <label for="aberta">Aberta</label>
                    <input type="radio" name="fechamento" id="preenchida" value='P' <?php echo $p ?> <?php echo $edit ?>>
                    <label for="preenchida">Preenchida</label>
                    <input type="radio" name="fechamento" id="cancelada" value='C' <?php echo $c ?> <?php echo $edit ?>>
                    <label for="cancelada">Cancelada</label>
                    <input type="radio" name="fechamento" id="aberta" value='F' <?php echo $f ?> <?php echo $edit ?>>
                    <label for="fechada">Fechada</label>
                </div>
                <div class="btn">
                    <?php
                    echo "<a href='./detalha_vaga.php?vaga=$IDVAGA &edit= '>Editar</a>";
                    ?>
                </div>
                <input type="text" name='id_vaga' value='<?php echo $IDVAGA ?>' hidden>
                <input type="submit" value="Alterar vaga" <?php echo $edit ?>>
            </form>

        </div>
    </main>
    <div class="opcoes">
        <div class="btn_small">
            <a href="./listagem_vaga.php">Voltar a Lista</a>
        </div>
        <div class="btn_small">
            <a href="./index.php">Voltar ao Inicio</a>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/comon_jquery.js"></script>

</body>

</html>