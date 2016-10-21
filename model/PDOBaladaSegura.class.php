<?php

/**
  * Classe responsável por manter métodos de conexão com a base dados
  * @author Anthony Tailer
  * @author Lucas Lima
  * REFERENCE- http://dados.gov.br/dataset/obras-do-pac-programa-de-aceleracao-do-crescimento 
  * ESPECIFIC- http://dados.gov.br/dataset/obras-do-pac-programa-de-aceleracao-do-crescimento/resource/9eaee56d-9343-4d6d-a79b-a554c0095131
  **/

class PDOBaladaSegura {

  protected $conc = null; // recebe a conexão do banco

  protected $dbType = "mysql";

  protected $host = "localhost";
  protected $user = "root";
  protected $pass = "";
  protected $db   = "op_balada_segura";

  public function getConnection(){
    try {

      $this->conc = new PDO($this->dbType . ":host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
      $this->conc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully"."</br>";
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