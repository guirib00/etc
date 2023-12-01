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
    $userType = '';
}

var_dump($userType);

$id_from_url = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_from_url === null) {
    echo "Nenhum ID foi encontrado na URL.";
} else {
    $sql = "SELECT * FROM tb_servicos WHERE id_servico = $id_from_url";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nome_service = $row['nome_servico'];
                $categoria_service = $row['categoria_servico'];
                $endereco_service = $row['endereco_servico'];
                $descricao_service = $row['descricao_servico'];
                $valor_medio = $row['valor_medio'];
                $data_postagem = $row['dia_postagem'];
                $id_contratante = $row['fk_contratante_servicos'];

                $sql_contratante = "SELECT * FROM tb_contratantes WHERE id_contratante = $id_contratante";
                $result_contratante = $conn->query($sql_contratante);

                if ($result_contratante) {
                    if ($result_contratante->num_rows > 0) {
                        $row_contratante = $result_contratante->fetch_assoc();
                        $imagem_contratante = $row_contratante['img_perfil'];
                        $nome_contratante = $row_contratante['nome_contratante'];
                    } else {
                        echo "Nenhum resultado encontrado para tb_contratantes com id_contratante = $id_contratante";
                    }
                } else {
                    echo "Erro na consulta SQL para tb_contratantes: " . $conn->error;
                }
            }
        } else {
            echo "Nenhum serviço encontrado com ID = $id_from_url";
        }
    } else {
        echo "Erro na consulta SQL para tb_servicos: " . $conn->error;
    }
}
?>

    <main class="intro-container">

        <section class="jobs-container font-medium-size text-black third-gray-background shadow">
            <a href="jobs.php"><button type="button" class="button-return button-secondary button" style="margin-top: -0rem;">Voltar</button></a>

            <div class="grid-trabalho">

                    <div class="circle-job">
                        <img src="<?php echo $imagem_contratante;?>" alt="imagem contratante">
                    </div>
                    <div class="description-trabalho">
                        <div class="title-trabalho">
                            <p><?php echo $nome_service; ?></p>
                        </div>
                        <div class="dat">
                            <p><?php echo $data_postagem; ?></p>
                        </div>
                        <div class="contractor">
                            <p><?php echo $nome_contratante; ?></p>
                        </div>
                        <div class="place">
                            <p><?php echo $endereco_service; ?></p>
                        </div>
                    </div>
            </div>

            <div class="description-service">
                    <h2>Descrição do serviço: </h2>
                    <div class="enunciado-service">
                        <p><?php echo $descricao_service; ?></p>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>

                <div class="dados-service text-center">
                    <h1>Relação do serviço</h1>
                    <p>Categoria: <?php echo $categoria_service; ?></p>
                    <p>Candidatos: 7</p>
                    <p>Valor médio pedido pelo contratante: R$<?php echo $valor_medio; ?></p>
                </div>

                <br>

                <div class="text-center">
                    <button class="button button-secondary">Candidatar-se</button>
                </div>

        </section>

        

    </main>

