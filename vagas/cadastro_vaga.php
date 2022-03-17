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

if (isset($_POST['funcao'])) {
    $user = $_SESSION["cygnus_login"];
    $insere_vaga = cadastraVaga($POST, $user, $conect);
    $query_send = mysqli_query($conect, $insere_vaga);
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
            <form action="cadastro_vaga.php" method="POST">
                <input type="text" name="funcao" placeholder="Função">
                <div class="radio">
                    <input type="radio" name="tipo" id='efetivo' value='E'>
                    <label for="efetivo">Efetiva</label>
                    <input type="radio" name="tipo" id='temporario' value='T'>
                    <label for="temporario">Temporária</label>
                </div>
                <select name="cidade" id="">
                    <?php
                    $query_send_cid = consultaCidade($conect);
                    while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                    ?>
                        <option value="<?php echo $show_cidade['IDCIDADE'] ?>"><?php echo $show_cidade['nomeCidade'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="text" name="escolaridade" placeholder="Escolaridade">
                <input type="text" name="horario" placeholder="Horário de trabalho">
                <input type="text" class="valor" name="salario" placeholder="Salário">
                <input type="text" name="beneficios" placeholder="Beneficios">
                <textarea name="descricao" placeholder="Descrição atividades" id=""></textarea>
                <select name="cliente" id="">
                    <?php
                    $query_send_cli = consultaCliente($conect);
                    while ($show_cliente = mysqli_fetch_assoc($query_send_cli)) {
                    ?>
                        <option value="<?php echo $show_cliente['IDCLIENTE'] ?>"><?php echo $show_cliente['nomeCliente'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="check">
                    <label for="destaque">Vaga em destaque</label>
                    <input type="checkbox" name="destaque" id="destaque" value="S">
                </div>
                <div class="btn">
                    <a href="./cadastro_cliente.php">Cadastro Cliente</a>
                </div>
                <input type="submit" value="Adicionar vaga">
            </form>
        </div>
    </main>
    <div class="opcoes">
        <div class="btn">
            <a href="./index.php">Voltar ao Inicio</a>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
    <script src="../js/comon_jquery.js"></script>

</body>

</html>