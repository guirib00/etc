<?php
// Verifica se o usuário está autenticado
if (isset($_SESSION['account_name'])) {
    $loggedIn = true;
    $username = $_SESSION['account_name'];
} else {
    $loggedIn = false;
}

if (isset($_SESSION['type'])) {
    $userType = $_SESSION['type'];
} else {
    $userType = ''; // ou qualquer valor padrão que faça sentido para sua lógica
}

var_dump($userType);
?>

<nav class="navbar shadow navbar-profile third-gray-background">
    <section class="second-gray-background">
        <section class="logo-image">
            <a href="index.php"><img src="./views/images/main_logo_alt.png" alt="ETC Logo."></a>
        </section>
        <section class="navbar-links navbar-profile-links">
            <ul class="third-gray-background">
                <li><a href="index.php" class="shadow">Pagina Inicial</a></li>
                <?php if ($userType == 'trabalhador') { ?>
                    <li><a href="jobs.php" class="shadow">Trabalhos</a></li>
                <?php } elseif ($userType == 'contratante') { ?>
                    <li><a href="post-jobs.php" class="shadow">Postar serviço</a></li>
                <?php }?>
                <?php if ($userType == 'trabalhador') { ?>
                    <li><a href="profile-trabalhador.php" class="shadow">Perfil</a></li>
                <?php } elseif ($userType == 'contratante') { ?>
                    <li><a href="profile-contratante.php" class="shadow">Perfil</a></li>
                <?php }?>
                <li><a href="#.php" class="shadow">Conexões</a></li>
                <li><a href="#" class="shadow">Histórico</a></li>
            </ul>
            
            <ul class="navbar-profile-links-logout">
                <hr class="thin-line">
                <li><a onclick="showConfirmation()">Sair</a></li>

                <div id="blur-overlay"></div>
                <div id="saida" class="box1 invisible">
                    <h1>Quer mesmo sair Sair?</h1>
                    <a href="./modules/logout.php">Confirmar</a>    
                    <a onclick="cancel()">Cancelar</a>
                </div>
            </ul>
        </section>
    </section>
</nav>

<script>
    function showConfirmation() {
        document.getElementById('blur-overlay').style.display = 'block';
        document.getElementById('saida').classList.remove('invisible');
    }

    function cancel() {
        document.getElementById('blur-overlay').style.display = 'none';
        document.getElementById('saida').classList.add('invisible');
    }
</script>
