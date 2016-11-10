<?php

function __autoload($classe){
    include_once "../model/{$classe}.class.php";
}

$conex = new MySQLiConsumidor();
$mysqli = $conex->getConnection();
$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();

$output  = array();
$request = $_GET['tabela'];

if ($request == "desnormalizada") {

  $query = "SELECT * FROM RECLAMACAO_DES LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output,
      array(
        $row["REGIAO"],$row["UF"],$row["CIDADE"],
        $row["SEXO"],$row["FAIXAETARIA"],$row["ANOABERTURA"],
        $row["MESABERTURA"],$row["DATAABERTURA"],$row["DATARESPOSTA"],
        $row["DATAFINALIZACAO"], $row["TEMPORESPOSTA"],$row["NOMEFANTASIA"],
        $row["SEGMENTOMERCADO"],$row["AREA"],$row["ASSUNTO"],
        $row["GRUPOPROBLEMA"],$row["PROBLEMA"],$row["COMOCOMPROU"],
        $row["PROCUROUEMPRESA"],$row["RESPONDIDA"],$row["SITUACAO"],
        $row["AVALIACAO"],$row["NOTACONSUMIDOR"]
      )
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}elseif ($request == "regiao") {
  $query = "SELECT * FROM REGIAO LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["IDREGIAO"],$row["NOME"])
    );
  }
}elseif ($request == "estado") {
  $query = "SELECT E.IDESTADO, E.NOME, R.NOME as REGIAO FROM ESTADO E NATURAL JOIN REGIAO R LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["IDESTADO"],$row["NOME"], $row["REGIAO"])
    );
  }
}else{
  
}
?>
