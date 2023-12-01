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

<main class="intro-container  height-full">
<section class="intro-source font-medium-size shadow text-black third-gray-background">
    <div class="search-icon" style="display: inline-block; vertical-align: middle; margin-left: 4rem;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>
    <div class="source" style="display: inline-block;">
        <h1>Pesquisar Serviços</h1>
    </div>
    <hr class="line-jobs" style="margin-left: 3rem; width: 20rem;height:0.15rem;">
    
</section>


<section class="jobs-container font-medium-size text-black third-gray-background shadow">

           <h1 class="h1-services">Serviços recomendados</h1>
           <hr class="line-jobs">



<?php

$sql = "SELECT * FROM tb_servicos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nome_service = $row['nome_servico'];
        $categoria_service = $row['categoria_servico'];
        $endereco_service = $row['endereco_servico'];
        $id_contratante = $row['fk_contratante_servicos'];

        $sql_contratante = "SELECT * FROM tb_contratantes WHERE id_contratante = $id_contratante";
        $result_contratante = $conn->query($sql_contratante);

        if ($result_contratante->num_rows > 0) {
            $row_contratante = $result_contratante->fetch_assoc();
            $imagem_contratante = $row_contratante['img_perfil'];
            $nome_contratante = $row_contratante['nome_contratante'];

            echo "<div class='grid-job'>";
            echo "<div class='circle-job'>";
            echo "<img src='$imagem_contratante' alt='imagem contratante'>";
            echo "</div>";
            echo "<div class='description-job'>";
            echo "<div class='title-job'>";
            echo "<a href='trabalho.php'><p>$nome_service</p></a>";
            echo "</div>";
            echo "<div class='contractor'>";
            echo "<p>$nome_contratante</p>";
            echo "</div>";
            echo "<div class='place'>";
            echo "<p>$endereco_service</p>"; 
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
} else {
    echo "Nenhum serviço encontrado.";
}
?>



    </section>

    

</main>

           

