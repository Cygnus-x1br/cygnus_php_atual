<?php

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// $request = $_SERVER['PHP_SELF'];

$path = $_SERVER['PATH_INFO'] ?? '/';

if ($path === '/vagas' || $path == '/vagas.php') {
    $meta = 'meta_vagas.php';
    $conteudo = 'vagas.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/sobre' || $path == '/sobre.php') {
    $conteudo = 'sobre.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/servicos' || $path == '/servicos.php') {
    $conteudo = 'servicos.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/contato' || $path == '/contato.php') {
    $conteudo = 'contato.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/fale_conosco' || $path == '/fale_conosco.php') {
    $conteudo = 'fale_conosco.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/formulario' || $path == '/formulario.php') {
    $conteudo = 'formulario.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/sucesso' || $path == '/sucesso.php') {
    $conteudo = 'sucesso.php';
    require __DIR__ . '/template/site/principal.php';
} else {
    $meta = 'meta_home.php';
    $conteudo = 'home.php';
    $conteudo2 = 'noticias.php';
    require __DIR__ . '/template/site/principal.php';
}
