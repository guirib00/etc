<?php
    // Se o formulário for enviado
    include('./modules/conexao.php');
    $erro = "";
    if ($_POST) {
        $registerType = $_POST['register_type'];

        // Verificação de senhas
        if ($_POST['senha'] == $_POST['confirm_pass']) {
            if ($registerType == "trabalhador") {
                CadastrarTrabalhador($_POST['nome'], $_POST['email'],$_POST['especializacao'], $_POST['login'], $_POST['senha']);
            } elseif ($registerType == "contratante") {
                CadastrarContratante($_POST['nome'], $_POST['email'], $_POST['login'], $_POST['senha']);
            }
        } else {
            $erro = "As senhas são diferentes";
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
                <label for="type">
                    <div class="text-center">
                        Sou trabalhador <input type="radio" name="register_type" id="type" value="trabalhador">
                    </div>
                </label>
                <br>
                <label for="type-two">
                    <div class="text-center">
                        Sou contratante <input type="radio" name="register_type" id="type-two" value="contratante">
                    </div>
                </label>
                <br>
                <button type="button" class="button-secondary button button-next shadow" onclick="showFormPart()">Próximo</button>
            </div>

            <!-- Parte 2 - Campos específicos do trabalhador -->
            <div id="camposTrabalhador" class="painel-area form-part" style="display: none;">
                <!-- Campos específicos do trabalhador -->
                <label for="nome"></label>Nome <br>
                <input type="text" name="nome" placeholder="Digite seu nome" autofocus>
                <br>
                <label for="email"></label>Email <br>
                <input type="email" class="form-control" name="email" placeholder="Digite seu email" required autocomplete="on"></input>
                <br> 
                <label for="especializacao"></label>Especialização <br>
                <input type="text" class="form-control" name="especializacao" placeholder="Digite suas especializações" required autocomplete="on"></input>
                <br> 
                <label for="login"></label>Login <br>
                <input type="text" name="login" placeholder="Digite seu login" required>
                <br>
                <label for="senha"></label>Senha <br>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
                <br>
                <label for="confirmar_senha"></label>Confirmar senha <br>
                <input type="password" name="confirm_pass" placeholder="Confirmar senha" required>
                <?php if (!empty($erro)) : ?>
                    <p class="error-message text-center"><?php echo $erro; ?></p>
                <?php endif; ?>
            </div>

            <!-- Parte 2 - Campos específicos do contratante -->
            <div id="camposContratante" class="painel-area form-part" style="display: none;">
                <!-- Campos específicos do contratante -->
                <label for="campoContratante"></label>
                <input type="text" name="campoContratante" placeholder="Campo específico do contratante">
                <br>
            </div>

            <!-- Botões para navegação entre as partes -->
            <br><br>
            <div class="text-center invisible" id="login">Já tem uma conta? <a href="painel-login.php">Login</a></div>
            <button type="button" onclick="submitForm()" id="cadastrar" class="button button-register shadow invisible"><a href="#">Cadastrar</a></button>
            <button type="button" id="return" class="button-return button-secondary button invisible" onclick="returnPart()">Voltar</button>
        </form>
    </section>
</section>

<script>
    function showFormPart() {
        var formPart1 = document.getElementById('formPart1');
        var formPart2 = document.getElementById('camposTrabalhador');
        var formPart3 = document.getElementById('camposContratante');
        var registerType = document.querySelector('input[name="register_type"]:checked').value;

        if (registerType) {
            formPart1.style.display = 'none';

            if (registerType === 'trabalhador') {
                formPart2.style.display = 'block';
                formPart3.style.display = 'none';
            } else {
                formPart2.style.display = 'none';
                formPart3.style.display = 'block';
            }

            // Exibir botões quando campos específicos são exibidos
            document.getElementById('return').classList.remove('invisible');
            document.getElementById('cadastrar').classList.remove('invisible');
            document.getElementById('login').classList.remove('invisible');
        }
    }

    function submitForm() {
        document.getElementById("completeForm").submit();
    }

    function returnPart() {
        var formPart1 = document.getElementById('formPart1');
        var formPart2 = document.getElementById('camposTrabalhador');
        var formPart3 = document.getElementById('camposContratante');

        formPart1.style.display = 'block';
        formPart2.style.display = 'none';
        formPart3.style.display = 'none';

        // Ocultar botões ao retornar à primeira parte
        document.getElementById('return').classList.add('invisible');
        document.getElementById('cadastrar').classList.add('invisible');
        document.getElementById('login').classList.add('invisible');
    }
</script>
