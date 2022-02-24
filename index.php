<?php

require_once('./_conexao/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php
include('./head.php');

$query_vagas = "SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque FROM tb_vaga ";
$query_vagas .= " INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO WHERE destaque='S' AND fechamento='A' ";
$query_vagas .= " ORDER BY dataCriacao DESC";
$lista_vagas = mysqli_query($conect, $query_vagas);
// var_dump($lista_vagas);

if (!$lista_vagas) {
    die('Falha na conexao');
}
?>

<div class="container">
    <section class='destaque'>
        <article class='vagas-destaque'>
            <h3>Vagas em destaque</h3>
            <section class="box-vagas">
                <?php
                while ($linha = mysqli_fetch_assoc($lista_vagas)) {
                    $funcao = $linha['funcao'];
                    $tipo = $linha['tipo'];
                    $localTrab = $linha['cidade'] . ' - ' . $linha['estado'];
                    $escolaridade = $linha['escolaridade'];
                    $horario = $linha['horario'];
                    $beneficios = $linha['beneficios'];
                    $descricao = $linha['descricao'];
                    $destaque = $linha['destaque'];

                ?>
                    <article>
                        <header><?php echo $funcao ?></header>
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
                            <br />
                            <?php echo $descricao ?>
                        </p>
                        <a class="btn" href="./formulario.php">Envie seu currículo</a>
                    </article>
                <?php
                }
                ?>
            </section>
        </article>
    </section>

    <?php
    include('./aside.php');
    ?>

</div>
<section class="noticias">
    <main>
        <header>
            <h3></h3>
        </header>
        <img src="./images/Camada4_min.png" alt="" />
        <section class="frase-efeito">
            <p>
                <span class="fonte-efeito">Para empresas: </span> O lugar certo para
                contratar!
            </p>

            <p>
                <span class="fonte-efeito">Para pessoas: </span> O lugar certo para
                trabalhar!
            </p>
        </section>
    </main>
</section>


<?php

include('./bottom.php');

?>

</html>