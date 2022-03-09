<?php

require_once('./_conexao/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php
include('./head.php');
?>
<title>Cygnus Recursos Humanos * Portal de empregos e serviços</title>
<link rel="stylesheet" href="./css/form_cadastro.css">
</head>
<?php
include('./menu.php');
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

<div class="container">



    <form class="form_cadastro" action="./cadastro_candidato.php" method="POST">
        <h1>Cadastre-se</h1>
        <div class="form_1">

            <label for="">Nome</label>
            <input type="text" name="nome">
        </div>
        <div class="form_1">

            <label for="">E-mail</label>
            <input type="text" name="email">
        </div>
        <div class="form_2">
            <div class="form_1">
                <label for="">Telefone</label>
                <input type="text" name="telefone">
            </div>
            <div class="form_1">
                <label for="">CPF</label>
                <input type="text" name="CPF">
            </div>
        </div>
        <div class="form_1">
            <label for="">Endereço</label>
            <input type="text" name="endereco">
        </div>
        <div class="form_2">
            <div class="form_1">

                <label for="">Cidade</label>
                <select name="cidade" id="">
                    <?php
                    while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                    ?>
                        <option value="<?php echo $show_cidade['IDCIDADE'] ?>"><?php echo $show_cidade['nomeCidade'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form_1">
            <label for="">Função desejada</label>
        </div>
        <div class="form_1">
            <input type="text" name="funcao">
            <label for="">Anexe seu Curriculo</label>
        </div>
    </form>





    <?php
    include('./aside.php');
    ?>

</div>







<?php

include('./bottom.php');

?>

</html>