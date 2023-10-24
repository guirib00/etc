<?php

?>

<nav class="navbar shadow">

    <section class="logo-image">
        <a href="index.php"><img src="./views/images/main_logo.png" alt="ETC Logo."></a>
    </section>

    <section class="navbar-links">

        <ul>

            <li><a href="servicos.php">Serviços &#709;</a></li>
            <li><a href="seguranca.php">Segurança &#709;</a></li>
            <li><a href="suporte.php">Suporte &#709;</a></li>
        
        </ul>

        <section class="navbar-login">

        <?php   
                if(!isset($_SESSION['account_name'])) { ?> 
                    <a href="painel-login.php"> <button class="button button-secondary shadow"> Entrar </button> </a>
        <?php   
                } 
        ?>

        <?php
                if(isset($_SESSION['account_name'])) { ?>
                    <a href="profile.php?id=<?php echo $_SESSION['account_id']; ?>"> <button class="button button-secondary shadow"> <?php
                        echo $_SESSION['account_name'];
                    ?>
                    </button> </a>   
        <?php 
                }            
        ?>


        </section>

    </section>

</nav>