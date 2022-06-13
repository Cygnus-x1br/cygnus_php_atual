<?php
require_once('../_conexao/conexao.php');
require_once('../php/dbFunctions.php');

?>
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