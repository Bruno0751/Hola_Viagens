

CREATE DATABASE hola_viagens;

USE hola_viagens;

CREATE TABLE hola_viagens.clientes (
    id_cliente INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(40) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
    email VARCHAR(40) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
    login VARCHAR(30) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
    senha VARCHAR(30) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
    foto BLOB NULL,
    data_nascimento DATE NULL,
    data_registro DATE NOT NULL,
    hora_registro TIME NOT NULL,
    CONSTRAINT pkid_usuario PRIMARY KEY(id_cliente));

CREATE TABLE hola_viagens.vendas (
    id_venda INT AUTO_INCREMENT NOT NULL,
    data_venda DATE NULL,
    nome_vendedor VARCHAR(40) CHARACTER SET UTF8 COLLATE UTF8_UNICODE_CI NULL,
    cliente INT NOT NULL,
    data_registro DATE NOT NULL,
    hora_registro TIME NOT NULL,
    CONSTRAINT pkid_venda PRIMARY KEY(id_venda),
    FOREIGN KEY(cliente) REFERENCES clientes(id_cliente));

INSERT INTO hola_viagens.clientes
VALUES(NULL, 'Bruno Gressler da Silveira', 'brunogressler1@gmail.com', 123, 123, NULL, NULL, NOW(), NOW());

INSERT INTO hola_viagens.vendas
VALUES(NULL, NULL, 'José', 1, NOW(), NOW());