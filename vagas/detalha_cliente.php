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
if (isset($_GET['cliente'])) {
    $cod_cliente = $_GET['cliente'];
    $edit = $_GET['edit'];

    $consulta_cliente = "SELECT * FROM tb_cliente WHERE IDCLIENTE= $cod_cliente";
    $query_send = mysqli_query($conect, $consulta_cliente);
    $detalha_cliente = mysqli_fetch_assoc($query_send);

    $nomeCliente = $detalha_cliente['nomeCliente'];
    $endereco = $detalha_cliente['endereco'];
    $bairro = $detalha_cliente['bairro'];
    $CNPJ = $detalha_cliente['CNPJ'];
    $contato = $detalha_cliente['contato'];
    $email = $detalha_cliente['email'];
    $telefone = $detalha_cliente['telefone'];
    $cidade = $detalha_cliente['ID_CIDADE'];
    $IDCLIENTE = $detalha_cliente['IDCLIENTE'];
}

if (isset($_POST['nomeCliente'])) {

    if (!empty($_POST['nomeCliente'])) {
        $nomeCliente = $_POST['nomeCliente'];
    } else {
        die('Digite o Nome do Cliente');
    }
    $cod_cliente = $_POST['id_cliente'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $CNPJ = $_POST['CNPJ'];
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cidade = $_POST['cidade'];

    $altera_cliente = "UPDATE tb_cliente ";
    $altera_cliente .= " SET nomeCliente='$nomeCliente', endereco='$endereco', bairro='$bairro', CNPJ='$CNPJ', contato='$contato', email='$email', telefone='$telefone', ID_CIDADE=$cidade ";
    $altera_cliente .= " WHERE IDCLIENTE = $cod_cliente";
    $query_send = mysqli_query($conect, $altera_cliente);
    header("location:listagem_cliente.php");
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
        <h2>Cadastro de cliente</h2>
    </header>
    <main>
        <div id="formulario">
            <form action="detalha_cliente.php" method="POST">
                <input type="text" name="nomeCliente" placeholder="Razão Social" value="<?php echo $nomeCliente ?>" <?php echo $edit ?>>
                <input type="text" name="endereco" placeholder="Endereço" value="<?php echo $endereco ?>" <?php echo $edit ?>>
                <input type="text" name="bairro" placeholder="Bairro" value="<?php echo $bairro ?>" <?php echo $edit ?>>
                <select name="cidade" id="" <?php echo $edit ?>>
                    <?php
                    $query_send_cid = consultaCidade($conect);
                    while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                    ?>
                        <option value="<?php echo $show_cidade['IDCIDADE'] ?>" <?php if ($cidade == $show_cidade['IDCIDADE']) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $show_cidade['nomeCidade'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="text" class="cnpj" name="CNPJ" placeholder="CNPJ" value="<?php echo $CNPJ ?>" <?php echo $edit ?>>
                <input type="text" name="contato" placeholder="Contato" value="<?php echo $contato ?>" <?php echo $edit ?>>
                <input type="text" name="email" placeholder="E-Mail" value="<?php echo $email ?>" <?php echo $edit ?>>
                <input type="text" class="tel" name="telefone" placeholder="Telefone" value="<?php echo $telefone ?>" <?php echo $edit ?>>
                <div class="btn">
                    <?php
                    echo "<a href='./detalha_cliente.php?cliente=$IDCLIENTE &edit= '>Editar</a>";
                    ?>
                </div>
                <input type="text" name='id_cliente' value='<?php echo $IDCLIENTE ?>' hidden>
                <input type="submit" value="Alterar cliente">
            </form>
        </div>
    </main>
    <div class="opcoes">
        <div class="btn_small">
            <a href="./listagem_cliente.php">Voltar a Lista</a>
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