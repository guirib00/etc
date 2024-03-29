<?php
session_start();
$user = 'root';
$pass = 'usbw';
$bd = 'bd_etc2.0';
$server = 'localhost';

$conn = new mysqli($server, $user, $pass, $bd);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

function Login($usuario, $senha) {
    global $conn;

    $usuario = $conn->real_escape_string($usuario);

    // Trabalhador
    $sql = 'SELECT * FROM tb_trabalhadores WHERE login_trabalhador = ? AND senha_trabalhador = ?';
    $stmt = $conn->prepare($sql);

    // Bind os parâmetros
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $u = $result->fetch_object();
        $_SESSION['logado'] = true;
        $_SESSION['account_name'] = $u->nome_trabalhador;
        $_SESSION['account_email'] = $u->email_trabalhador;
        $_SESSION['account_id'] = $u->id_trabalhador;
        $_SESSION['account_login'] = $u->login_trabalhador;
        $_SESSION['account_especializacao'] = $u->especializacao_trabalhador;
        $_SESSION['account_sobre'] = $u->sobre_trabalhador;
        $_SESSION['account_imagem'] = $u->imagem_trabalhador;
        echo '<script>LoginRealize();</script>';
        var_dump($_SESSION);
        $_SESSION['type'] = 'trabalhador';
        return true; // Login trabalhador bem-sucedido
    }

    // Contratantes
    $sql_contratantes = 'SELECT * FROM tb_contratantes WHERE login_contratante = ? AND senha_contratante = ?';
    $stmt_contratantes = $conn->prepare($sql_contratantes);

    // Bind os parâmetros
    $stmt_contratantes->bind_param("ss", $usuario, $senha);

    $stmt_contratantes->execute();
    $result_contratantes = $stmt_contratantes->get_result();

    if ($result_contratantes->num_rows > 0) {
        $u = $result_contratantes->fetch_object();
        $_SESSION['logado'] = true;
        $_SESSION['account_name'] = $u->nome_contratante;
        $_SESSION['account_email'] = $u->email_contratante;
        $_SESSION['account_id'] = $u->id_contratante;
        $_SESSION['account_login'] = $u->login_contratante;
        $_SESSION['account_sobre'] = $u->sobre_contratante;
        $_SESSION['account_imagem'] = $u->img_perfil;
        $_SESSION['type'] = 'contratante';
        echo '<script>LoginRealize();</script>';
        var_dump($_SESSION);
        return true; // Login contratante bem-sucedido
    }

    return false; // Usuário não encontrado
}

function CadastrarTrabalhador($nome, $email, $especializacao, $sobre, $cep, $telefone, $login, $senha, $destino) {
    $comando = 'INSERT INTO tb_trabalhadores (id_trabalhador, nome_trabalhador, login_trabalhador, senha_trabalhador, email_trabalhador,imagem_trabalhador, especializacao_trabalhador, sobre_trabalhador, escolaridade_trabalhador, cep_trabalhador, tel_trabalhador)
    VALUES (null, "'.$nome.'", "'.$login.'", "'.$senha.'", "'.$email.'","'.$destino.'", "'.$especializacao.'", "'.$sobre.'", null, "'.$cep.'", "'.$telefone.'")';
    $resultado = $GLOBALS['conn']->query($comando);
    
    if ($resultado) {
        echo '<script>showCustomAlertTrabalhador("Cadastro como trabalhador realizado com sucesso!");</script>';
    } else {
        echo "Falha ao cadastrar: ".$resultado->error;
    }
}

function CadastrarContratante($nome, $email, $sobre, $cep, $telefone, $login, $senha, $destino) {
    $comando = 'INSERT INTO tb_contratantes (id_contratante, nome_contratante, login_contratante, senha_contratante, email_contratante, img_perfil, vinculo_contratante, sobre_contratante, cep_contratante, tel_contratante) 
    VALUES (null, "'.$nome.'", "'.$login.'", "'.$senha.'", "'.$email.'", "'.$destino.'", null, "'.$sobre.'", "'.$cep.'", "'.$telefone.'")';
    $resultado = $GLOBALS['conn']->query($comando);

    if ($resultado) {
        echo '<script>showCustomAlertContratante("Cadastro como contratante realizado com sucesso!");</script>';
    } else {
        echo "Falha ao cadastrar: ".$resultado->error;
    }
    
}

function CadastrarServico($categoria_servico, $nome_servico, $valor_servico, $endereco_servico, $descricao_servico) {
    global $conn;

    $descricao_servico = $conn->real_escape_string($descricao_servico);

    $comando = 'INSERT INTO tb_servicos (nome_servico, categoria_servico, dia_postagem, descricao_servico, endereco_servico, propostas_servico, valor_medio, fk_contratante_servicos, fk_trabalhador_servicos)
VALUES ("'.$nome_servico.'", "'.$categoria_servico.'", NOW(), "'.$descricao_servico.'", "'.$endereco_servico.'", "", "'.$valor_servico.'", "'.$_SESSION['account_id'].'", null)';

    
    $stmt = $conn->prepare($comando);

    if (!$stmt) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    
    if ($stmt->execute()) {
        echo '<script>showCadastrarServico("Serviço postado com sucesso");</script>';
        exit(); // Importante terminar o script após o redirecionamento
    } else {
        echo "Falha ao cadastrar: " . $stmt->error;
        echo $comando;
    }
}



function CheckarPerfil($login) {
    $comando = 'SELECT * FROM tb_trabalhadores 
    WHERE login_trabalhador = "'.$login.'"
    LIMIT 1';

    $resultado = $GLOBALS['conn']->query($comando);

    if ($resultado) {
        $stmt = $resultado->fetch_array();
        // var_dump($stmt);
        $user_id = $stmt[0];
        $user_name = $stmt[1];
        $user_email = $stmt[2];
        $user_plan = $stmt[4];
    }
}
?>

<meta charset="UTF-8" />

<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>

<div id="overlayContratante"></div>

<div id="customAlertContratante">
    <p id="customAlertMessageContratante"></p>
    <button class= "button button-secondary" onclick="closeCustomAlertContratante()">OK</button>
</div>

<div id="overlayTrabalhador"></div>

<div id="customAlertTrabalhador">
    <p id="customAlertMessageTrabalhador"></p>
    <button class= "button button-secondary" onclick="closeCustomAlertTrabalhador()">OK</button>
</div>

<div id="overlayServico"></div>

<div id="customAlertServico">
    <p id="customAlertMessageServico"></p>
    <button class= "button button-secondary" onclick="closeCustomAlertServico()">OK</button>
</div>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget({
      rootPah: '/app',
      personalization: 'https://vlibras.gov.br/config/default_logo.json',
      opacity: 0.5,
      position: 'R',
      avatar: 'random',
  });
  function showCustomAlertContratante(message) {
    document.getElementById('customAlertMessageContratante').textContent = message;
    document.getElementById('overlayContratante').style.display = 'block';
    document.getElementById('customAlertContratante').style.display = 'block';
}

function closeCustomAlertContratante() {
    document.getElementById('overlayContratante').style.display = 'none';
    document.getElementById('customAlertContratante').style.display = 'none';

    // Redireciona após fechar o alerta
    window.location.href = "painel-login.php";
}

function showCustomAlertTrabalhador(message) {
    document.getElementById('customAlertMessageTrabalhador').textContent = message;
    document.getElementById('overlayTrabalhador').style.display = 'block';
    document.getElementById('customAlertTrabalhador').style.display = 'block';
}

function closeCustomAlertTrabalhador() {
    document.getElementById('overlayTrabalhador').style.display = 'none';
    document.getElementById('customAlertTrabalhador').style.display = 'none';

    // Redireciona após fechar o alerta
    window.location.href = "painel-login.php";
}
function LoginRealize(){
    window.location.href = "index.php";
}

function showCadastrarServico(message) {
    document.getElementById('customAlertMessageServico').textContent = message;
    document.getElementById('overlayServico').style.display = 'block';
    document.getElementById('customAlertServico').style.display = 'block';
}
function closeCustomAlertServico() {
    window.location.href = "profile-contratante.php";
}
</script>