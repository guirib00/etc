<main class="intro-container">

    <section class="jobs-container font-medium-size text-black third-gray-background shadow">
        <div class="title-post">
            <h1>Publique um serviço</h1>
        </div>
        <form action="" method="post" class="post-service-form">
            <div class="description-post grid-item painel-area">
                <label for="service-categoria">Categoria</label>
                <input type="text" class="form-control" name="categoria-servico" placeholder="Digite a categoria" required autocomplete="on"></input>
                
                <label for="service-name">Nome serviço</label>
                <input type="text" class="form-control" name="nome-servico" placeholder="Digite um nome para o serviço"></input>

                <label>Qual valor médio deseja pagar?</label>
                <input type="text" class="form-control" name="valor" placeholder="Digite o valor" required autocomplete="on"></input>

                <label>Descrição do serviço</label>
                <textarea type="text" class="form-control" name="descricao-servico" placeholder="Digite a descrição"></textarea>
            </div>

            <button class="button button-secondary">Publicar serviço</button>
        </form>

    </section>

    

</main>

