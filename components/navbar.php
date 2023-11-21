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

<nav class="navbar shadow">
    <section class="logo-image">
        <a href="index.php"><img src="./views/images/main_logo.png" alt="ETC Logo."></a>
    </section>

    <section class="navbar-links">
        <ul>
            <li><a href="servicos.php">Serviços</a></li>
            <li><a href="seguranca.php">Segurança</a></li>
            <li><a href="suporte.php">Suporte</a></li>
        </ul>

        <section class="navbar-login">
            <?php if ($loggedIn == false) { ?>
                <a href="painel-login.php">
                    <button class="button button-secondary shadow"> Entrar </button>
                </a>
            <?php } ?>

            <?php if ($loggedIn == true) { ?>
                <?php if ($userType == 'trabalhador') { ?>
                    <!-- Botão de perfil para trabalhador -->
                    <a href="profile.php?id=<?php echo $_SESSION['account_id']; ?>">
                        <button class="button button-secondary button-perfil shadow" style="padding: 0.5rem 2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"> <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
                        </button>
                    </a>
                <?php } elseif ($userType == 'contratante') { ?>
                    <!-- Botão de perfil para contratante -->
                    <div class="dropdown" style="position: relative;">
                        <button onclick="showContractorProfile()" class="button button-secondary button-perfil shadow" style="padding: 0.5rem 2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"> <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
                        </button>
                        <div id="contractorProfile" class="dropdown-content text-center" style="display: none; position: absolute; background-color: #f9f9f9; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                            <p id="contractorName" style="margin: 5px;"><?php echo $username; ?></p>
                            <a id="logoutLink" href="./modules/logout.php">Sair</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </section>
    </section>
</nav>

<script>
    function showContractorProfile() {
        var profileDropdown = document.getElementById("contractorProfile");

        if (profileDropdown.style.display === "none") {
            profileDropdown.style.display = "block";
        } else {
            profileDropdown.style.display = "none";
        }
    }
</script>
