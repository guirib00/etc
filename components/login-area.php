<?php
	include('./modules/conexao.php');

	if ($_POST) {
        if (Login($_POST['login'], $_POST['senha'])) {
  
        } 
        
        else {
            $error_message = "Usuário não encontrado."; // Login falhou
        }
    }
?>

<section class="login-area">

    <section class="painel-container white-background shadow">

        <form class="painel-area" method="post">

            <aside class="rounded-circle">
                <a href="index.php"> <img src="./views/images/main_logo_alt.png"> </a>
            </aside>

            <label for="login"></label>
            <input type="text" id="login" placeholder="Digite seu login" name="login" autofocus> </input>

            <br>

            <label for="senha"></label>
            <input type="password" id="senha" placeholder="Digite sua senha" name="senha"> </input><i id="toggleIcon" class="fas fa-eye-slash toggle-icon" onclick="togglePasswordVisibility()"></i></input> <!-- Colocando o botão de mostrar/ocultar senha-->

            <br>

            <?php if (isset($error_message)) { ?>

                <div class="error-message text-center"><?php echo $error_message; ?></div> <!-- Criação e acionamento da variavel erro, que é acionada caso o usuario digite um usuario ou senha que não estão registrados no banco de dados, mostrando assim na tela o erro "usuario não encontrado"-->

            <?php } ?>

            <br>

            <div class="text-center">Não tem uma conta? <a href="painel-cadastro.php">Cadastrar</a></div>

            <br>

            <button class="button button-register shadow">Entrar</button>

        </form>

    </section>

</section>