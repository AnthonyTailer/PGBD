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
	$query = "SELECT * FROM CONSUMIDOR_DES";
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
		<script src="../utilities/js/jquery.min.js">	</script>
		<script src="../utilities/js/bootstrap.min.js">	</script>
		<script src="../controller/ImportAjax.js"> </script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>

	</head>
	<body>
		<div class="container">
			<h2 align="center">Importando arquivo CSV no Banco de Dados</h2>
			<h3 align="center">Reclamações do consumidor.gov.br</h3>
			<br><br><br>
			<form id="upload_csv" enctype="multipart/form-data" method="post">
				<div class="row">
						<div class="col-md-4">
							<label for="fileInput">Selecione o Arquivo para a importação</label>
							<input id="fileInput" class="form-control" type="file" name="consumidor_csv" value="Selecione o Arquivo" >
							<p class="help-block">Somente arquivos .csv serão suportados!</p>
						</div>
					</br>
						<div class="col-md-8">
							<input  class="btn btn-info" id="uploadBtn" name="uploadBtn" type="submit" value="Enviar" style="margin-top: 5px;" >
						</div>
				</div>
				<div class="row">
					<div class="progress col-md-12" id="progress" >
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
			<div class="table-responsive" id="consumidor_table">
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th width="5%">REGIÃO</th>
						<th width="6%">UF</th>
						<th width="15%">CIDADE</th>
						<th width="8%">SEXO</th>
						<th width="5%">FAIXA ETÁRIA</th>
						<th width="20%">ANO ABERTURA</th>
						<th width="20%">MÊS ABERTURA</th>
						<th width="20%">DATA ABERTURA</th>
						<th width="15%">DATA RESPOSTA</th>
						<th width="15%">DATA FINALIZAÇÃO</th>
						<th width="15%">TEMPO RESPOSTA</th>
						<th width="15%">NOME FANTASIA</th>
						<th width="15%">SEGMENTO MERCADO</th>
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
			</table>

			</div>
		</div>
		<script>
		function addProgress(percentual){
			//console.log(percentual);
			$('#progressBar').width(percentual+'%');
			$('#statusTxt').html(percentual+'%');
		};
		</script>
	</body>
</html>
