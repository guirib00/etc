<?php
// Verifica se o usuário está autenticado
if (isset($_SESSION['account_name'])) {
    $loggedIn = true;
    $username = $_SESSION['account_name'];
    $especializacao = $_SESSION['account_especializacao'];
    $sobre = $_SESSION['account_sobre'];
    $destino = $_SESSION['account_imagem'];
} else {
    $loggedIn = false;
}
?>

<main class="intro-container profile-container">

    <section class="intro-content font-medium-size text-black profile-section shadow third-gray-background">

        <aside class="profile-image">
            <img class="shadow" src="<?php echo "$destino"; ?>">
        </aside>

        <section class="profile-content">

            <aside class="profile-about">

                <h2 style="margin-top: 4rem;">
                    <?php echo "$username"; ?>
                </h2>
                <p>
                    <?php echo "$especializacao"; ?>
                </p>

                <hr class="thin-line">

                <p class="light font-small-size text-justify">

                    <?php echo "$sobre"; ?>

                </p>

                <br>


            </aside>

            <p>
                <strong> Perfil muito bem avaliado na plataforma com: <span class="text-yellow">0</span>
                    avaliações!</strong>
            </p>

        </section>

    </section>

</main>