<!DOCTYPE html>
<html>
<head>

    <?php

        include("modules/meta.php");

        include("views/favicon.php");

        include("views/fonts.php");
        
        include("views/styles.php");

        include("modules/scripts.php");

    ?>

    <title>ETC - Eu Também Construo</title>

</head>

<body>

<section class="container second-gray-background">

    <?php

    if($_GET) {

        if($_GET['id']) {
            include('./modules/conexao.php');
            CheckarPerfil("gu@gu.com");
        }

    include("components/navbar-profile.php");

    /* include("components/intro.php"); */

    include("components/profile-overview.php");

    /* include("components/app-ratings.php"); */

    include("components/profile-connections.php");

    /* include("components/footer.php"); */

    } else {
    header("location: index.php");    
    }

    ?>

</section>

</body>
</html>