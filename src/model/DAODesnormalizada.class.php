<?php

/**
* Classe responsável por manter métodos CRUD da tabela desnormalizada
* @author Anthony Tailer
* @author Lucas Lima
**/

require_once 'PDOBaladaSegura.class.php';

class DAODesnormalizada extends PDOBaladaSegura{

  public $conex = null;
  const insertSql = 'INSERT INTO baladaSegura_desnormalizada (data, municipio,endereco, CRVL_recolhida, CNH_recolhida, veiculo_recolhido, veiculo_autuado, recusou_teste_etiometro, autuado_teste_etiometro, qtd_autuacoes, tipo_veiculo, marca_modelo_veiculo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

  public function __construct(){
        $this->conex = PDOBaladaSegura::getConnection();
  }

  /*
  * Inserção de novos dados na tabelas desnormalizada
  */

  public function insertDesnormalizada($desnormalizada){
    try {
      $stmt = $this->conex->prepare(self::insertSql);

      $stmt->bindValue(1, $desnormalizada->data);
      $stmt->bindValue(2, $desnormalizada->municipio);
      $stmt->bindValue(3, $desnormalizada->endereco);
      $stmt->bindValue(4, $desnormalizada->CRVL_recolhida);
      $stmt->bindValue(5, $desnormalizada->CNH_recolhida);
      $stmt->bindValue(6, $desnormalizada->veiculo_recolhido);
      $stmt->bindValue(7, $desnormalizada->veiculo_autuado);
      $stmt->bindValue(8, $desnormalizada->recusou_teste_etiometro);
      $stmt->bindValue(9, $desnormalizada->autuado_teste_etiometro);
      $stmt->bindValue(10, $desnormalizada->qtd_autuacoes, PDO::PARAM_INT);
      $stmt->bindValue(11, $desnormalizada->tipo_veiculo);
      $stmt->bindValue(12, $desnormalizada->marca_modelo_veiculo);

      $stmt->execute();
      $this->conex = null;

    } catch (Exception $e) {
      echo "Erro ao Inserir Desnormalizada: ". $e->getMessage();
    }

  }
}


?>
