<?php

function enviarMensagem($dados)
{
    print_r($dados);
    $nome_usuario = $dados['name'];
    $empresa = $dados['empresa'];
    $email_usuario = $dados['email'];
    $mensagem_usuario = $dados['message'];

    // return $dados;
    $destino = "jeanmarcel83@gmail.com";
    $remetente = "jean@jmarc.com.br"; /*deve ser o email do servidor que está mandando a mensagem, no caso um email com o domínio de quem está hospedando*/
    $assunto = "Mensagem do site";
    $mensagem = "<html>O usuário " . $nome_usuario . " enviou uma mensagem." . "<br>";
    $mensagem .= "Email do usuário: " . $email_usuario . "<br>";
    $mensagem .= "Mensagem: " . "<br>";
    $mensagem .= $mensagem_usuario;
    $mensagem .= "</html>";

    /**************************************/
    /*        Dados página produção       */
    /**************************************/

    // $destino = "jeanmarcel@cygnusrh.com.br";
    // $remetente = "curriculos@cygnusrh.com.br";
    // $assunto = "Mensagem do site";
    // $mensagem = "<html>O usuário " . $nome_usuario . " da empresa " . $empresa . " enviou uma mensagem." . "<br>";
    // $mensagem .= "Email do usuário: " . $email_usuario . "<br>";
    // $mensagem .= "Mensagem: " . "<br>";
    // $mensagem .= $mensagem_usuario;
    // $mensagem .= "</html>";

    return mail($destino, $assunto, $mensagem, $remetente);
}
