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
	//$DAODesnormalizada->insertDesnormalizada($desnormalizada);
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Importação da Base de Dados</title>
		<!-- Favicon -->
		<link rel="shortcut icon" href="../utilities/img/favicon.png" type="image/png"/>
		<!-- Style -->
		<link rel="stylesheet" type="text/css" href="../utilities/css/style.css" media="all">
		<link rel="stylesheet" href="../utilities/css/bootstrap.min.css">
		<!-- Script -->
		<script src="../utilities/js/jquery-3.1.1.min.js">	</script>
		<script src="../utilities/js/bootstrap.min.js">	</script>
		<script src="../controller/ImportAjax.js"></script>
	</head>
	<body>
		<div class="container">
			<h2 align="center">Importando arquivo CSV no Banco de Dados</h2>
			<h3 align="center">Reclamações do consumidor.gov.br</h3>
			<br><br><br>
			<form id="upload_csv" enctype="multipart/form-data" method="post">
				<div class="col-md-3">
					<label>Adicionar mais dados</label>
				</div>
				<div class="col-md-4">
					<input type="file" name="consumidor_csv" value="Selecione o Arquivo" style="margin-top: 15px;">
				</div>
				<div class="col-md-5">
					<input type="submit" name="uploadBtn" id="uploadBtn" value="Enviar" style="margin-top:10px;">
				</div>
				<div style="clear:both"></div>
			</form>
			<br><br><br>
			<div class="table-responsive" id="consumidor_table">
				<table class="table table-bordered">
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
						while($row = $DAODesnormalizada->selectDesnormalizada()->fetch(PDO::FETCH_ASSOC)){
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

	</body>
</html>
