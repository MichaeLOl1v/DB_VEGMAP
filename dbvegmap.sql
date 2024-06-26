CREATE DATABASE vegmap;

USE vegmap;

CREATE TABLE usuario(
idusuario TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome VARCHAR(30) NOT NULL,
telefone VARCHAR(15) NOT NULL,
email VARCHAR(50) NOT NULL,
senha VARCHAR(25) NOT NULL
);

CREATE TABLE usuariopc(
idusuarioPC TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nomePC VARCHAR(30) NOT NULL,
cnpj INT NOT NULL,
telefonePC VARCHAR(15) NOT NULL,
emailPC VARCHAR(50) NOT NULL,
senhaPC VARCHAR(25) NOT NULL
);

CREATE TABLE estabelecimento(
idestab TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nome_estab VARCHAR(30) NOT NULL,
endereco VARCHAR(40) NOT NULL,
telefone_estab VARCHAR(15) NOT NULL,
descricaoestab VARCHAR(320) NOT NULL,
idusuarioPC TINYINT NOT NULL,
tipo VARCHAR(20) NOT NULL,

FOREIGN KEY (idusuarioPC) REFERENCES usuariopc(idusuarioPC)
);

CREATE TABLE produto(
idprodu TINYINT PRIMARY KEY AUTO_INCREMENT,
nomeprodu VARCHAR(20) NOT NULL,
tipoprodu VARCHAR(20) NOT NULL,
medidaprodu VARCHAR(10) NOT NULL,
saborprodu VARCHAR(15) NULL
);

CREATE TABLE avaliacao(
idavaliacao TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nota INT NOT NULL,
comentario VARCHAR(300) NULL,
idestab TINYINT NOT NULL,

FOREIGN KEY (idestab) REFERENCES estabelecimento (idestab) 
);

CREATE TABLE avaliacaop(
idavaliacaop TINYINT PRIMARY KEY AUTO_INCREMENT NOT NULL,
notap INT NOT NULL,
comentariop VARCHAR(300) NULL,
idprodu TINYINT NOT NULL,

FOREIGN KEY (idProdu) REFERENCES produto (idProdu)
);

INSERT INTO usuario (idusuario, nome, telefone, email, senha)
VALUES (NULL, 'Mike', '11971653287', '@MIKE', '123');