<?php

require_once('./_conexao/conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include('./head.php');
?>
<title>Cygnus * Consulte nossas vagas de emprego</title>
</head>
<?php
include('./menu.php');
?>

<?php

// $query_vagas = "SELECT funcao, tipo, localTrab, escolaridade, horario, beneficios, descricao FROM tb_vagas";
// include('./head.php');

$query_vagas = "SELECT funcao, tipo, c.nomeCidade as cidade, e.siglaEstado as estado, escolaridade, horario, beneficios, descricao, destaque, dataCriacao, DATE_ADD(dataCriacao, INTERVAL 30 DAY) as dataValidade FROM tb_vaga ";
$query_vagas .= " INNER JOIN tb_cidade AS c ON ID_CIDADE = c.IDCIDADE INNER JOIN tb_estado AS e ON c.ID_ESTADO = e.IDESTADO WHERE fechamento='A' ORDER BY funcao";
$lista_vagas = mysqli_query($conect, $query_vagas);
// var_dump($lista_vagas);
if (!$lista_vagas) {
    die('Falha na conexao');
}

?>

<div class="container">
    <section class="conteudo">
        <article class="textos-conteudo">
            <h1>Consulte nossas vagas</h1>
            <!--  -->
            <?php
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

                <script type="application/ld+json">
                    {
                        "@context": "https://schema.org/",
                        "@type": "JobPosting",
                        "title": "<?php echo $funcao ?>",
                        "description": "<?php echo '<p>' . $descricao . '</p>' ?>",
                        "datePosted": "<?php echo $dataCriacao ?>",
                        "validThrough": "<?php echo $dataValidade ?>",
                        "jobLocation": {
                            "@type": "Place",
                            "address": {
                                "@type": "PostalAddress",
                                "addressLocality": "<?php echo $cidade ?>",
                                "addressRegion": "<?php echo $estado ?>",
                                "addressCountry": "BR"
                            }
                        },
                        "employmentType": "FULL_TIME",
                        "hiringOrganization": {
                            "@type": "Organization",
                            "name": "Cygnus Recursos Humanos",
                            "sameAs": "https://cygnusrh.com.br"
                        }
                    }
                </script>

            <?php
            }
            ?>

            <h3>Não encontrou o que queria?</h3>

            <a class="curriculo-back" href="./formulario.php">Deixe seu curriculo para uma próxima oportunidade</a>
        </article>
    </section>

    <?php
    include('./aside.php');
    ?>

</div>
<?php

include('./bottom.php');

?>

</html>