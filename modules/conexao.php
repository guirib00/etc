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
        header("location: index.php");
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
        
        header("location: index.php");
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
        echo("Cadastrado.");
        header("location: painel-login.php");
    } else {
        echo("Falha ao cadastrar:".$resultado->error);
        echo $comando;
    }
}

function CadastrarContratante($nome, $email, $sobre, $cep, $telefone, $login, $senha, $destino) {
    $comando = 'INSERT INTO tb_contratantes (id_contratante, nome_contratante, login_contratante, senha_contratante, email_contratante, img_perfil, vinculo_contratante, sobre_contratante, cep_contratante, tel_contratante) 
    VALUES (null, "'.$nome.'", "'.$login.'", "'.$senha.'", "'.$email.'", "'.$destino.'", null, "'.$sobre.'", "'.$cep.'", "'.$telefone.'")';
    $resultado = $GLOBALS['conn']->query($comando);

    if ($resultado) {
        echo("Cadastrado.");
        header('location: painel-login.php');
    } else {
        echo("Falha ao cadastrar:".$resultado->error);
    }
}

function CadastrarServico($categoria_servico, $nome_servico, $valor_servico, $descricao_servico) {
    global $conn;

    $descricao_servico = $conn->real_escape_string($descricao_servico);

    $comando = 'INSERT INTO tb_servicos (nome_servico, categoria_servico, dia_postagem, descricao_servico, propostas_servico, valor_medio, fk_contratante_servicos, fk_trabalhador_servicos)
VALUES (?, ?, NOW(), ?, "", ?, ?, null)';

    
    $stmt = $conn->prepare($comando);

    if (!$stmt) {
        die('Erro na preparação da consulta: ' . $conn->error);
    }

    $stmt->bind_param("sssis", $nome_servico, $categoria_servico, $descricao_servico, $valor_servico, $_SESSION['account_id']);
    
    if ($stmt->execute()) {
        echo("Cadastrado.");
        exit(); // Importante terminar o script após o redirecionamento
    } else {
        echo("Falha ao cadastrar: " . $stmt->error);
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


<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
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
</script>