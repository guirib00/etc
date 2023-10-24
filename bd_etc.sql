CREATE DATABASE bd_etc;

USE bd_etc;

CREATE TABLE tb_planos(
  id_plano INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_plano VARCHAR(30) NOT NULL,
  preco_plano VARCHAR(10) NOT NULL,
  descricao_plano VARCHAR(120) NULL
  );
  
  CREATE TABLE tb_contratantes (
  id_contratante INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_contratante VARCHAR(60) NOT NULL,
  login_contratante VARCHAR(40) NOT NULL,
  senha_contratante VARCHAR(60) NOT NULL
  );
  
  CREATE TABLE tb_gestores(
  id_gestor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_gestor VARCHAR(60) NULL,
  login_gestor VARCHAR(40) NOT NULL,
  senha_gestor VARCHAR(60) NOT NULL,
  previlegio_gestor INT NOT NULL,
  fk_plano INT NULL,
	CONSTRAINT fk_tb_gestores_tb_planos
    FOREIGN KEY (fk_plano)
    REFERENCES tb_planos(id_plano)
);
  
  CREATE TABLE tb_trabalhadores (
  id_trabalhador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_trabalhador VARCHAR(60) NOT NULL,
  login_trabalhador VARCHAR(40) NOT NULL,
  senha_trabalhador VARCHAR(60) NOT NULL,
  fk_plano INT,
  CONSTRAINT fk_plano
    FOREIGN KEY (fk_plano)
    REFERENCES tb_planos (id_plano)
);

CREATE TABLE tb_servicos (
  id_servico INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_servico VARCHAR(100) NOT NULL,
  status_servico INT NOT NULL,
  avaliacao_servico INT NULL,
  fk_contratante INT NOT NULL,
  fk_trabalhador_servicos INT NOT NULL,
  CONSTRAINT fk_contratante
    FOREIGN KEY (fk_contratante)
    REFERENCES tb_contratantes (id_contratante),
  CONSTRAINT fk_trabalhador_servicos
    FOREIGN KEY (fk_trabalhador_servicos)
    REFERENCES tb_trabalhadores (id_trabalhador)
);

CREATE TABLE tb_mensagens (
  id_mensagem INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  conteudo_mensagem VARCHAR(255) NULL,	
  fk_contratante_mensagem INT NOT NULL,
  fk_trabalhador_mensagem INT NOT NULL,
  fk_gestor_mensagem INT NULL,
  CONSTRAINT fk_contratante_mensagem
    FOREIGN KEY (fk_contratante_mensagem)
    REFERENCES tb_contratantes (id_contratante),
  CONSTRAINT fk_trabalhador_mensagem
    FOREIGN KEY (fk_trabalhador_mensagem)
    REFERENCES tb_trabalhadores (id_trabalhador),
  CONSTRAINT fk_gestor_mensagem
    FOREIGN KEY (fk_gestor_mensagem)
    REFERENCES tb_gestores (id_gestor)
);