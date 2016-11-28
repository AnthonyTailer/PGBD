<?php
/**
* Arquivo por exibir os dados de cada tabela
* em seus respectivos DataTables
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
$request = $_GET['query'];

if ($request == "geomap1") {
  $query = "SELECT E.NOME AS UF, COUNT(*) AS QTDRECLAMACOES, (SELECT COUNT(*) FROM RECLAMACAO) AS TOTAL FROM RECLAMACAO R
              JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR
              JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE
              JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO
              GROUP BY UF;";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
      array_push(
          $output, array($row["UF"],$row["QTDRECLAMACOES"], $row["TOTAL"])
      );
  }
  echo json_encode($output);
}elseif ($request == "geomap2") {
  $query = "SELECT CI.NOME AS CIDADE, E.NOME AS UF, COUNT(*) AS QTDRECLAMACOES,
            (SELECT COUNT(*) FROM RECLAMACAO) AS TOTALRECLAMACOES FROM RECLAMACAO R
              JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR
              JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE
              JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO
              WHERE E.NOME = 'RS'
              GROUP BY CIDADE;";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
      array_push(
          $output, array($row["CIDADE"],$row["UF"],$row["QTDRECLAMACOES"], $row["TOTALRECLAMACOES"])
      );
  }
  echo json_encode($output);
}else if($request == "grafico3"){
    $query = "SELECT E.NOMEFANTASIA AS EMPRESA, COUNT(*) AS QTDE_0,
                  (SELECT COUNT(*) FROM RECLAMACAO R2 WHERE R2.IDEMPRESA = E.IDEMPRESA GROUP BY R2.IDEMPRESA) AS QTDE_TOTAL
              FROM RECLAMACAO R
              JOIN EMPRESA E ON R.IDEMPRESA = E.IDEMPRESA
              WHERE R.NOTACONSUMIDOR = 0
              GROUP BY 1, 3
              ORDER BY 2 DESC
              LIMIT 7 # OFFSET 10;";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["EMPRESA"], $row["QTDE_0"], $row["QTDE_TOTAL"])
        );
    }
    echo json_encode($output);
}else if($request == "grafico4"){
    $query = "SELECT C.SEXO, C.FAIXAETARIA, COUNT(*) AS QTDE, (SELECT COUNT(*) FROM RECLAMACAO RE) AS TOTAL
              FROM RECLAMACAO R
              JOIN CONSUMIDOR C ON R.IDCONSUMIDOR = C.IDCONSUMIDOR
              GROUP BY 1, 2
              ORDER BY 3 DESC
              LIMIT 9 #OFFSET 10;";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($output, $row);
    }
    echo json_encode($output);
}else{
  echo 'Error';
}


?>
