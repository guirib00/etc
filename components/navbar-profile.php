<nav class="navbar shadow navbar-profile third-gray-background">
    
    <section class="second-gray-background">

        <section class="logo-image">
            <a href="index.php"><img src="./views/images/main_logo_alt.png" alt="ETC Logo."></a>
        </section>

        <section class="navbar-links navbar-profile-links">

            <ul class="third-gray-background">

                <li><a href="index.php" class="shadow">Pagina Inicial</a></li>
                <li><a href="profile.php" class="shadow button-active">Perfil</a></li>
                <li><a href="#.php" class="shadow">Conexões</a></li>
                <li><a href="#" class="shadow">Histórico</a></li>

            </ul>
            
            <ul class="navbar-profile-links-logout">
            <hr class="thin-line">
                <li><a onclick="logout()">Sair</a></li>

                <div id ="saida" class="box1 invisible">
                    <a href="./modules/logout.php">Confirmar</a>    
                    <a onclick="cancel()">Cancelar</a>
                </div>

            </ul>

        </section>

    </section>

</nav>

<script>
    function logout() {
        document.getElementById('saida').classList.remove('invisible');
    }
    function cancel() {
        document.getElementById('saida').classList.add('invisible');
    }
</script>