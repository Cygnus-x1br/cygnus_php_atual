<?php
session_start();
require_once('./_conexao/conexao.php');
if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};
$user = $_SESSION["cygnus_login"];
?>

<?php
$consulta_cliente = 'SELECT * FROM tb_cliente ORDER BY nomeCliente';
$query_send_cli = mysqli_query($conect, $consulta_cliente);
if (!$query_send_cli) {
    die('Falha na conexão');
}
$consulta_cidade = 'SELECT * FROM tb_cidade ORDER BY nomeCidade';
$query_send_cid = mysqli_query($conect, $consulta_cidade);
if (!$query_send_cid) {
    die('Falha na conexão');
}

if (isset($_POST['funcao'])) {
    $user = $_SESSION["cygnus_login"];
    if (!empty($_POST['funcao'])) {
        $funcao = $_POST['funcao'];
    } else {
        die("<h1>Digite a função da vaga</h1>");
    }
    if (!empty($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
    } else {
        die("<h1>Selecione o tipo de vaga</h1>");
    }
    if (!empty($_POST['cidade'])) {
        $cidade = $_POST['cidade'];
    } else {
        die("<h1>Digite o local de trabalho</h1>");
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
    if ($_POST['destaque'] == 'S') {
        $destaque = 'S';
    } else {
        $destaque = '';
    };
    echo $salario;

    $insere_vaga = "INSERT INTO tb_vaga ";
    $insere_vaga .= "VALUES(null, '$funcao', '$tipo', '$cidade', '$escolaridade', '$horario', '$beneficios', '$descricao', $cliente, now(),'A', null, '$destaque', $salario, $user, $cidade)";
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