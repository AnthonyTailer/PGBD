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

  echo "{
          \"data\":".json_encode($output)."
        }";

}elseif ($request == "estado") {
  $query = "SELECT E.IDESTADO, E.NOME, R.NOME as REGIAO FROM ESTADO E NATURAL JOIN REGIAO R LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["IDESTADO"],$row["NOME"], $row["REGIAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}elseif ($request == "cidade") {
  $query = "SELECT C.NOME, E.NOME as ESTADO FROM CIDADE C NATURAL JOIN ESTADO E LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["NOME"],$row["ESTADO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "consumidor"){
  $query = "SELECT C.SEXO, C.FAIXAETARIA, CI.NOME as NCIDADE FROM CONSUMIDOR C NATURAL JOIN CIDADE CI LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["SEXO"],$row["FAIXAETARIA"], $row["NCIDADE"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "segmento"){
  $query = "SELECT S.DESCRICAO, FROM SEGMENTO S LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["SEGMENTO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "area"){
  $query = "SELECT A.DESCRICAO, S.DESCRICAO as SEGDESC FROM AREA A NATURAL JOIN SEGMENTO S LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["DESCRICAO"],$row["SEGDESC"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "empresa"){
  $query = "SELECT E.NOMEFANTASIA, A.DESCRICAO FROM EMPRESA E NATURAL JOIN AREA A LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["NOMEFANTASIA"],$row["DESCRICAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";
}else if ($request == "grupo" ){
  $query = "SELECT G.DESCRICAO FROM GRUPO G LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["DESCRICAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "problema"){
  $query = "SELECT P.DESCRICAO, G.DESCRICAO AS GRUPODESC FROM PROBLEMA P NATURAL JOIN GRUPO G LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["DESCRICAO"],$row["GRUPODESC"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "reclamacao"){
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

}else {
  echo "Error";
}
?>
