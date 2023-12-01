<!DOCTYPE html>
<html>

<head>

    <?php
    include("views/favicon.php");

    include("modules/conexao.php");

    include("modules/meta.php");


    include("views/fonts.php");

    include("views/styles.php");

    include("modules/scripts.php");

    ?>

    <title>ETC - Eu Também Construo</title>

</head>

<body>

    <section class="container">

        <?php

        include("components/navbar.php");

        /* include("components/intro.php"); */

        include("components/servicos-overview.php");

        /* include("components/app-ratings.php"); */

        include("components/footer.php");

        ?>

    </section>

</body>

</html>