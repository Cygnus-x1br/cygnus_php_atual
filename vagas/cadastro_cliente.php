<?php
session_start();
require_once('./_conexao/conexao.php');
require_once('../php/dbFunctions.php');
require_once('../php/post_data.php');

if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
?>

<?php

if (isset($_POST['nomeCliente'])) {
    $insere_cliente = cadastraCliente($_POST);
    $query_send = mysqli_query($conect, $insere_cliente);
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
        <h2>Cadastro de Clientes</h2>
    </header>
    <main>
        <div id="formulario">
            <form action="cadastro_cliente.php" method="POST">
                <input type="text" name="nomeCliente" placeholder="Razão Social">
                <input type="text" name="endereco" placeholder="Endereço">
                <input type="text" name="bairro" placeholder="Bairro">
                <select name="cidade" id="">
                    <?php
                    $query_send_cid = consultaCidade($conect, $cod_estado);
                    while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                    ?>
                        <option value="<?php echo $show_cidade['IDCIDADE'] ?>"><?php echo $show_cidade['nomeCidade'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="text" class="cnpj" name="CNPJ" placeholder="CNPJ">
                <input type="text" name="contato" placeholder="Contato">
                <input type="text" name="email" placeholder="E-Mail">
                <input type="text" class='tel' name="telefone" placeholder="Telefone">
                <input type="submit" value="Adicionar cliente">
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