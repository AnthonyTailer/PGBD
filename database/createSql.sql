DROP DATABASE IF EXISTS obras_pac;
CREATE DATABASE IF NOT EXISTS obras_pac;
USE obras_pac;

CREATE TABLE IF NOT EXISTS obras_pac_des(
	id INT,
	idDigs INT,
    titulo VARCHAR(255),
    investimento DECIMAL(16,2),
    uf VARCHAR(255),
    cidade TEXT,
    executor VARCHAR(255),
    orgao VARCHAR(255),
    estagio TINYINT UNSIGNED,
	ciclo DATE,
    selecao DATE,
    conclusao DATE,
    latitude TEXT,
    longitude TEXT,
    emblematica VARCHAR(255),
    observacao VARCHAR(255)
);
