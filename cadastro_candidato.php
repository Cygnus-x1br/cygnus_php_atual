<?php
require_once('./_conexao/conexao.php');
require_once('./php/dbFunctions.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
include('./include/head.php');
?>

<title>Cygnus Recursos Humanos * Portal de empregos e serviços</title>
<link rel="stylesheet" href="./css/form_cadastro.css">

<script>
    function goBack() {
        window.history.back();
    }
</script>

</head>
<?php
include('./include/menu.php');
?>

<?php

$mensagem = "<div class='container'><section class='conteudo'><h1>CPF já cadastrado</h1><button onclick='goBack()'>Voltar</button></section></div>";


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

    if ($curriculo['error'] === 0) {
        $curr_temp = $curriculo['tmp_name'];
        $diretorio_curriculo = './curriculos';
        $arquivo_final = $diretorio_curriculo . "/" . $nomeCandidato . strrchr($curriculo['name'], '.');
        move_uploaded_file($curr_temp, $arquivo_final);
    } else {
        $arquivo_final = '';
    }

    $consulta_candidato = "SELECT CPF FROM tb_candidato WHERE CPF = '$CPF'";
    $query_send_cpf = mysqli_query($conect, $consulta_candidato);
    if (mysqli_fetch_assoc($query_send_cpf)) {
        die($mensagem);
    }

    $insere_candidato = "INSERT INTO tb_candidato (nomeCandidato, email, telefone, CPF, endereco, ID_CIDADE, funcao, curriculo) ";
    $insere_candidato .= " VALUES('$nomeCandidato', '$email', '$telefone', '$CPF', '$endereco', $cidade, '$funcao', '$arquivo_final')";
    $query_send = mysqli_query($conect, $insere_candidato);
}
?>

<div class="container">
    <form class="form_cadastro" action="./cadastro_candidato.php" method="POST" enctype="multipart/form-data">
        <h1>Cadastre-se</h1>
        <div id="testeFunçãoPHP"></div>
        <div class="col_1">
            <label for="">Nome</label>
            <input type="text" name="nome" autofocus>
            <label for="">CPF</label>
            <input type="text" class="cpf" name="CPF">
            <label for="">E-mail</label>
            <input type="text" name="email">
            <label for="">Telefone</label>
            <input type="text" class="tel" name="telefone">
            <label for="">Endereço</label>
            <input type="text" name="endereco">
            <div class="col_2">
                <div class="col_1" style="width: 20%;">
                    <label for="">Estado</label>
                    <select name="estado" id="estado" onchange="teste(value)">
                        <?php
                        $query_send_est = consultaEstado($conect);
                        while ($show_estado = mysqli_fetch_assoc($query_send_est)) {
                        ?>
                            <option value="<?php echo $show_estado['IDESTADO']; ?>" <?php if ($show_estado['IDESTADO'] == 26) {
                                                                                        echo ' selected';
                                                                                    } ?>> <?php echo $show_estado['siglaEstado'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col_1" style="width: 70%;">
                    <label for="">Cidade</label>

                    <select name="cidade" id="cidade" sel="1">
                        <?php
                        $cod_estado = 26;
                        $query_send_cid = consultaCidade($conect, $cod_estado);
                        while ($show_cidade = mysqli_fetch_assoc($query_send_cid)) {
                        ?>
                            <option value="<?php echo $show_cidade['IDCIDADE'] ?>"> <?php echo $show_cidade['nomeCidade'] ?> </option>
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

            <fieldset>

                <legend>Dados Complementares (opcional)</legend>
                <div class="col_2">
                    <div class="col_1" style="width: 40%;">
                        <label for="">Deseja informar seu genero?</label>
                        <input type="text" name="genero">
                    </div>
                    <div class="col_1" style="width: 40%;">
                        <label for="">Deseja informar sua raça?</label>
                        <input type="text" name="raca">
                    </div>
                </div>
                <div class="col_2">
                    <div class="col_1" style="width: 40%;">
                        <label for="">Estado Civil</label>
                        <select name="estado_civil" id="">
                            <option value="solteiro">Solteiro</option>
                            <option value="casado">Casado</option>
                            <option value=uniao>União Estável</option>
                            <option value="divorciado">Divorciado/Separado</option>
                            <option value="viuvo">Viúvo</option>
                        </select>
                    </div>
                    <div class="col_1" style="width: 40%;">

                        <label for="">Data de Nascimento</label>
                        <input type="date" name="nascto">
                    </div>
                </div>

                <h4>Histórico Profissional</h4>
                <fieldset class="historico">
                    <div class="col">

                        <label for="">De:</label>
                        <input type="month" name="inicio">
                    </div>
                    <div class="col">

                        <label for="">até:</label>
                        <input type="month" name="term">
                    </div>
                    <div class="col">

                        <label for="">Empresa</label>
                        <input type="text" name="empresa">
                    </div>
                    <div class="col">

                        <label for="">Cargo</label>
                        <input type="text" name='cargo'>
                    </div>
                    <div class="right-btn">
                        <button class="btn_add" onclick="adicionaLinha()">Adicionar</button>
                    </div>
                </fieldset>

                <div class="col">
                    <h4>Escolaridade</h4>
                    <label for="">Escolaridade</label>
                    <select name="escolaridade" id="">
                        <option value="analfabeto">Analfabeto</option>
                        <option value="fund_inc">Ensino Fundamental Incompleto</option>
                        <option value="fund_compl">Ensino Fundamental Completo</option>
                        <option value="med_inc">Ensino Médio Incompleto</option>
                        <option value="med_compl" selected>Ensino Médio Completo</option>
                        <option value="sup_inc">Superior Incompleto</option>
                        <option value="sup_compl">Superior Completo</option>
                    </select>
                </div>
                <fieldset class="escolaridade">
                    <legend>Cursos, especializações, línguas</legend>
                    <div class="col">
                        <label for="">Título do curso</label>
                        <input type="text" name="curso">
                    </div>
                    <div class="col" style="width: 60%;">
                        <label for="">Instituição</label>
                        <input type="text" name="escola">
                    </div>
                    <div class="col" style="width: 30%;">
                        <label for="">Ano Conclusão</label>
                        <input type="month" name="conclusao">
                    </div>
                    <div class="right-btn">
                        <button class="btn_add" onclick="adicionaLinha()">Adicionar</button>
                    </div>
                </fieldset>

            </fieldset>
        </div>
    </form>

    <?php
    include('./include/aside.php');
    ?>

</div>
<?php
include('./include/bottom.php');
?>
<div class="teste"></div>

<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/jquery.mask.min.js"></script>
<script src="./js/comon_jquery.js"></script>
<script>
    function adicionaLinha() {
        let curso = $('curso');
        console.log(curso);
    }

    function teste(value) {
        const estado = value;
        console.log(estado)
        $('#cidade').attr('sel', estado);
        $('#cidade').prepend('<?php echo "<p>" ?> + estado + <?php "</p>"; ?> ');
        return estado;
    };
</script>

</body>

</html>