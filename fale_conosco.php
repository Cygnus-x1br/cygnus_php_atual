<!DOCTYPE html>
<html lang="pt-br">

<?php
include('./include/function.php');
include('./head.php');
?>
<title>Cygnus * Envie seu curriculo</title>
<link rel="stylesheet" href="./css/form.css" />
<style>
    html {
        height: 100vh;
    }
</style>
</head>
<?php
include('./menu.php');
$page_link = 'https://cygnusrh.com.br/'
?>
<?php
if (isset($_POST['name'])) {
    if (enviarMensagem($_POST)) {
        header("location:sucesso.php");
    } else {
        die("Erro no envio.");
    }
}
?>


<div class="container">



    <form class="form_email" action="envio.php" method="POST" enctype="multipart/form-data">
        <h1>Fale conosco</h1>
        <!-- <input type="hidden" name="_next" value="<?php echo $page_link ?>sucesso.php" /> -->
        <!-- <input type="hidden" name="_captcha" value="false" /> -->
        <input type="text" name="name" placeholder="Digite seu nome" required />
        <input type="text" name="empresa" placeholder="Digite o nome da empresa" required />
        <input type="email" name="email" placeholder="Digite seu e-mail" required />
        <textarea placeholder="Digite sua mensagem" name="message" rows="11" cols="40" wrap></textarea>

        <div class="blind-line"></div>

        <button type="submit">Enviar</button>
    </form>


    <?php
    include('./aside.php');
    ?>

</div>

<?php
include('./bottom.php');
?>

</html>