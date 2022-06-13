<?php

require_once('../php/emailFunction.php');

if (isset($_POST['name'])) {
    if (enviarMensagem($_POST)) {
        //header("location:sucesso.php");
        echo '<script>location.replace("sucesso.php");</script>';
    } else {
        die("Erro no envio.");
    }
}
?>

<form class="form_email" action="fale_conosco.php" method="POST" enctype="multipart/form-data">
    <h1>Fale conosco</h1>
    <input type="text" name="name" placeholder="Digite seu nome" required />
    <input type="text" name="empresa" placeholder="Digite o nome da empresa" required />
    <input type="email" name="email" placeholder="Digite seu e-mail" required />
    <textarea placeholder="Digite sua mensagem" name="message" rows="11" cols="40" wrap></textarea>
    <div class="blind-line"></div>
    <button type="submit">Enviar</button>
</form>