<?php
/**
  * Classe responsável por importar a base de dados
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

     $output = '';
     $allowed_ext = array("csv");
     $tmp = explode(".", $_FILES["consumidor_csv"]["name"]);
     $extension = end($tmp);
     if(in_array($extension, $allowed_ext)){
          $file_data = fopen($_FILES["consumidor_csv"]["tmp_name"], 'r');
          fgetcsv($file_data);
          $i = 0;
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
               $i++;
          }
          $output = '
          <table class="display" id="consumidor_table" width="100%" cellspacing="0">
  					<thead>
  					<tr>
  						<th>REGIÃO</th>
  						<th>UF</th>
  						<th>CIDADE</th>
  						<th>SEXO</th>
  						<th>FAIXA ETÁRIA</th>
  						<th>ANO ABERTURA</th>
  						<th>MÊS ABERTURA</th>
  						<th>DATA ABERTURA</th>
  						<th>DATA RESPOSTA</th>
  						<th>DATA FINALIZAÇÃO</th>
  						<th>TEMPO RESPOSTA</th>
  						<th>NOME FANTASIA</th>
  						<th>SEGMENTO MERCADO</th>
  						<th>ÁREA</th>
  						<th>ASSUNTO</th>
  						<th>GRUPO PROBLEMA</th>
  						<th>PROBLEMA</th>
  						<th>COMO COMPROU</th>
  						<th>PROCUROU EMPRESA</th>
  						<th>RESPONDIDA</th>
  						<th>SITUAÇÃO</th>
  						<th>AVALIAÇÃO</th>
  						<th>NOTA CONSUMIDOR</th>
  					</tr>
  				</thead>
  				<tfoot>
  				<tr>
  					<th>REGIÃO</th>
  					<th>UF</th>
  					<th>CIDADE</th>
  					<th>SEXO</th>
  					<th>FAIXA ETÁRIA</th>
  					<th>ANO ABERTURA</th>
  					<th>MÊS ABERTURA</th>
  					<th>DATA ABERTURA</th>
  					<th>DATA RESPOSTA</th>
  					<th>DATA FINALIZAÇÃO</th>
  					<th>TEMPO RESPOSTA</th>
  					<th>NOME FANTASIA</th>
  					<th>SEGMENTO MERCADO</th>
  					<th>ÁREA</th>
  					<th>ASSUNTO</th>
  					<th>GRUPO PROBLEMA</th>
  					<th>PROBLEMA</th>
  					<th>COMO COMPROU</th>
  					<th>PROCUROU EMPRESA</th>
  					<th>RESPONDIDA</th>
  					<th>SITUAÇÃO</th>
  					<th>AVALIAÇÃO</th>
  					<th>NOTA CONSUMIDOR</th>
  				</tr>
  			</tfoot>
        <tbody>
            ';
            $query = "SELECT * FROM CONSUMIDOR_DES LIMIT 15";
            $result = $conex->executeQuery($query);
  					while($row = $result->fetch_array(MYSQLI_ASSOC)){
              $output .= '
              <tr>
               	<td>'.$row["REGIAO"].' </td>
               	<td>'.$row["UF"].'</td>
               	<td>'.$row["CIDADE"].'</td>
               	<td>'.$row["SEXO"].'</td>
               	<td>'.$row["FAIXAETARIA"].'</td>
               	<td>'.$row["ANOABERTURA"].'</td>
               	<td>'.$row["MESABERTURA"].'</td>
               	<td>'.$row["DATAABERTURA"].'</td>
                <td>'.$row["DATARESPOSTA"].'</td>
               	<td>'.$row["DATAFINALIZACAO"].'</td>
               	<td>'.$row["TEMPORESPOSTA"].'</td>
               	<td>'.$row["NOMEFANTASIA"].'</td>
               	<td>'.$row["SEGMENTOMERCADO"].'</td>
               	<td>'.$row["AREA"].'</td>
               	<td>'.$row["ASSUNTO"].'</td>
               	<td>'.$row["GRUPOPROBLEMA"].'</td>
               	<td>'.$row["PROBLEMA"].'</td>
               	<td>'.$row["COMOCOMPROU"].'</td>
               	<td>'.$row["PROCUROUEMPRESA"].'</td>
               	<td>'.$row["RESPONDIDA"].'</td>
               	<td>'.$row["SITUACAO"].'</td>
               	<td>'.$row["AVALIACAO"].'</td>
               	<td>'.$row["NOTACONSUMIDOR"].'</td>
              </tr>
              ' ;

            }
          $output .= '</tbody>
          </table>';
          echo $output;
     }
     else{
          echo 'Error1';
     }
   }
  else{
     echo "Error2";
   }


 ?>
