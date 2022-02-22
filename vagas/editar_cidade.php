<?php
session_start();
require_once('./_conexao/conexao.php');

if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
?>

<?php
$consulta_estado = 'SELECT * FROM tb_estado ORDER BY nomeEstado';
$query_send_est = mysqli_query($conect, $consulta_estado);
if (!$query_send_est) {
    die('Falha na conexão');
}

$consulta_cliente = "SELECT * FROM tb_cidade WHERE IDCIDADE= $cod_cidade";
$query_send = mysqli_query($conect, $consulta_cliente);
$detalha_cliente = mysqli_fetch_assoc($query_send);

if (isset($_POST['nomeCidade'])) {
    if (!empty($_POST['nomeCidade'])) {
        $nomeCidade = $_POST['nomeCidade'];
    } else {
        die('Digite o Nome da Cidade');
    }

    $estado = $_POST['estado'];

    $insere_cidade = "UPDATE tb_cidade ";
    $insere_cidade .= "SET nomeCidade='$nomeCidade' WHERE IDCIDADE = 2";
    $query_send = mysqli_query($conect, $insere_cidade);
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
    <style>
        <?php

        ?>
    </style>
</head>

<body>
    <header>

        <h2>Cadastro de Cidades</h2>
    </header>
    <main>

        <div id="formulario">

            <form action="cadastro_cidade.php" method="POST">

                <input type="text" name="nomeCidade" placeholder="Nome da Cidade">
                <select name="estado" id="">
                    <?php
                    while ($show_estado = mysqli_fetch_assoc($query_send_est)) {
                    ?>
                        <option value="<?php echo $show_estado['IDESTADO'] ?>"><?php echo $show_estado['nomeEstado'] ?></option>
                    <?php
                    }
                    ?>
                </select>

                <input type="submit" value="Adicionar Cidade">
            </form>
        </div>

    </main>
    <div class="opcoes">

        <div class="btn">
            <a href="./index.php">Voltar ao Inicio</a>
        </div>
    </div>

</body>

</html>