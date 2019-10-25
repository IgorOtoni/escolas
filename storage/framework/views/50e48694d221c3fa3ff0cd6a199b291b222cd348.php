<?php /* C:\xampp\htdocs\apresentacao_sites\resources\views/primeiroEmail.blade.php */ ?>
<html>
    <body>
        <img src="/storage/hotsystems.jpeg" 
            style="display: block; margin-left: auto; margin-right: auto">
        <h1>Seja bem vindo a Plataforma Sites!</h1>
        <p>Seu <b>usuário</b> é: <?php echo e($usuario); ?></p>
        <p>Sua <b>senha usuário</b> é: <?php echo e($senha); ?></p>
        <p>
            Você ainda não possui permissões para alterar o site.
            Entre em contato para que as permissões sejam concedidadas.
        </p>
    </body>
</html>