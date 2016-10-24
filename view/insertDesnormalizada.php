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

	// $desnormalizada->id = 1311;
	// $desnormalizada->idDigs = 1001;
	// $desnormalizada->titulo = "Adequação Linha Férrea de Barra Mansa/RJ e construção de pátio - RJ";
	// $desnormalizada->investimento = 143996640.77;
	// $desnormalizada->uf = "RJ";
	// $desnormalizada->cidade = "BARRA MANSA, VOLTA REDONDA";
	// $desnormalizada->executor = "DNIT";
	// $desnormalizada->orgao = "Ministério dos Transportes";
	// $desnormalizada->estagio = 70;
	// $desnormalizada->ciclo = "30.06.2016";
	// $desnormalizada->selecao = NULL;
	// $desnormalizada->conclusao = NULL;
	// $desnormalizada->latitude = "22°32'24.000000''''S";
	// $desnormalizada->longitude = "44°10'38.280000''O";
	// $desnormalizada->emblematica = "";
	// $desnormalizada->observacao = "";



	$DAODesnormalizada = new DAODesnormalizada();
	//$DAODesnormalizada->insertDesnormalizada($desnormalizada);

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Importação da Base de Dados</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">	</script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">	</script>
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
					<input type="file" name="pac_csv" value="Selecione o Arquivo" style="margin-top: 15px;">
				</div>
				<div class="col-md-5">
					<input type="submit" name="uploadBtn" id="uploadBtn" value="Enviar" style="margin-top:10px;">
				</div>
				<div style="clear:both"></div>
			</form>
			<br><br><br>
			<div class="table-responsive" id="pac_table">
				<table class="table table-bordered">
					<tr>
						<th width="5%">ID</th>
						<th width="6%">IDigs</th>
						<th width="15%">TITULO</th>
						<th width="8%">INVESTIMENTO</th>
						<th width="5%">UF</th>
						<th width="10%">CIDADE</th>
						<th width="10%">EXECUTOR</th>
						<th width="10%">ORGÃO</th>
						<th width="15%">ESTAGIO</th>
						<th width="15%">CICLO</th>
						<th width="10%">SELECAO</th>
						<th width="5%">CONCLUSAO</th>
						<th width="5%">LATITUDE</th>
						<th width="5%">LONGITUDE</th>
						<th width="5%">EMBLEMATICA</th>
						<th width="15%">OBSERVAÇÃO</th>

					</tr>
				</table>

			</div>
		</div>

	</body>
</html>
