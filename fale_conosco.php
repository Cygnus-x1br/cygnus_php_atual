<!DOCTYPE html>
<html lang="pt-br">

<?php
// include('./php/emailFunction.php');
include('./include/head.php');
?>
<title>Cygnus * Fale Conosco</title>

<link rel="stylesheet" href="./css/form.css" />
<style>
    html {
        height: 100vh;
    }
</style>
</head>
<?php
// if (isset($_POST['name'])) {
//     if (enviarMensagem($_POST)) {
//         header("location:sucesso.php");
//         echo '<script>location.replace("sucesso.php");</script>';
//     } else {
//         die("Erro no envio.");
//     }
// }
// 
?>
<?php
include('./include/menu.php');
$page_link = 'https://cygnusrh.com.br/'
?>


<div class="container">
    <form class="form_email" action="https://formsubmit.co/contato@cygnusrh.com.br" method="POST" enctype="multipart/form-data">
        <h1>Envie seu currículo</h1>
        <input type="hidden" name="_next" value="<?php echo $page_link ?>sucesso.php" />
        <input type="hidden" name="_captcha" value="false" />
        <input type="text" name="name" placeholder="Digite seu nome" required />
        <input type="text" name="empresa" placeholder="Digite o nome da empresa" required />
        <input type="email" name="email" placeholder="Digite seu e-mail" required />
        <textarea placeholder="Digite sua mensagem" name="message" rows="3" cols="40" wrap></textarea>
        <div class="blind-line"></div>
        <button type="submit">Enviar</button>
    </form>

    <!-- <form class="form_email" action="fale_conosco.php" method="POST" enctype="multipart/form-data">
        <h1>Fale conosco</h1>
        <input type="text" name="name" placeholder="Digite seu nome" required />
        <input type="text" name="empresa" placeholder="Digite o nome da empresa" required />
        <input type="email" name="email" placeholder="Digite seu e-mail" required />
        <textarea placeholder="Digite sua mensagem" name="message" rows="11" cols="40" wrap></textarea>
        <div class="blind-line"></div>
        <button type="submit">Enviar</button>
    </form> -->

    <?php
    include('./include/aside.php');
    ?>

</div>

<?php
include('./include/bottom.php');
?>

</body>

</html>