<?php
session_start();
require_once('./_conexao/conexao.php');
if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
?>

<?php
$consulta_cidade = 'SELECT * FROM tb_cidade ORDER BY nomeCidade';
$query_send_cid = mysqli_query($conect, $consulta_cidade);
if (!$query_send_cid) {
    die('Falha na conexão');
}

if (isset($_POST['nomeCliente'])) {
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