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
// $desnormalizada = new MagicDesnormalizada();
// $DAODesnormalizada = new DAODesnormalizada();

$output  = array();
$request = $_GET['query'];

if($request == "init"){
  $query = "SELECT COUNT(*) AS QTDE from RECLAMACAO";

  try {
    $qtde = $conex->executeQuery($query);
    echo $qtde->fetch_array(MYSQLI_ASSOC)["QTDE"];
    
  } catch (Exception $e) {
    echo 0;
  }

}

?>