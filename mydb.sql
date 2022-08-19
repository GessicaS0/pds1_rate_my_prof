SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
   `email` VARCHAR(45) NOT NULL,
   `senha` VARCHAR(45) NOT NULL,
  `tipo_user` VARCHAR(1) NOT NULL,
   `idade` DATE NOT NULL,
  `faculdade` VARCHAR(45) NOT NULL,
  `curso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Publicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Publicacao` (
  `idPublicacao` INT NOT NULL AUTO_INCREMENT,
  `nome_prof` VARCHAR(45) NOT NULL,
  `email_prof` VARCHAR(45) NOT NULL,
  `data` DATETIME NOT NULL,
  `titulo` VARCHAR(30) NOT NULL,
  `descricao` VARCHAR(280) NOT NULL,
  `ministrou_disciplina` VARCHAR(1) NOT NULL,
  `likes` INT DEFAULT NULL,
  `User_idUser` INT NOT NULL,
  PRIMARY KEY (`idPublicacao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Comentario` (
  `idComentario` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(180) NOT NULL,
  `Publicacao_idPublicacao` INT NOT NULL,
  `User_idUser` INT NOT NULL,
  `curtida` INT DEFAULT NULL,
  `data` DATETIME NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idComentario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`FAQ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FAQ` (
  `idFAQ` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(280) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `User_idUser` INT NOT NULL,
  PRIMARY KEY (`idFAQ`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PROF_UNI`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`PROF_UNI` (
  `idProf_Uni` INT NOT NULL AUTO_INCREMENT,
  `nome_prof` VARCHAR(45) NOT NULL,
  `nome_uni` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(85) NOT NULL,
  `User_idUser` INT NOT NULL,
  PRIMARY KEY (`idProf_Uni`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- -----------------------------------------------------
-- Insert `User`
INSERT INTO `user`(`idUser`, `nome`, `email`, `senha`, `tipo_user`, `idade`, `faculdade`, `curso`)
VALUES ('1','Maria Luzia','marialu@gmail.com','123456','A','2002-28-05','Universidade Federal do Hawaii'
,'Letras');

INSERT INTO `user`(`idUser`, `nome`, `email`, `senha`, `tipo_user`, `idade`, `faculdade`, `curso`)
VALUES ('2','Bianca Ribeiro','biancarib@gmail.com','123','P','2010-20-01','Universidade Federal de Floripa'
,'Ciência da Computação');

INSERT INTO `user`(`idUser`, `nome`, `email`, `senha`, `tipo_user`, `idade`, `faculdade`, `curso`)
VALUES ('3','José Carlos','josec@hotmail.com','1234','A','2012-05-01','Universidade Federal de Minas Gerais'
,'Engenharia da Computação');

INSERT INTO `user`(`idUser`, `nome`, `email`, `senha`, `tipo_user`, `idade`, `faculdade`, `curso`)
VALUES ('4','Mateus Pedro','mtp@hotmail.com','987654','P','2021-01-01','Universidade Federal do Amazonas'
,'Sistemas de Informação');
-- -----------------------------------------------------
-- Insert `PROF_UNI`
INSERT INTO `prof_uni`(`idProf_Uni`, `nome_prof`, `nome_uni`, `endereco`, `User_idUser`) VALUES 
('1','Lúcio Mauro','Universidade Federal de Juiz de Fora','Rua 10 bairro das flores','1');

INSERT INTO `prof_uni`(`idProf_Uni`, `nome_prof`, `nome_uni`, `endereco`, `User_idUser`) VALUES 
('2','Dercy Gonçalves','PUC minas','Av das Mangabeiras 15','2');

INSERT INTO `prof_uni`(`idProf_Uni`, `nome_prof`, `nome_uni`, `endereco`, `User_idUser`) VALUES 
('3','Ana Carolina','Universidade Federal de Jacarépagua','Rua das Azaleias','3');

INSERT INTO `prof_uni`(`idProf_Uni`, `nome_prof`, `nome_uni`, `endereco`, `User_idUser`) VALUES 
('4','Tulla Lima','Universidade Federal da Bahia','Rua vicente maria bairro sul','4');

-- -----------------------------------------------------
-- Insert `Publicacao`
INSERT INTO `publicacao`(`idPublicacao`, `nome_prof`, `email_prof`, `data`, `titulo`, `descricao`, 
`ministrou_disciplina`, `likes`, `User_idUser`)
VALUES ('1','Lúcio Mauro','lucio-mauro1@gmail.com','NULL','Melhor professor','Dúvidas retiradas, professor tranquilo',
'S','[value-8]','1');

INSERT INTO `publicacao`(`idPublicacao`, `nome_prof`, `email_prof`, `data`, `titulo`, `descricao`, 
`ministrou_disciplina`, `likes`, `User_idUser`) 
VALUES ('2','Maria do Carmo','maria_carmo@bol.com','NULL','Piores aulas que já tive','Nota 0',
'S','[value-8]','2');

INSERT INTO `publicacao`(`idPublicacao`, `nome_prof`, `email_prof`, `data`, `titulo`, `descricao`, 
`ministrou_disciplina`, `likes`, `User_idUser`) 
VALUES ('3','Daniele marcondes','dm10@gmail.com','NULL','Insuportável','Sem noção, super ignorante',
'S','[value-8]','3');

INSERT INTO `publicacao`(`idPublicacao`, `nome_prof`, `email_prof`, `data`, `titulo`, `descricao`, 
`ministrou_disciplina`, `likes`, `User_idUser`) 
VALUES ('4','Ketlen Mirella','mirellak@yahoo.com','NULL',' Professor sem nenhuma didática','Assisti uma aula e não consegui mais',
'S','[value-8]','4');
-- -----------------------------------------------------
-- Insert `FAQ`
INSERT INTO `faq`(`idFAQ`, `descricao`, `nome`, `email`, `User_idUser`)
 VALUES ('1','A universidade federal de uberlância oferece cursos gratuitos de robotica ','Bianca Ribeiro','biancarib@gmail.com','2');




