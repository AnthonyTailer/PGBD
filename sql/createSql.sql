DROP DATABASE IF EXISTS op_balada_segura;
CREATE DATABASE IF NOT EXISTS op_balada_segura;
USE op_balada_segura;

CREATE TABLE IF NOT EXISTS baladaSegura_desnormalizada(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data DATE NOT NULL,
  municipio VARCHAR(255) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  CRVL_recolhida CHAR(2),
  CNH_recolhida CHAR(2),
  veiculo_recolhido CHAR(2),
  veiculo_autuado CHAR(2),
  recusou_teste_etiometro CHAR(2),
  autuado_teste_etiometro CHAR(2),
  qtd_autuacoes INT,
  tipo_veiculo VARCHAR(30),
  marca_modelo_veiculo VARCHAR(255)
);
