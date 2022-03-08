<!DOCTYPE html>
<html lang="pt-br">

<?php
include('./head.php');
?>
<title>Cygnus * Envie seu curriculo</title>
</head>
<?php
include('./menu.php');
$page_link = 'https://cygnusrh.com.br/'
?>



<div class="container">



    <form class="form_email" action="https://formsubmit.co/curriculos@cygnusrh.com.br" method="POST" enctype="multipart/form-data">
        <h1>Envie seu currículo</h1>
        <input type="hidden" name="_next" value="<?php echo $page_link ?>sucesso.php" />
        <input type="hidden" name="_captcha" value="false" />
        <input type="text" name="name" placeholder="Digite seu nome" required />
        <input type="email" name="email" placeholder="Digite seu e-mail" required />
        <textarea placeholder="Digite sua mensagem" name="message" rows="3" cols="40" wrap></textarea>
        <label for="file-select">Anexe seu Curriculo </label>
        <span class="file">(formatos suportados: .pdf, .doc, .docx)</span>
        <input id="file-select" type="file" name="attachment" accept="image/jpeg, .pdf, .doc, .docx" />
        <br />
        <div class="blind-line"></div>
        <h2>Não tem curriculo?</h2>
        <label class="breve" for="breve">Escreva no campo abaixo uma breve apresentação.</label>
        <textarea placeholder="Digite uma breve apresentação profissional..." name="breve" rows="10" cols="40" wrap></textarea>
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