<?php

/**
  * Classe responsável por manter métodos de conexão com a base dados
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

class MySQLiConsumidor {

  protected $conc; // recebe a conexão do banco
  protected $host = "127.0.0.1";
  protected $user = "root";
  protected $pass = "";
  protected $db   = "reclamacoes_consumidor";

  public function getConnection(){
    try {

      $this->conc = new mysqli($this->host, $this->user, $this->pass, $this->db);

      //echo "Conexão efetuada com sucesso"."</br>";
      return $this->conc; //retorna a conexao se bem sucedida

    } catch (Exception $e) {

      echo "Erro ao conectar: ". $e->getMessage();
      $this->conc->close();

    }
  }

  public function executeQuery($query) {
			$this->conc = $this->getConnection();
			$result = $this->conc->query($query);
			return $result;
		}

}

?>
