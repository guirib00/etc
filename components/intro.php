<?php
if (isset($_SESSION['account_name'])) {
    $loggedIn = true;
    $username = $_SESSION['account_name'];
} else {
    $loggedIn = false;
}
?>

<main class="intro-container">

    <section class="intro-background shadow">

        <img class="gray-filter" src="./views/images/background-one.png" alt="Construtores em serviço."> 

    </section>

    <section class="intro-content text-shadow ">

        <h1>Construindo seu futuro</h1>

        <h6 class="thin text-justify">

        Somos uma empresa especializada em pesquisa de empregos e recrutamento, 
        dedicada exclusivamente ao setor da Construção Civil.

        </h6>
        <?php
            if($loggedIn == false) { ?> 
            <button class="button button-primary shadow visible"><a href="painel-cadastro.php">Crie uma conta</a></button>
        <?php }?>
        

        <?php
            if($loggedIn == true) { ?>
                  <button class="button button-primary shadow invisible"><a href="painel-cadastro.php">Crie uma conta</a></button>
        <?php }?>
    </section>

</main>
