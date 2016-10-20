<?php

/**
* Classe responsável por manter métodos de conexão com a base dados
* @author Anthony Tailer
* @author Lucas Lima
**/

class PDOBaladaSegura {

  protected $con = null; // recebe a conexão do banco

  protected $dbType = "mysql";

  protected $host = "localhost";
  protected $user = "root";
  protected $pass = "imroot";
  protected $db   = "op_balada_segura";

  protected $persistent = false;



  public function PDOBaladaSegura($persistent = false){
    if ($persistent != false) {
      $this->persistent = true;
    }
  }

  public function getConnection(){
    try {

      $this->con = new PDO($this->dbType . ":host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass, array(PDO::ATTR_PERSISTENT => $this->persistent));
      return $this->con; //retorna a conexao se bem sucedida

    } catch (PDOException $e) {

      echo "Erro ao conectar: " . $ex->getMessage();

    }
  }

  public function Close(){
      if ($this->con != null) {
        $this->con = null;
      }
  }

}

?>
