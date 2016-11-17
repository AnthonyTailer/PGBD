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
  $query = "SELECT E.IDESTADO, E.NOME, R.NOME as REGIAO  FROM ESTADO E JOIN
   REGIAO R on E.IDREGIAO = R.IDREGIAO LIMIT 1000";
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
  $query = "SELECT C.IDCIDADE, C.NOME, E.NOME as ESTADO FROM CIDADE C JOIN
   ESTADO E ON C.IDESTADO = E.IDESTADO";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["IDCIDADE"], $row["NOME"],$row["ESTADO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "consumidor"){
  $query = "SELECT C.SEXO, C.FAIXAETARIA, CI.NOME as NCIDADE FROM CONSUMIDOR C
  JOIN CIDADE CI ON C.IDCIDADE = CI.IDCIDADE";
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
  $query = "SELECT S.DESCRICAO FROM SEGMENTO S LIMIT 1000";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["DESCRICAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "area"){
  $query = "SELECT A.DESCRICAO, S.DESCRICAO as SEGDESC FROM AREA A
  JOIN SEGMENTO S ON A.IDSEGMENTO = S.IDSEGMENTO ";
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
  $query = "SELECT DISTINCT E.NOMEFATASIA, A.DESCRICAO FROM EMPRESA E
  JOIN AREA A ON E.IDAREA = A.IDAREA";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["NOMEFATASIA"],$row["DESCRICAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "grupo" ){
  $query = "SELECT * FROM GRUPO G";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    array_push(
      $output, array($row["IDGRUPO"], $row["DESCRICAO"])
    );
  }

  echo "{
          \"data\":".json_encode($output)."
        }";

}else if ($request == "problema"){
  $query = "SELECT P.DESCRICAO, G.DESCRICAO AS GRUPODESC FROM PROBLEMA P
   JOIN GRUPO G ON P.IDGRUPO = G.IDGRUPO";
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
  $query = "SELECT * FROM RECLAMACAO_DES";
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
