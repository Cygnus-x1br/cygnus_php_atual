<?php

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
// $request = $_SERVER['PHP_SELF'];

$path = $_SERVER['PATH_INFO'] ?? '/';

// if ($path == '/' || $path == '/index.php') {
//     $conteudo = 'home.php';
//     require __DIR__ . '/template/site/principal.php';

if ($path === '/vagas' || $path == '/vagas.php') {
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
} else {
    $conteudo = 'home.php';
    require __DIR__ . '/template/site/principal.php';
}



// require __DIR__ . '/template/site/principal.php';
// if ($request == $_SERVER['REQUEST_URI'] . '/' || $_SERVER['REQUEST_URI'] . '/index.php') {
//     echo 'Bom dia';
// } else {
//     echo '<pre>';
//     print_r($_SERVER);
//     echo '</pre>';
//     require __DIR__ . '/template/site/principal.php';
// }
