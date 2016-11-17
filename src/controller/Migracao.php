<?php

function __autoload($classe){
    include_once "../model/{$classe}.class.php";
}

$conex = new MySQLiConsumidor();
$mysqli = $conex->getConnection();
$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();

$request = $_GET['tabela'];
$porcentagem = 10;


if ($request == "regiao") {

  $query = "INSERT INTO REGIAO (NOME)
  SELECT DISTINCT REGIAO FROM RECLAMACAO_DES ORDER BY ASC" ;

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "estado"){

  $query = "INSERT INTO ESTADO (NOME, IDREGIAO)
    SELECT DISTINCT UF, IDREGIAO FROM RECLAMACAO_DES RD
    JOIN REGIAO R ON RD.REGIAO = R.NOME" ;

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "cidade"){

  $query = "INSERT INTO CIDADE (NOME, IDESTADO)
    SELECT DISTINCT CIDADE, IDESTADO FROM RECLAMACAO_DES RD
    JOIN ESTADO E ON RD.ESTADO = E.NOME";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "consumidor"){

  $query = "INSERT INTO CONSUMIDOR (SEXO, FAIXAETARIA, IDCIDADE)
    SELECT DISTINCT SEXO, FAIXAETARIA, IDCIDADE FROM RECLAMACAO_DES RD
    JOIN CIDADE C ON RD.CIDADE = C.NOME";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "segmento"){

  $query = "INSERT INTO SEGMENTO (DESCRICAO) SELECT DISTINCT
  SEGMENTOMERCADO FROM RECLAMACAO_DES ORDER BY ASC
";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "area"){

  $query = "INSERT INTO AREA (DESCRICAO, IDSEGMENTO)
    SELECT DISTINCT AREA, IDSEGMENTO FROM RECLAMACAO_DES RD
    JOIN SEGMENTO S ON RD.SEGMENTOMERCADO = S.DESCRICAO";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "empresa"){

  $query = "INSERT INTO EMPRESA (NOMEFATASIA, IDAREA)
    SELECT DISTINCT NOMEFATASIA, IDAREA FROM RECLAMACAO_DES RD JOIN
     AREA A ON RD.AREA = A.DESCRICAO";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "grupo"){

  $query = "INSERT INTO GRUPO (DESCRICAO) SELECT DISTINCT
   GRUPOPROBLEMA FROM RECLAMACAO_DES RD";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "problema"){

  $query = "INSERT INTO PROBLEMA (DESCRICAO, IDGRUPO)
    SELECT DISTINCT PROBLEMA, IDGRUPO FROM RECLAMACAO_DES RD
    JOIN GRUPO G ON RD.GRUPOPROBLEMA = G.DESCRICAO";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "reclamacao"){

  $query =
  "INSERT INTO RECLAMACAO (IDCONSUMIDOR, ANO, MES, DATAABERTURA, DATARESPOSTA,
     DATAFINALIZACAO, TEMPORESPOSTA, IDEMPRESA, ASSUNTO, IDPROBLEMA, COMOCOMPROU,
      PROCUROUEMPRESA, RESPONDIDA, SITUACAO, AVALIACAO, NOTACONSUMIDOR)
      SELECT IDCONSUMIDOR, ANO, MES, DATAABERTURA, DATARESPOSTA, DATAFINALIZACAO,
      TEMPORESPOSTA, IDEMPRESA, ASSUNTO, IDPROBLEMA, COMOCOMPROU, PROCUROUEMPRESA,
       RESPONDIDA, SITUACAO, AVALIACAO, NOTACONSUMIDOR FROM RECLAMACAO_DES RD
          JOIN CIDADE C ON RD.CIDADE = C.DESCRICAO
          JOIN CONSUMIDOR CO ON RD.SEXO = CO.SEXO AND RD.FAIXAETARIA = CO.FAIXAETARIA
          JOIN EMPRESA E ON RD.NOMEFATASIA = E.NOMEFATASIA
          JOIN PROBLEMA P ON RD.PROBLEMA = P.DESCRICAO
  ";

  try {
    $result = $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else{
  echo "Error";
}
?>
