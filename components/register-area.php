<?php
    include('./modules/conexao.php');
    $erro = "";

    if ($_POST) {
        $registerType = $_POST['register_type'];

        if ($_POST['senha'] == $_POST['confirm_pass']) { //Verificação de senhas

            if ($registerType == "trabalhador") { //Verificar input(radio)
                CadastrarTrabalhador($_POST['email'], $_POST['senha']); //Cadastro trabalhador
            }

            if ($registerType == "contratante") { //Verificar input(radio) 
                CadastrarContratante($_POST['email'], $_POST['senha']); //cadastro trabalhador
            }
        } else {
            $erro = "As senhas são diferentes"; //As senhas estão diferentes
        }
    }
?>
<script src="./views/js/navegacao-cadastro.js"></script>
<section class="register-area">
    <section class="painel-container white-background shadow">
        <form id="completeForm" method="post">
            <aside class="rounded-circle">
                <a href="index.php"> <img src=" ./views/images/main_logo_alt.png"> </a>
            </aside>

            <!-- Parte 1 -->
            <div id="formPart1" class="form-part visible painel-area">
                <label for="nome"></label>
                <input type="text" name="nome" placeholder="Digite seu nome">
                <br>
                <label for="telefone"></label>
                <input type="text" class="form-control" name="phone" placeholder="Digite seu telefone" title="Número de telefone precisa ser no formato (99) 9999-9999" required="required" />
                <br>
                <label for="Data de nascimento">
                    <input type="date" placeholder="data de nascimento">
                </label>
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
                <label for="email"></label>
                <input type="email" name="email" placeholder="Seu e-mail" autofocus required autocomplete="on">
                <br>
                <label for="senha"></label>
                <input type="password" name="senha" placeholder="Sua senha" required>
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
                <button type="submit" id="cadastrar" class="button button-register shadow invisible"><a href="#">Cadastrar</a></button>
            </div>
        </form>
    </section>
</section>

