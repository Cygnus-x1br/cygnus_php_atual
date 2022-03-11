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
$consulta_estado = 'SELECT * FROM tb_estado';
$query_send_est = mysqli_query($conect, $consulta_estado);
if (!$query_send_est) {
    die('Falha na conexão');
}
?>
<?php
$consulta_cidade = 'SELECT * FROM tb_cidade ORDER BY nomeCidade';
$query_send_cid = mysqli_query($conect, $consulta_cidade);
if (!$query_send_cid) {
    die('Falha na conexão');
}

if (isset($_POST['nome'])) {
    if (!empty($_POST['nome'])) {
        $nomeCandidato = $_POST['nome'];
    } else {
        die('Campo obrigatório');
    }
    $CPF = $_POST['CPF'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $funcao = $_POST['funcao'];
    $curriculo = $_FILES['curriculo'];

    $curr_temp = $curriculo['tmp_name'];
    $diretorio_curriculo = './curriculos';

    move_uploaded_file($curr_temp, $diretorio_curriculo . "/" . $nomeCandidato . "." . strrchr($curriculo['name'], '.'));

    print_r($nomeCandidato, $CPF, $email, $telefone, $endereco, $estado, $cidade, $funcao, $curriculo);


    // $query_send = mysqli_query($conect, $insere_cliente);
}
?>

<div class="container">



    <form class="form_cadastro" action="./cadastro_candidato.php" method="POST" enctype="multipart/form-data">
        <h1>Cadastre-se</h1>
        <div class="col_1">

            <label for="">Nome</label>
            <input type="text" name="nome" autofocus>
            <label for="">CPF</label>
            <input type="text" name="CPF">
            <label for="">E-mail</label>
            <input type="text" name="email">
            <label for="">Telefone</label>
            <input type="text" name="telefone">
            <label for="">Endereço</label>
            <input type="text" name="endereco">
            <div class="col_2">
                <div class="col_1">
                    <label for="">Estado</label>
                    <select name="cidade" id="">
                        <?php
                        while ($show_estado = mysqli_fetch_assoc($query_send_est)) {
                        ?>
                            <option value="<?php echo $show_estado['IDESTADO'] ?>"><?php echo $show_estado['siglaEstado'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col_1">
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
            <label for="">Função desejada</label>
            <input type="text" name="funcao">
            <label for="">Anexe seu Curriculo</label>
            <input type="file" name="curriculo" id="">
            <input type="submit" value="Gravar dados">
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