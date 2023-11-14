<?php
    include('./modules/conexao.php');
    $erro = "";

    if ($_POST) {
        $registerType = $_POST['register_type'];

        if ($_POST['senha'] == $_POST['confirm_pass']) { //Verificação de senhas

            if ($registerType == "trabalhador") { //Verificar input(radio)
                CadastrarTrabalhador($_POST['nome'], $_POST['email'], $_POST['login'], $_POST['senha']); //Cadastro trabalhador
            }

            if ($registerType == "contratante") { //Verificar input(radio)
                CadastrarContratante($_POST['nome'], $_POST['email'], $_POST['login'], $_POST['senha']); //cadastro trabalhador
            }
        } else {
            $erro = "As senhas são diferentes"; //As senhas estão diferentes
        }
    }
?>
<section class="register-area">
    <section class="painel-container white-background shadow">
        <form id="completeForm" method="post">
            <aside class="rounded-circle">
                <a href="index.php"> <img src=" ./views/images/main_logo_alt.png"> </a>
            </aside>

            <!-- Parte 1 -->
            <div id="formPart1" class="form-part visible painel-area">
                <label for="nome"></label>
                <input type="text" name="nome" placeholder="Digite seu nome" autofocus>
                <br>
                <label for="email"></label>
                <input type="email" class="form-control" name="email" placeholder="Digite seu email" required autocomplete="on"></input>
                <br> 
                <br>
                <label for="type">
                    <div class="text-center">Sou trabalhador <input type="radio" name="register_type" id="type" value="trabalhador"></div>
                </label>
                <br>
                <label for="type-two">
                    <div class="text-center">Sou contratante <input type="radio" name="register_type" id="type-two" value="contratante"></div>
                </label>
                <br>
                <button type="button" class="button-secondary button button-next shadow" onclick="nextPart()">Proximo</button>
            </div>

            <!-- Parte 2 -->
            <div id="formPart2" class="painel-area form-part">
                <label for="login"></label>
                <input type="text" name="login" placeholder="Digite seu login" required>
                <br>
                <label for="senha"></label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
                <br>
                <label for="confirmar_senha"></label>
                <input type="password" name="confirm_pass" placeholder="Confirmar senha" required>
                <?php if (!empty($erro)) : ?>
                    <p class="error-message text-center"><?php echo $erro; ?></p>
                <?php endif; ?>
                <br>
                <br>
                <br>
                <div class="text-center">Já tem uma conta? <a href="painel-login.php">Login</a></div>
                <br>
            </div>

            <!-- Botões para navegação entre as partes -->
            <div class="text-center">
                <button type="button" id="return" class="button-return button-secondary button invisible" onclick="returnPart()">Voltar</button>
                <button type="button" onclick="submitForm()" id="cadastrar" class="button button-register shadow invisible"><a href="#">Cadastrar</a></button>
            </div>
        </form>
    </section>
</section>

<script>
    function submitForm() {
        document.getElementById("completeForm").submit();
    }
</script>

