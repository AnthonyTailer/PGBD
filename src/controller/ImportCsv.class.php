<?php
/**
  * Classe responsável por importar a base de dados
  * @author Anthony Tailer
  * @author Lucas Lima
  **/
require_once '../model/PDOConsumidor.class.php';

class ImportCsv extends PDOConsumidor{

  function __autoload($classe){
      include_once "../model/{$classe}.class.php";
  }

  public $conex = null;

  public function __construct(){
    $this->conex = PDOConsumidor::getConnection();
    $desnormalizada = new MagicDesnormalizada();
  	$DAODesnormalizada = new DAODesnormalizada();
    ImportCsv();
  }

  public function ImportCsv(){
    if(!empty($_FILES["consumidor_csv"]["name"])){
       //$connect = mysqli_connect("localhost", "root", "", "testing");
       $output = '';
       $allowed_ext = array("csv");
       $extension = end(explode(".", $_FILES["consumidor_csv"]["name"]));
       if(in_array($extension, $allowed_ext)){
            $file_data = fopen($_FILES["consumidor_csv"]["tmp_name"], 'r');
            fgetcsv($file_data);
            while($row = fgetcsv($file_data)){
                 $desnormalizada->regiao = $conex->quote($row[0]);
                 $desnormalizada->uf = $conex->quote($row[1]);
                 $desnormalizada->cidade = $conex->quote($row[2]);
                 $desnormalizada->sexo = $conex->quote($row[3]);
                 $desnormalizada->faixaEtaria = $conex->quote($row[4]);
                 $desnormalizada->anoAbertura = $conex->quote($row[5]);
                 $desnormalizada->mesAbertura = $conex->quote($row[6]);
                 $desnormalizada->dataAbertura = $conex->quote($row[7]);
                 $desnormalizada->dataResposta = $conex->quote($row[8]);
                 $desnormalizada->dataFinalizacao = $conex->quote($row[9]);
                 $desnormalizada->tempoResposta = $conex->quote($row[10]);
                 $desnormalizada->nomeFantasia = $conex->quote($row[11]);
                 $desnormalizada->segmentoMercado = $conex->quote($row[12]);
                 $desnormalizada->area = $conex->quote($row[13]);
                 $desnormalizada->assunto = $conex->quote($row[14]);
                 $desnormalizada->grupoProblema = $conex->quote($row[15]);
                 $desnormalizada->problema = $conex->quote($row[16]);
                 $desnormalizada->comoComprou = $conex->quote($row[17]);
                 $desnormalizada->procurouEmpresa = $conex->quote($row[18]);
                 $desnormalizada->respondida = $conex->quote($row[19]);
                 $desnormalizada->situacao = $conex->quote($row[20]);
                 $desnormalizada->avaliacao = $conex->quote($row[21]);
                 $desnormalizada->notaConsumidor = $conex->quote($row[22]);

                 $DAODesnormalizada->insertDesnormalizada($desnormalizada);
            }
            $output = '
            <table class="table table-bordered">
    					<tr>
    						<th width="5%">REGIÃO</th>
    						<th width="6%">UF</th>
    						<th width="15%">CIDADE</th>
    						<th width="8%">SEXO</th>
    						<th width="5%">FAIXA ETÁRIA</th>
    						<th width="10%">ANO ABERTURA</th>
    						<th width="10%">MÊS ABERTURA</th>
    						<th width="10%">DATA ABERTURA</th>
    						<th width="15%">DATA RESPOSTA</th>
    						<th width="15%">DATA FINALIZAÇÃO</th>
    						<th width="10%">TEMPO RESPOSTA</th>
    						<th width="5%">NOME FANTASIA</th>
    						<th width="5%">SEGMENTO MERCADO</th>
    						<th width="5%">ÁREA</th>
    						<th width="5%">ASSUNTO</th>
    						<th width="15%">GRUPO PROBLEMA</th>
    						<th width="15%">PROBLEMA</th>
    						<th width="15%">COMO COMPROU</th>
    						<th width="15%">PROCUROU EMPRESA</th>
    						<th width="15%">RESPONDIDA</th>
    						<th width="15%">SITUAÇÃO</th>
    						<th width="15%">AVALIAÇÃO</th>
    						<th width="15%">NOTA CONSUMIDOR</th>
    					</tr>
              ';

    					while($row = $DAODesnormalizada->selectDesnormalizada()->fetch(PDO::FETCH_ASSOC)){
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
                </tr>' ;

              }
            $output .= '</table>';
            echo $output;
       }
       else{
            echo 'Error1';
       }
     }
    else{
       echo "Error2";
     }
  }
  
}

 ?>
