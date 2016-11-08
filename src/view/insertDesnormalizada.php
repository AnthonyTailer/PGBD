<?php
/**
* Classe responsável por manter métodos de conexão com a base dados
* @author Anthony Tailer
* @author Lucas Lima
**/

function __autoload($classe){
	include_once "../model/{$classe}.class.php";
}

$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();
$conex = new MySQLiConsumidor();
//$conex->getConnection();
$query = "SELECT * FROM RECLAMACAO_DES";
$result = $conex->executeQuery($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv=”content-language” content=”pt-br” charset="utf-8">
	<title>Importação da Base de Dados</title>
	<!-- Favicon -->
	<link rel="shortcut icon" href="../utilities/img/favicon.png" type="image/png"/>
	<!-- Style -->
	<link rel="stylesheet" type="text/css" href="../utilities/css/style.css" media="all">
	<link rel="stylesheet" href="../utilities/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">


	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-1.12.3.js">	</script> -->
	<script src="../utilities/js/bootstrap.min.js">	</script>
	<script src="../controller/ImportAjax.js"> </script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>


</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php
				include_once "menu.php"
				?>
			</div>

			<div class="col-md-9">
				<h2 align="center">Importando arquivo CSV no Banco de Dados</h2>
				<h3 align="center">Reclamações do consumidor.gov.br</h3>
				<br><br><br>
				<form id="upload_csv" enctype="multipart/form-data" method="post">
					<div class="row" id="import-elems">
						<div class="col-md-8">
							<label for="fileInput">Selecione o Arquivo para a importação</label>
							<input id="fileInput" class="form-control" type="file" name="consumidor_csv">
							<p class="help-block">Somente arquivos .csv serão suportados!</p>
						</div>
						<div class="col-md-2">
							<p id="enviar-btn" style="margin-top: 30px" align="left">
								<input  class="btn btn-info" id="uploadBtn" name="uploadBtn" type="submit" value="Enviar">
							</p>
						</div>
				</div>

				<div class="row" id="progress-elems">
					<div class="progress" id="progress" >
						<div class="progress-bar progress-bar-striped active" id="progressBar" role="progressbar"
						aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%" >
						<p id="statusTxt">0%</p>
					</div>
				</div>
			</div>
			<input type="hidden" id="inputStop" value="0">
			<div style="clear:both"></div>
		</form>
		<br><br>
		<div class="table-responsive" id="consumidor_div">
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
					<?php
					while($row = $result->fetch_array(MYSQLI_ASSOC)){
						?>
						<tr>
							<td><?php echo $row["REGIAO"]; ?></td>
							<td><?php echo $row["UF"]; ?></td>
							<td><?php echo $row["CIDADE"]; ?></td>
							<td><?php echo $row["SEXO"]; ?></td>
							<td><?php echo $row["FAIXAETARIA"]; ?></td>
							<td><?php echo $row["ANOABERTURA"]; ?></td>
							<td><?php echo $row["MESABERTURA"]; ?></td>
							<td><?php echo $row["DATAABERTURA"]; ?></td>
							<td><?php echo $row["DATARESPOSTA"]; ?></td>
							<td><?php echo $row["DATAFINALIZACAO"]; ?></td>
							<td><?php echo $row["TEMPORESPOSTA"]; ?></td>
							<td><?php echo $row["NOMEFANTASIA"]; ?></td>
							<td><?php echo $row["SEGMENTOMERCADO"]; ?></td>
							<td><?php echo $row["AREA"]; ?></td>
							<td><?php echo $row["ASSUNTO"]; ?></td>
							<td><?php echo $row["GRUPOPROBLEMA"]; ?></td>
							<td><?php echo $row["PROBLEMA"]; ?></td>
							<td><?php echo $row["COMOCOMPROU"]; ?></td>
							<td><?php echo $row["PROCUROUEMPRESA"]; ?></td>
							<td><?php echo $row["RESPONDIDA"]; ?></td>
							<td><?php echo $row["SITUACAO"]; ?></td>
							<td><?php echo $row["AVALIACAO"]; ?></td>
							<td><?php echo $row["NOTACONSUMIDOR"]; ?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
		</div>

</div>
</body>
</html>
