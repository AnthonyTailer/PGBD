<?php
/**
* @author Anthony Tailer
* @author Lucas Lima
*/

function __autoload($classe){
    include_once "../model/{$classe}.class.php";
}

$conex = new MySQLiConsumidor();
$mysqli = $conex->getConnection();

$output  = array();
$request = $_GET['action'];

  if($request == "clear"){
    
    $query = "TRUNCATE RECLAMACAO;";
    $query .= "TRUNCATE PROBLEMA;";
    $query .= "TRUNCATE GRUPO;";
    $query .= "TRUNCATE AREA;";
    $query .= "TRUNCATE EMPRESA;";
    $query .= "TRUNCATE SEGMENTO;";
    $query .= "TRUNCATE CONSUMIDOR;";
    $query .= "TRUNCATE CIDADE;";
    $query .= "TRUNCATE ESTADO;";
    $query .= "TRUNCATE REGIAO;";
    $query .= "TRUNCATE RECLAMACAO_DES";

    try {
      $qtde = qtdeDados();
      $clean = $conex->executeMultiQuery($query);
      echo $qtde["QTDE"]." dados APAGADOS com sucesso!";
    } catch (Exception $e) {
      echo "Error";
    }
  }

  function qtdeDados(){
      $conex2 = new MySQLiConsumidor();
      $select = "SELECT COUNT(*) AS QTDE FROM RECLAMACAO_DES";
      $result = $conex2->executeQuery($select);
      
      $output = $result->fetch_array(MYSQLI_ASSOC);
      return $output;
  }

?>