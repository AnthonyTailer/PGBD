<?php

/**
  * Classe responsável por manter métodos de conexão com a base dados
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

class PDOConsumidor {

  protected $conc = null; // recebe a conexão do banco

  protected $dbType = "mysql";

  protected $host = "localhost";
  protected $user = "root";
  protected $pass = "";
  protected $db   = "reclamacoes_consumidor";

  public function getConnection(){
    try {

      $this->conc = new PDO($this->dbType . ":host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
      $this->conc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Conexão efetuada com sucesso"."</br>";
      return $this->conc; //retorna a conexao se bem sucedida

    } catch (PDOException $e) {

      echo "Erro ao conectar: ". $e->getMessage();

    }
  }

  public function Close(){
      if ($this->conc != null) {
        $this->conc = null;
      }
  }

}

?>
