<?php
/**
* Controller responsável pela normalização do BD
* Define e executa os SQLs para migração dos dados
* @author Anthony Tailer
* @author Lucas Lima
**/

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

  $query = "INSERT INTO REGIAO (NOME) SELECT DISTINCT REGIAO FROM RECLAMACAO_DES ORDER BY 1 ASC" ;

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "estado"){

  $query = "INSERT INTO ESTADO (NOME, IDREGIAO) SELECT DISTINCT UF, IDREGIAO FROM RECLAMACAO_DES RD
    JOIN REGIAO R ON RD.REGIAO = R.NOME ORDER BY 1 ASC;" ;

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "cidade"){

  $query = "INSERT INTO CIDADE (NOME, IDESTADO)
    SELECT DISTINCT CIDADE, IDESTADO FROM RECLAMACAO_DES RD JOIN ESTADO E ON RD.UF = E.NOME ORDER BY 1 ASC;";

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "consumidor"){

    $query = "INSERT INTO CONSUMIDOR (SEXO, FAIXAETARIA, IDCIDADE)
        SELECT DISTINCT SEXO, FAIXAETARIA, IDCIDADE FROM RECLAMACAO_DES RD
        JOIN CIDADE C ON RD.CIDADE = C.NOME JOIN ESTADO E ON C.IDESTADO = E.IDESTADO
        WHERE RD.UF = E.NOME;";
    $query .= "ALTER TABLE RECLAMACAO_DES ADD COLUMN IDCONSUMIDOR INT;";
    $query .= "UPDATE RECLAMACAO_DES RD SET IDCONSUMIDOR = (SELECT IDCONSUMIDOR FROM CONSUMIDOR CO
                JOIN CIDADE CI ON CO.IDCIDADE = CI.IDCIDADE JOIN ESTADO E ON CI.IDESTADO = E.IDESTADO
                WHERE CO.SEXO = RD.SEXO AND CO.FAIXAETARIA = RD.FAIXAETARIA AND CI.NOME = RD.CIDADE AND RD.UF = E.NOME);";

  try {
    $conex->executeMultiQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "segmento"){

  $query = "INSERT INTO SEGMENTO (DESCRICAO) SELECT DISTINCT SEGMENTOMERCADO FROM RECLAMACAO_DES ORDER BY 1 ASC;";

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "area"){

  $query = "INSERT INTO AREA (DESCRICAO) SELECT DISTINCT AREA FROM RECLAMACAO_DES RD ORDER BY 1 ASC;";

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "empresa"){

  $query = "INSERT INTO EMPRESA (NOMEFANTASIA, IDSEGMENTO)
            SELECT DISTINCT NOMEFANTASIA, S.IDSEGMENTO FROM RECLAMACAO_DES RD JOIN SEGMENTO S ON RD.SEGMENTOMERCADO = S.DESCRICAO
            ORDER BY 1 ASC;";
    $query .= "ALTER TABLE RECLAMACAO_DES ADD COLUMN IDEMPRESA INT;";
    $query .= "UPDATE RECLAMACAO_DES RD SET IDEMPRESA = (SELECT IDEMPRESA FROM EMPRESA E NATURAL JOIN SEGMENTO S
                WHERE E.NOMEFANTASIA = RD.NOMEFANTASIA AND S.DESCRICAO = RD.SEGMENTOMERCADO);";

  try {
    $conex->executeMultiQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "grupo"){

  $query = "INSERT INTO GRUPO (DESCRICAO) SELECT DISTINCT GRUPOPROBLEMA FROM RECLAMACAO_DES RD ORDER BY 1 ASC;";

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "problema"){

  $query = "INSERT INTO PROBLEMA (DESCRICAO, IDGRUPO) SELECT DISTINCT PROBLEMA, IDGRUPO
            FROM RECLAMACAO_DES RD JOIN GRUPO G ON RD.GRUPOPROBLEMA = G.DESCRICAO ORDER BY 1 ASC;";

  try {
    $conex->executeQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else if ($request == "reclamacao"){

    $query = "INSERT INTO RECLAMACAO (IDCONSUMIDOR, ANO, MES, DATAABERTURA, DATARESPOSTA, DATAFINALIZACAO,
        TEMPORESPOSTA, IDEMPRESA, IDAREA, ASSUNTO, IDPROBLEMA, COMOCOMPROU, PROCUROUEMPRESA, RESPONDIDA,
        SITUACAO, AVALIACAO, NOTACONSUMIDOR)
        SELECT IDCONSUMIDOR, ANOABERTURA, MESABERTURA, DATAABERTURA, DATARESPOSTA, DATAFINALIZACAO,
        TEMPORESPOSTA, IDEMPRESA, A.IDAREA, ASSUNTO, P.IDPROBLEMA, COMOCOMPROU, PROCUROUEMPRESA, RESPONDIDA,
        SITUACAO, AVALIACAO, NOTACONSUMIDOR
           FROM RECLAMACAO_DES RD
           JOIN AREA A ON RD.AREA = A.DESCRICAO
           JOIN PROBLEMA P ON RD.PROBLEMA = P.DESCRICAO;";

    $query .= "ALTER TABLE RECLAMACAO_DES DROP COLUMN IDCONSUMIDOR;";
    $query .= "ALTER TABLE RECLAMACAO_DES DROP COLUMN IDEMPRESA;";

  try {
    $conex->executeMultiQuery($query);
    echo $porcentagem;
  } catch (Exception $e) {
    echo 0;
  }

}else{
  echo "Error";
}
?>
