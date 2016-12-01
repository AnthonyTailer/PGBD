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
$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();

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
      $qtde = $conex->executeMultiQuery($query);
      echo "Dados APAGADOS com sucesso!";
    } catch (Exception $e) {
      echo "Error";
    }
  }

?>