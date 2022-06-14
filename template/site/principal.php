<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-51E4YX31W2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-51E4YX31W2');
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NMSHV97');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="Empregos, vagas,Cygnus RH, trabalho temporário, terceirização, empregos Mogi Guaçu, empregos Itapira, empregos Socorro, empregos Mogi Mirim" />
    <!-- <meta name="description" content="Cygnus Recursos Humanos. Agencia de empregos em Mogi Guaçu. Trabalhamos vagas de emprego em toda a região da Baixa Mogiana (Mogi Guaçu, Mogi Mirim, Itapira, Socorro, Jacutinga, Estiva Gerbi) e ABC Paulista" /> -->
    <meta name="author" content="Jean Marcel Fiad" />
    <meta name="robots" content="index, follow" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="./css/style.css?v1.3" />
    <link rel="stylesheet" href="./css/media_queries.css?v1.2" />
    <link rel="stylesheet" href="./css/form.css" />
    <script src="https://kit.fontawesome.com/f8deb99a48.js" crossorigin="anonymous"></script>
    <?php
    if (!empty($meta)) {
        include __DIR__ . '/../metatags/' . $meta;
    } else {
    ?>
        <!-- home start -->
        <title>Sem Meta Cygnus Recursos Humanos * Portal de empregos e serviços</title>
        <meta name="description" content="Veja nossas vagas de emprego em destaque. Cygnus Recursos Humanos. Agencia de empregos em Mogi Guaçu. Trabalhamos vagas de emprego em toda a região da Baixa Mogiana (Mogi Guaçu, Mogi Mirim, Itapira, Socorro, Jacutinga, Estiva Gerbi) e ABC Paulista" />
        <link rel="canonical" href="https://cygnusrh.com.br/">
        <!-- home end -->
    <?php
    }
    ?>

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NMSHV97" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        <img class="logo-img" src="./images/CisneOriginalSemFundo.png" alt="Logotipo Cisne" />
        <div class="flex-container-col">
            <img class="texto-logo" src="./images/Logo_texto.png" alt="Logotipo texto Cygnus" />
        </div>
        <div></div>
    </header>

    <section class="navbar">
        <nav>
            <ul>
                <li><a href="./">Home</a></li>
                <div class="blind-line"></div>
                <li><a href="./vagas">Vagas</a></li>
                <div class="blind-line"></div>
                <li><a href="./sobre">Sobre</a></li>
                <div class="blind-line"></div>
                <li><a href="./servicos">Serviços</a></li>
                <div class="blind-line"></div>
                <li><a href="./contato">Contato</a></li>
                <div class="blind-line"></div>
                <li>
                    <a class="curriculo" href="./formulario">Envie seu curriculo</a>
                </li>
            </ul>
        </nav>
    </section>

    <div class="container">

        <!-- Conteudo -->
        <?php

        require __DIR__ . '/../conteudo/' . $conteudo;

        ?>


        <aside>
            <h4>Redes:</h4>
            <div class="redes-icons">
                <a href="https://www.facebook.com/pontual.empregos/" target="_blank"><i class="fab fa-facebook-square"></i></a>
                <a href="./contato"><i class="fas fa-envelope"></i></a>
                <a href="https://www.linkedin.com/in/cygnus-presta%C3%A7%C3%A3o-de-servi%C3%A7os-em-rh-a919a818b/" target="_blank"><i class="fab fa-linkedin"></i></a>
            </div>
        </aside>
    </div>

    <?php
    if (!empty($conteudo2)) {
        include __DIR__ . '/../conteudo/' . $conteudo2;
    }
    ?>

    <footer>
        <p>&copy 2021 CYGNUS RH</p>
    </footer>

</body>

</html>