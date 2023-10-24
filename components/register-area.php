<?php
	include('./modules/conexao.php');
    $erro = "";

	if ($_POST) {
        $registerType = $_POST['register_type'];

        if($_POST['senha'] == $_POST['confirm_pass']){ //Verificação de senhas

            if($registerType == "trabalhador"){ //Verificar input(radio)
		        CadastrarTrabalhador($_POST['email'],$_POST['senha']); //Cadastro trabalhador
            }

            if($registerType == "contratante"){ //Verificar input(radio) 
                CadastrarContratante($_POST['email'],$_POST['senha']); //cadastro trabalhador
            }

        }

        else{
            $erro = "As senhas são diferentes"; //As senhas estão diferentes
        }
    }
?>

<section class="register-area">

    <section class="painel-container white-background shadow">

        <form class="painel-area" method="post">

            <aside class="rounded-circle">
                <a href="index.php"> <img src="./views/images/main_logo_alt.png"> </a>
            </aside>

            <label for="email"></label>
            <input type="email" id="email" placeholder="Seu e-mail" name="email" autofocus required autocomplete="on"> </input>

            <br>

            <label for="senha"></label>
            <input type="password" id="senha" placeholder="Sua senha" name="senha" required> </input> <i id="toggleIcon" class="fas fa-eye-slash toggle-icon" onclick="togglePasswordVisibility()"></i></input> <!-- Adição do "required" que obriga o usuario escolher/digitar algo no input -->

            <br>

            <label for="confirmar_senha"></label>
            <input type="password" id="confirmar_senha" placeholder="Confirmar senha" name="confirm_pass" required> </input>

            <?php if (!empty($erro)) : ?>

                <p class="error-message text-center"><?php echo $erro; ?></p> <!-- Criação e acionamento da variavel erro, acionada quando o usuario digita senhas diferentes no campo de senha e confirmar senha-->

            <?php endif; ?>

            <br>

            <br>

            <label for="type"> 
            <div class="text-center">Sou trabalhador <input type="radio" name="register_type" id="type" value="trabalhador" required></input> </div>
            </label>

            <br>

            <label for="type-two"> 
            <div class="text-center">Sou contratante <input type="radio" name="register_type" id="type-two" value="contratante" required></input>
            </div>    
            </label>

            <br>

            <div class="text-center">Já tem uma conta? <a href="painel-login.php">Login</a></div>

            <br>

            <button class="button button-register shadow"><a href="#">Cadastrar</a></button>

        </form>

    </section>

</section>