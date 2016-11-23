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
    $query = "SELECT * FROM REGIAO;";
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
    $query = "SELECT E.IDESTADO, E.NOME, R.NOME as REGIAO  FROM ESTADO E JOIN REGIAO R on E.IDREGIAO = R.IDREGIAO;";
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
    $query = "SELECT C.IDCIDADE, C.NOME, E.NOME as ESTADO FROM CIDADE C JOIN ESTADO E ON C.IDESTADO = E.IDESTADO;";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDCIDADE"], $row["NOME"],$row["ESTADO"])
      ) ;
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else if ($request == "consumidor"){
    $query = "SELECT C.IDCONSUMIDOR, C.SEXO, C.FAIXAETARIA, CI.NOME as NCIDADE FROM CONSUMIDOR C 
                JOIN CIDADE CI ON C.IDCIDADE = CI.IDCIDADE";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDCONSUMIDOR"],$row["SEXO"],$row["FAIXAETARIA"], $row["NCIDADE"])
        );
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else if ($request == "segmento"){
    $query = "SELECT * FROM SEGMENTO";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDSEGMENTO"], $row["DESCRICAO"])
        );
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else if ($request == "area"){
    $query = "SELECT * FROM AREA A";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDAREA"],$row["DESCRICAO"])
        );
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else if ($request == "empresa"){
    $query = "SELECT E.IDEMPRESA, E.NOMEFANTASIA, S.DESCRICAO AS SEGMENTO FROM EMPRESA E NATURAL JOIN SEGMENTO S";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDEMPRESA"],$row["NOMEFANTASIA"],$row["SEGMENTO"])
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
    $query = "SELECT P.IDPROBLEMA, P.DESCRICAO, G.DESCRICAO AS GRUPODESC FROM PROBLEMA P 
                JOIN GRUPO G ON P.IDGRUPO = G.IDGRUPO";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDPROBLEMA"],$row["DESCRICAO"],$row["GRUPODESC"])
        );
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else if ($request == "reclamacao"){
    $query = "SELECT IDRECLAMACAO, C.SEXO, C.FAIXAETARIA, ANO, MES, DATAABERTURA, DATARESPOSTA, DATAFINALIZACAO,
                TEMPORESPOSTA, E.NOMEFANTASIA, A.DESCRICAO AS AREA, ASSUNTO, P.DESCRICAO AS PROBLEMA, COMOCOMPROU,
                PROCUROUEMPRESA, RESPONDIDA, SITUACAO, AVALIACAO, NOTACONSUMIDOR FROM RECLAMACAO R
                JOIN AREA A ON A.IDAREA = R.IDAREA JOIN CONSUMIDOR C ON C.IDCONSUMIDOR = R.IDCONSUMIDOR
                JOIN EMPRESA E ON E.IDEMPRESA = R.IDEMPRESA JOIN PROBLEMA P ON P.IDPROBLEMA = R.IDPROBLEMA;";
    $result = $conex->executeQuery($query);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push(
            $output, array($row["IDRECLAMACAO"], $row["SEXO"], $row["FAIXAETARIA"], $row["ANO"], $row["MES"], 
                $row["DATAABERTURA"], $row["DATARESPOSTA"], $row["DATAFINALIZACAO"], $row["TEMPORESPOSTA"], 
                $row["NOMEFANTASIA"], $row["AREA"], $row["ASSUNTO"], $row["PROBLEMA"], $row["COMOCOMPROU"], 
                $row["PROCUROUEMPRESA"], $row["RESPONDIDA"], $row["SITUACAO"], $row["AVALIACAO"], $row["NOTACONSUMIDOR"])
        );
    }

    echo "{
        \"data\":".json_encode($output)."
    }";

}else {
    echo "Error";
}
?>
