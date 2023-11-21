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
        var_dump($_SESSION);
        header("location: index.php");
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

        var_dump($_SESSION);
        header("location: index.php");
        return true; // Login contratante bem-sucedido
    }

    return false; // Usuário não encontrado
}

function CadastrarTrabalhador($nome, $email, $especializacao, $sobre, $cep, $telefone, $login, $senha) {
    $comando = 'INSERT INTO tb_trabalhadores (id_trabalhador, nome_trabalhador, login_trabalhador, senha_trabalhador, email_trabalhador, especializacao_trabalhador, sobre_trabalhador, escolaridade_trabalhador, cep_trabalhador, tel_trabalhador)
    VALUES (null, "'.$nome.'", "'.$login.'", "'.$senha.'", "'.$email.'", "'.$especializacao.'", "'.$sobre.'", null, "'.$cep.'", "'.$telefone.'")';
    $resultado = $GLOBALS['conn']->query($comando);
    
    if ($resultado) {
        echo("Cadastrado.");
        header('location: painel-login.php');
    } else {
        echo("Falha ao cadastrar:".$resultado->error);
        echo $comando;
    }
}

function CadastrarContratante($nome, $email, $sobre, $cep, $telefone, $login, $senha) {
    $comando = 'INSERT INTO tb_contratantes (id_contratante, nome_contratante, login_contratante, senha_contratante, email_contratante, img_perfil, vinculo_contratante, sobre_contratante, cep_contratante, tel_contratante) 
    VALUES (null, "'.$nome.'", "'.$login.'", "'.$senha.'", "'.$email.'", null, null, "'.$sobre.'", "'.$cep.'", "'.$telefone.'")';
    $resultado = $GLOBALS['conn']->query($comando);

    if ($resultado) {
        echo("Cadastrado.");
        header('location: painel-login.php');
    } else {
        echo("Falha ao cadastrar:".$resultado->error);
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
