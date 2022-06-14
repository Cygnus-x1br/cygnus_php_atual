<?php

$request = $_SERVER['PHP_SELF'];

$path = $_SERVER['PATH_INFO'] ?? '/';


// if (strlen($path) > 1) {
//     $_SERVER['REQUEST_URI'] = rtrim($_SERVER['REQUEST_URI'], '/');
//     $path = rtrim($path, '/');
// }

$path = explode('.php', $path);
$path = $path[0];
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// echo $path;

if ($path === '/vagas') {
    $meta = 'meta_vagas.php';
    $conteudo = 'vagas.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/sobre') {
    $conteudo = 'sobre.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/servicos') {
    $conteudo = 'servicos.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/contato') {
    $conteudo = 'contato.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/fale_conosco') {
    $conteudo = 'fale_conosco.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/formulario') {
    $conteudo = 'formulario.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/sucesso') {
    $conteudo = 'sucesso.php';
    require __DIR__ . '/template/site/principal.php';
} elseif ($path === '/vagas/') {
    header('Location:/vagas/login.php');
} else {
    $meta = 'meta_home.php';
    $conteudo = 'home.php';
    $conteudo2 = 'noticias.php';
    require __DIR__ . '/template/site/principal.php';
}