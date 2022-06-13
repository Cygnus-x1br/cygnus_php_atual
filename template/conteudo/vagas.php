<?php
require_once('../_conexao/conexao.php');
require_once('../app/Model/dbFunctions.php');
?>
<?php
$lista_vagas = dadosVagasAbertas($conect);
while ($linha = mysqli_fetch_assoc($lista_vagas)) {
    $funcao = $linha['funcao'];
    $tipo = $linha['tipo'];
    $cidade = $linha['cidade'];
    $estado = $linha['estado'];
    $localTrab = $cidade . ' - ' . $estado;
    $escolaridade = $linha['escolaridade'];
    $horario = $linha['horario'];
    $beneficios = $linha['beneficios'];
    $descricao = $linha['descricao'];
    $dataCriacao = $linha['dataCriacao'];
    $dataValidade = $linha['dataValidade'];
    $salario = $linha['salario'];
}

?>


<section class="conteudo">
    <article class="textos-conteudo">
        <h1>Consulte nossas vagas</h1>
        <!--  -->
        <?php
        $lista_vagas = dadosVagasAbertas($conect);
        while ($linha = mysqli_fetch_assoc($lista_vagas)) {
            $funcao = $linha['funcao'];
            $tipo = $linha['tipo'];
            $cidade = $linha['cidade'];
            $estado = $linha['estado'];
            $localTrab = $cidade . ' - ' . $estado;
            $escolaridade = $linha['escolaridade'];
            $horario = $linha['horario'];
            $beneficios = $linha['beneficios'];
            $descricao = $linha['descricao'];
            $dataCriacao = $linha['dataCriacao'];
            $dataValidade = $linha['dataValidade'];


        ?>
            <h4><?php echo $funcao ?></h4>
            <h5>Dados da vaga</h5>
            <ul>
                <li>Tipo de vaga: <?php if ($tipo == 'E') {
                                        echo 'Efetiva';
                                    } elseif ($tipo == 'T') {
                                        echo 'Temporária';
                                    } ?></li>
                <li>Local de trabalho: <?php echo $localTrab ?></li>
                <li>Escolaridade: <?php echo $escolaridade ?></li>
                <li>Horário de trabalho: <?php echo $horario ?></li>
            </ul>
            <p>
                <?php echo $beneficios ?><br />
                <?php echo $descricao ?>
            </p>
            <div class="underline"></div>



        <?php
        }
        ?>

        <h3>Não encontrou o que queria?</h3>

        <a class="curriculo-back" href="./formulario.php">Deixe seu curriculo para uma próxima oportunidade</a>
    </article>
</section>