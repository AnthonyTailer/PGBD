<?php
/**
  *
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

  require_once '../model/MySQLiConsumidor.class.php';


  function __autoload($classe){
      include_once "../model/{$classe}.class.php";
  }

  $conex = new MySQLiConsumidor();
  $mysqli = $conex->getConnection();
  $desnormalizada = new MagicDesnormalizada();
	$DAODesnormalizada = new DAODesnormalizada();
  if(!empty($_FILES["consumidor_csv"]["name"])){

     $output = array();
     $allowed_ext = array("csv");
     $tmp = explode(".", $_FILES["consumidor_csv"]["name"]);
     $extension = end($tmp);
     if(in_array($extension, $allowed_ext)){
          $file_data = fopen($_FILES["consumidor_csv"]["tmp_name"], 'r');
          fgetcsv($file_data);
          // $i = 0;
          while($row = fgetcsv($file_data, 0,';')){
               $row = array_map("utf8_encode", $row);
               //print_r($row);
               $desnormalizada->regiao = $mysqli->real_escape_string($row[0]);
               $desnormalizada->uf = $mysqli->real_escape_string($row[1]);
               $desnormalizada->cidade = $mysqli->real_escape_string($row[2]);
               $desnormalizada->sexo =  $mysqli->real_escape_string($row[3]);
               $desnormalizada->faixaEtaria = $mysqli->real_escape_string($row[4]);
               $desnormalizada->anoAbertura = $mysqli->real_escape_string($row[5]);
               $desnormalizada->mesAbertura = $mysqli->real_escape_string($row[6]);
               $desnormalizada->dataAbertura = $mysqli->real_escape_string($row[7]);
               $desnormalizada->dataResposta = $mysqli->real_escape_string($row[8]);
               $desnormalizada->dataFinalizacao = $mysqli->real_escape_string($row[9]);
               $desnormalizada->tempoResposta = $mysqli->real_escape_string($row[10]);
               $desnormalizada->nomeFantasia = $mysqli->real_escape_string($row[11]);
               $desnormalizada->segmentoMercado = $mysqli->real_escape_string($row[12]);
               $desnormalizada->area = $mysqli->real_escape_string($row[13]);
               $desnormalizada->assunto = $mysqli->real_escape_string($row[14]);
               $desnormalizada->grupoProblema = $mysqli->real_escape_string($row[15]);
               $desnormalizada->problema = $mysqli->real_escape_string($row[16]);
               $desnormalizada->comoComprou = $mysqli->real_escape_string($row[17]);
               $desnormalizada->procurouEmpresa = $mysqli->real_escape_string($row[18]);
               $desnormalizada->respondida = $mysqli->real_escape_string($row[19]);
               $desnormalizada->situacao = $mysqli->real_escape_string($row[20]);
               $desnormalizada->avaliacao = $mysqli->real_escape_string($row[21]);
               $desnormalizada->notaConsumidor = $mysqli->real_escape_string($row[22]);

               $DAODesnormalizada->insertDesnormalizada($desnormalizada);
              // $i++;
          }


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
          echo json_encode($output);

     }
     else{
          echo 'Error1';
     }
   }
  else{
     echo "Error2";
   }


 ?>
