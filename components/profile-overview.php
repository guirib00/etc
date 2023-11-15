<?php
// Verifica se o usuário está autenticado
if (isset($_SESSION['account_name'])) {
    $loggedIn = true;
    $username = $_SESSION['account_name'];
    $especializacao = $_SESSION['account_especializacao'];
} else {
    $loggedIn = false;
}
?>

<main class="intro-container profile-container">

    <section class="intro-content font-medium-size text-black profile-section shadow third-gray-background">

        <aside class="profile-image">
            <img class="shadow" src="./views/images/roberto-nogueira.png">
        </aside>

        <section class="profile-content">

        <aside class="profile-about">

            <h2><?php echo "$username"; ?></h2>
            <p><?php echo "$especializacao"; ?></p>

            <hr class="thin-line">

            <p class="light text-justify">

            Profissional dedicado e experiente em oferecer soluções hidráulicas e elétricas confiáveis para residências e empresas. Combinando habilidades técnicas sólidas com um compromisso com a segurança e a qualidade do serviço, estou pronto para enfrentar desafios complexos e entregar resultados excepcionais. Minha paixão por garantir ambientes seguros e funcionais impulsiona minha busca contínua por aprimorar meus conhecimentos e habilidades. 

            </p>

        </aside>

        <hr class="thin-line">
        
            <p>
                <strong> Perfil muito bem avaliado na plataforma com: <span class="text-yellow">278</span> avaliações!</strong>
            </p>

        </section>

    </section>

</main>