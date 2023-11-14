<!DOCTYPE html>
<html>
<head>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script src="./views/js/questions-suporte.js"></script>

    <?php

        include("modules/conexao.php");

        include("modules/meta.php");

        include("views/favicon.php");

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

    include("components/suporte-overview.php");

    /* include("components/app-ratings.php"); */

    include("components/suporte-questions.php");
    
    include("components/footer.php");

    ?>

</section>

</body>
</html>