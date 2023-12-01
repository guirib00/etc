<?php

if ($_POST) {
    $categoria_servico = $_POST['categoria-servico'];
    $nome_servico = $_POST['nome-servico'];
    $valor_servico = $_POST['valor'];
    $endereco_servico = $_POST['endereco'];
    $descricao_servico = $_POST['descricao-servico'];
    CadastrarServico($categoria_servico, $nome_servico, $valor_servico, $endereco_servico, $descricao_servico);
}

?>

<main class="intro-container">

    <section class="jobs-container font-medium-size text-black third-gray-background shadow">
        <div class="title-post">
            <h1>Publique um serviço</h1>
        </div>
        <form action="" method="post" class="post-service-form" id="completeForm">
            <div class="description-post grid-item painel-area">
                <label for="service-categoria">Categoria</label>
                <input type="text" class="form-control" name="categoria-servico" placeholder="Digite a categoria"
                    required autocomplete="on"></input>

                <label for="service-name">Nome serviço</label>
                <input type="text" class="form-control" name="nome-servico"
                    placeholder="Digite um nome para o serviço"></input>

                <label>Qual valor médio deseja pagar?</label>
                <input type="text" class="form-control" name="valor" placeholder="Digite o valor" required
                    autocomplete="on"></input>

                <label>Endereço</label>
                <input type="text" class="form-control" name="endereco" placeholder="Digite o endereço" required
                    autocomplete="on"></input>

                <label>Descrição do serviço</label>
                <textarea type="text" class="form-control" name="descricao-servico"
                    placeholder="Digite a descrição"></textarea>
            </div>

            <button onclick="submitForm()" type="button" class="button button-secondary" id="cadastrar">Publicar
                serviço</button>
        </form>

    </section>



</main>


<script>
    function submitForm() {
        document.getElementById("completeForm").submit();
    }
</script>