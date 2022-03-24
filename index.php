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
<link rel="canonical" href="https://cygnusrh.com.br/">
</head>
<?php
include('./include/menu.php');
?>

<div class="container">
    <section class='destaque'>
        <article class='vagas-destaque'>
            <h1>Vagas em destaque</h1>
            <section class="box-vagas">
                <?php
                $lista_vagas = dadosVagasDestaque($conect);
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
    include('./include/aside.php');
    ?>

</div>
<section class="noticias">
    <main>
        <header>
            <h3></h3>
        </header>
        <img src="./images/Camada4_min.png" alt="Vagas em todas as áreas" />
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
include('./include/bottom.php');
?>

</body>

</html>