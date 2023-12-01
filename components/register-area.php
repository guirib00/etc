<?php
    // Se o formulário for enviado
    include('./modules/conexao.php');
    $erro = "";
    
    if ($_POST) {
        $registerType = $_POST['register_type'];

        // Verificação de senhas
        if (($_POST['senha'] == $_POST['confirm_pass']) || ($_POST['senha'] == $_POST['confirm_pass'])) {
            if ($registerType == "trabalhador") {
                $nome = $_POST['nome'];
                $login = $_POST['login'];
                $senha = $_POST['senha'];
                $email = $_POST['email'];
                $especializacao = $_POST['especializacao'];
                $sobre = $_POST['sobre'];
                $cep = $_POST['cep'];
                $telefone = $_POST['telefone'];  
                $arquivo = $_FILES['arq'];
                $destino = 'docs/' . $arquivo['name'];
                move_uploaded_file($_FILES['arq']['tmp_name'], $destino);
                CadastrarTrabalhador($nome, $email, $especializacao, $sobre, $cep, $telefone, $login, $senha, $destino);
            } elseif ($registerType == "contratante") {
                $nome = $_POST['nome_cont'];
                $login = $_POST['login_cont'];
                $senha = $_POST['senha_cont'];
                $email = $_POST['email_cont'];
                $sobre = $_POST['sobre_cont'];
                $cep = $_POST['cep_cont'];
                $telefone = $_POST['telefone_cont'];
                $arquivo = $_FILES['arq_cont'];
                $destino = 'docs/' . $arquivo['name'];
                move_uploaded_file($_FILES['arq_cont']['tmp_name'], $destino);
                CadastrarContratante($nome, $email, $sobre, $cep, $telefone, $login, $senha, $destino);
            }
        } else {
            $erro = "<script> window.alert('As senhas estão diferentes'); </script>";
        }
    }
?>


<section class="register-area">
    <section class="painel-container white-background shadow">
        <form id="completeForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
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
                <div class="grid-container">
                    <div class="grid-item">
                        <label for="nome"></label>Nome <br>
                        <input type="text" name="nome" placeholder="Digite seu nome" autofocus></input>
                    </div>
                    <div class="grid-item2">
                        <label for="email"></label>Email <br>
                        <input type="email" class="form-control" name="email" placeholder="Digite seu email" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="imagem"></label>Imagem <br>
                        <input type="file" name="arq">
                    </div>
                    <div class="grid-item2">
                        <label for="especializacao"></label>Especialização <br>
                        <input type="text" class="form-control" name="especializacao" placeholder="Digite sua especialização" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="sobre"></label>Sobre<br>
                        <input type="text" class="form-control" name="sobre" placeholder="Digite sobre você" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item2">
                        <label for="cep"></label>CEP<br>
                        <input type="text" class="form-control" name="cep" placeholder="Digite seu CEP" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="telefone"></label>Telefone <br>
                        <input type="text" class="form-control" name="telefone" placeholder="Digite seu telefone" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item2">
                        <label for="login"></label>Login <br>
                        <input type="text" name="login" placeholder="Digite seu login" required>
                    </div>
                    <div class="grid-item">
                        <label for="senha"></label>Senha <br>
                        <input type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <div class="grid-item2">
                        <label for="confirmar_senha"></label>Confirmar senha <br>
                        <input type="password" name="confirm_pass" placeholder="Confirmar senha" required>
                    </div>
                </div>


            </div>

            <!-- Parte 2 - Campos específicos do contratante -->
            <div id="camposContratante" class="painel-area form-part" style="display: none;">
                <!-- Campos específicos do contratante -->
                <div class="grid-container">
                    <div class="grid-item">
                        <label for="nome"></label>Nome <br>
                        <input type="text" name="nome_cont" placeholder="Digite seu nome" autofocus>
                    </div>
                    <div class="grid-item2">
                        <label for="email"></label>Email <br>
                        <input type="email" class="form-control" name="email_cont" placeholder="Digite seu email" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="imagem"></label>Imagem <br>
                        <input type="file" name="arq_cont">
                    </div>
                    <div class="grid-item2">
                        <label for="sobre"></label>Sobre<br>
                        <input type="text" class="form-control" name="sobre_cont" placeholder="digite sobre você" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="cep"></label>CEP <br>
                        <input type="text" class="form-control" name="cep_cont" placeholder="Digite seu CEP" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item2">
                        <label for="telefone"></label>Telefone <br>
                        <input type="text" class="form-control" name="telefone_cont" placeholder="Digite seu telefone" required autocomplete="on"></input>
                    </div>
                    <div class="grid-item">
                        <label for="login"></label>Login <br>
                        <input type="text" name="login_cont" placeholder="Digite seu login" required>
                    </div>
                    <div class="grid-item2">
                        <label for="senha"></label>Senha <br>
                        <input type="password" name="senha_cont" placeholder="Digite sua senha" required>
                    </div>
                    <div class="grid-item">
                        <label for="confirmar_senha"></label>Confirmar senha <br>
                        <input type="password" name="confirm_pass_cont" placeholder="Confirmar senha" required>
                    </div>
                </div>
                <?php if (!empty($erro)) : ?>
                    <p class="error-message text-center"><?php echo html_entity_decode($erro); ?></p>
                <?php endif; ?>
            </div>

            <!-- Botões para navegação entre as partes -->
            <br><br>
            <div class="text-center invisible" id="login">Já tem uma conta? <a href="painel-login.php">Login</a></div>
            <button type="button" id="return" class="button-return button-secondary button invisible" onclick="returnPart()">Voltar</button>
            <button type="button" onclick="submitForm()" id="cadastrar" class="button button-register shadow invisible"><a href="#">Cadastrar</a></button>
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
    function validateForm() {
        var senha = document.getElementsByName("senha")[0].value;
        var confirmarSenha = document.getElementsByName("confirm_pass")[0].value;

        if (senha !== confirmarSenha) {
            alert("Senhas diferentes");
            return false; // Impede o envio do formulário
        }

        return true; // Permite o envio do formulário se as senhas forem iguais
    }
function submitForm() {
    if (validateForm()) {
        document.getElementById("completeForm").submit();
    }
}
</script>
