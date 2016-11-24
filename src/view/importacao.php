<?php

/**
* Classe responsável por manter métodos de conexão com a base dados
* @author Anthony Tailer
* @author Lucas Lima
**/

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv=”content-language” content=”pt-br” charset="utf-8">
	<title>Importação da Base de Dados</title>
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
	<script src="../controller/ImportCsvAjax.js"> </script>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<header class="cabecalho">
					<h1>Importação da Base de Dados</h1>
					<h3>Reclamações do consumidor.gov.br</h3>
				</header>
				<article>
					<br><br><br>
					<form id="upload_csv" enctype="multipart/form-data" method="post">
						<div class="row" id="import-elems">
							<div class="col-md-8">
								<label for="fileInput">Selecione o Arquivo para a importação</label>
							</div>
							<div class="col-md-8">
								<input id="fileInput" class="form-control" type="file" name="consumidor_csv">
								<p class="help-block">Somente arquivos .csv serão suportados!</p>
							</div>
							<div class="col-md-2">
								<input class="btn btn-primary" id="uploadBtn" name="uploadBtn" type="submit" value="Enviar">
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
							<!-- <tfoot>
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
							</tfoot> -->
						</table>
					</div>
				</article>
			</div>
		</div>
	</div>
</body>
</html>
