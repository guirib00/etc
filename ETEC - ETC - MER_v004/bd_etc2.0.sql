CREATE SCHEMA IF NOT EXISTS `bd_etc2.0` DEFAULT CHARACTER SET utf8 ;
USE `bd_etc2.0` ;

-- -----------------------------------------------------
-- Table `mydb`.`tb_planos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_planos` (
  `id_plano` INT NOT NULL AUTO_INCREMENT,
  `nome_plano` VARCHAR(30) NOT NULL,
  `preco_plano` VARCHAR(10) NOT NULL,
  `descricao_plano` VARCHAR(120) NULL,
  PRIMARY KEY (`id_plano`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_gestores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_gestores` (
  `id_gestor` INT NOT NULL AUTO_INCREMENT,
  `nome_gestor` VARCHAR(60) NULL,
  `login_gestor` VARCHAR(40) NOT NULL,
  `senha_gestor` VARCHAR(60) NOT NULL,
  `email_gestor` VARCHAR(60) NOT NULL,
  `previlegio_gestor` INT NOT NULL,
  `fk_plano` INT NULL,
  `tel_gestor` VARCHAR(20) NULL,
  PRIMARY KEY (`id_gestor`),
  INDEX `id_plano_idx` (`fk_plano` ASC),
  CONSTRAINT `id_plano`
    FOREIGN KEY (`fk_plano`)
    REFERENCES `bd_etc2.0`.`tb_planos` (`id_plano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `mydb`.`tb_contratantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_contratantes` (
  `id_contratante` INT NOT NULL AUTO_INCREMENT,
  `nome_contratante` VARCHAR(60) NOT NULL,
  `login_contratante` VARCHAR(40) NOT NULL,
  `senha_contratante` VARCHAR(60) NOT NULL,
  `email_contratante` VARCHAR(60) NOT NULL,
  `img_perfil` VARCHAR(80) NULL,
  `vinculo_contratante` VARCHAR(30) NULL,
  `sobre_contratante` VARCHAR(180) NULL,
  `cep_contratante` VARCHAR(10) NULL,
  `tel_contratante` VARCHAR(20) NULL,
  PRIMARY KEY (`id_contratante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_trabalhadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_trabalhadores` (
  `id_trabalhador` INT NOT NULL AUTO_INCREMENT,
  `nome_trabalhador` VARCHAR(60) NOT NULL,
  `login_trabalhador` VARCHAR(40) NOT NULL,
  `senha_trabalhador` VARCHAR(60) NOT NULL,
  `email_trabalhador` VARCHAR(60) NOT NULL,
  `img_perfil` VARCHAR(80) NULL,
  `vinculo_trabalhador` VARCHAR(30) NULL,
  `especializacao_trabalhador` VARCHAR(180) NULL,
  `escolaridade_trabalhador` INT NULL,
  `cep_trabalhador` VARCHAR(10) NULL,
  `tel_trabalhador` VARCHAR(20) NULL,
  `fk_plano` INT NULL,
  PRIMARY KEY (`id_trabalhador`),
  INDEX `fk_plano_idx` (`fk_plano` ASC),
  CONSTRAINT `fk_plano`
    FOREIGN KEY (`fk_plano`)
    REFERENCES `bd_etc2.0`.`tb_planos` (`id_plano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_servicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_servicos` (
  `id_servico` INT NOT NULL AUTO_INCREMENT,
  `nome_servico` VARCHAR(100) NOT NULL,
  `status_servico` INT NOT NULL,
  `avaliacao_servico` INT NULL,
  `data_servico` VARCHAR(10) NOT NULL,
  `fk_contratante_servicos` INT NOT NULL,
  `fk_trabalhador_servicos` INT NOT NULL,
  PRIMARY KEY (`id_servico`),
  INDEX `fk_contratante_servicos_idx` (`fk_contratante_servicos` ASC),
  INDEX `fk_trabalhador_servicos_idx` (`fk_trabalhador_servicos` ASC),
  CONSTRAINT `fk_contratante_servicos`
    FOREIGN KEY (`fk_contratante_servicos`)
    REFERENCES `bd_etc2.0`.`tb_contratantes` (`id_contratante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabalhador_servicos`
    FOREIGN KEY (`fk_trabalhador_servicos`)
    REFERENCES `bd_etc2.0`.`tb_trabalhadores` (`id_trabalhador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`tb_mensagens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_mensagens` (
  `id_mensagem` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `conteudo_mensagem` VARCHAR(255) NULL,
  `fk_contratante_mensagem` INT NOT NULL,
  `fk_trabalhador_mensagem` INT NOT NULL,
  `fk_gestor_mensagem` INT NULL,
  INDEX `fk_contratante_mensagem_idx` (`fk_contratante_mensagem` ASC),
  INDEX `fk_trabalhador_mensagem_idx` (`fk_trabalhador_mensagem` ASC),
  INDEX `fk_gestor_mensagem_idx` (`fk_gestor_mensagem` ASC),
  CONSTRAINT `fk_contratante_mensagem`
    FOREIGN KEY (`fk_contratante_mensagem`)
    REFERENCES `bd_etc2.0`.`tb_contratantes` (`id_contratante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabalhador_mensagem`
    FOREIGN KEY (`fk_trabalhador_mensagem`)
    REFERENCES `bd_etc2.0`.`tb_trabalhadores` (`id_trabalhador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gestor_mensagem`
    FOREIGN KEY (`fk_gestor_mensagem`)
    REFERENCES `bd_etc2.0`.`tb_gestores` (`id_gestor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_conexoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_conexoes` (
  `id_conexao` INT NOT NULL AUTO_INCREMENT,
  `fk_contratante_conexoes` INT NULL,
  `fk_trabalhador_conexoes` INT NULL,
  PRIMARY KEY (`id_conexao`),
  INDEX `fk_contratante_conexoes_idx` (`fk_contratante_conexoes` ASC),
  INDEX `fk_trabalhador_conexoes_idx` (`fk_trabalhador_conexoes` ASC),
  CONSTRAINT `fk_contratante_conexoes`
    FOREIGN KEY (`fk_contratante_conexoes`)
    REFERENCES `bd_etc2.0`.`tb_contratantes` (`id_contratante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabalhador_conexoes`
    FOREIGN KEY (`fk_trabalhador_conexoes`)
    REFERENCES `bd_etc2.0`.`tb_trabalhadores` (`id_trabalhador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tb_vagas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_vagas` (
  `id_vagas` INT NOT NULL AUTO_INCREMENT,
  `titulo_vaga` VARCHAR(80) NOT NULL,
  `empresa_vaga` VARCHAR(60) NOT NULL,
  `endereco_vaga` VARCHAR(80) NULL,
  `tipo_contrato` VARCHAR(20) NULL,
  `descricao_vaga` VARCHAR(80) NOT NULL,
  `data_vaga` VARCHAR(10) NOT NULL,
  `fk_contratante_vagas` INT NOT NULL,
  `fk_trabalhador_vagas` INT NULL,
  PRIMARY KEY (`id_vagas`),
  INDEX `fk_contratante_vagas_idx` (`fk_contratante_vagas` ASC),
  INDEX `fk_trabalhador_vagas_idx` (`fk_trabalhador_vagas` ASC),
  CONSTRAINT `fk_contratante_vagas`
    FOREIGN KEY (`fk_contratante_vagas`)
    REFERENCES `bd_etc2.0`.`tb_contratantes` (`id_contratante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabalhador_vagas`
    FOREIGN KEY (`fk_trabalhador_vagas`)
    REFERENCES `bd_etc2.0`.`tb_trabalhadores` (`id_trabalhador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `mydb`.`tb_candidatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_etc2.0`.`tb_candidatos` (
  `id_candidato` INT NOT NULL AUTO_INCREMENT,
  `fk_vaga` INT NOT NULL,
  `fk_trabalhador_candidato` INT NOT NULL,
  `status_candidato` INT NULL,
  PRIMARY KEY (`id_candidato`),
  INDEX `fk_vaga_idx` (`fk_vaga` ASC),
  INDEX `fk_trabalhador_candidato_idx` (`fk_trabalhador_candidato` ASC),
  CONSTRAINT `fk_vaga`
    FOREIGN KEY (`fk_vaga`)
    REFERENCES `bd_etc2.0`.`tb_vagas` (`id_vagas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabalhador_candidato`
    FOREIGN KEY (`fk_trabalhador_candidato`)
    REFERENCES `bd_etc2.0`.`tb_vagas` (`fk_trabalhador_vagas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)