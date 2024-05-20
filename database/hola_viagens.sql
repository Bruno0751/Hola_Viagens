DROP DATABASE hola_viagens;

DROP TABLE hola_viagens.cliente;

DROP TABLE hola_viagens.venda;

CREATE DATABASE hola_viagens;

USE hola_viagens;

CREATE TABLE hola_viagens.cliente (
id_cliente INT AUTO_INCREMENT NOT NULL,
nome VARCHAR(50) NOT NULL,
email VARCHAR(50) NULL,
login VARCHAR(30) NOT NULL,
senha VARCHAR(30) NOT NULL,
foto BLOB NULL,
data_nascimento DATE NULL,
cpf CHAR(11) NULL,
cnpj CHAR(14) NULL,
data_registro DATE NOT NULL,
hora_registro TIME NOT NULL,
CONSTRAINT pk_id_cliente PRIMARY KEY (id_cliente)
);

INSERT INTO hola_viagens.cliente
VALUES(NULL, 'Bruno Gressler da Silveira', 'brunogressler1@gmail.com', '123', '123', NULL, '1996-03-17', '03154619003', NULL, NOW(), NOW());

DESCRIBE hola_viagens.cliente;

SELECT * FROM hola_viagens.cliente;

CREATE TABLE hola_viagens.venda (
id_venda INT AUTO_INCREMENT NOT NULL,
data_venda DATE NOT NULL,
vendedor VARCHAR(50) NOT NULL,
id_cliente INT NOT NULL,
data_registro DATE NOT NULL,
hora_registro TIME NOT NULL,
CONSTRAINT pk_id_venda PRIMARY KEY(id_venda),
CONSTRAINT fk_id_cliente FOREIGN KEY(id_cliente) REFERENCES hola_viagens.cliente(id_cliente)
);

INSERT INTO hola_viagens.venda
VALUES(NULL, NOW(), 'Seu Madruga', 1, NOW(), NOW());

DESCRIBE hola_viagens.venda;

SELECT tc.nome FROM hola_viagens.venda AS tv
INNER JOIN hola_viagens.cliente AS tc
ON tc.id_cliente = tv.id_cliente;