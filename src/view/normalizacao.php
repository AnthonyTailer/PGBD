<?php

/**
* View que desponibiliza a opção de normalização do BD
* @author Anthony Tailer
* @author Lucas Lima
**/

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv=”content-language” content=”pt-br” charset="utf-8">
	<title>Normalização da Base de Dados</title>
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js">	</script>
	<script src="../utilities/js/bootstrap.min.js">	</script>
	<script src="../controller/NormalizaAjax.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"> 
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<header class="cabecalho">
					<h1>Normalização da Base de Dados</h1>
					<h3>Reclamações do consumidor.gov.br</h3>
				</header>
				<article>
					<br>
					<div class="row">
						<button class=" btn btn-success btn-lg center-block" id="normalizaBtn" name="normalizaBtn">Normalizar Tabela</button>
					</div>
					<br>
					<div class="row" id="progress-elems">
						<div class="progress" id="progress" >
							<div class="progress-bar progress-bar-striped active" id="progressBar" role="progressbar"
							aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%" >
								<p id="statusTxt">0%</p>
							</div>
						</div>
					</div>
					<div style="display: none" class="alert alert-success" id="alertRegiao" role="alert">Tabelas <b>REGIAO e ESTADO e CIDADE</b> foram criadas e populadas!</div>
					<div style="display: none" class="alert alert-success" id="alertConsumidor" role="alert">Tabela <b>CONSUMIDOR</b> foi criada e populada!</div>
					<div style="display: none" class="alert alert-success" id="alertArea" role="alert">Tabela <b>AREA</b> foi criada e populada!</div>
					<div style="display: none" class="alert alert-success" id="alertGrupo" role="alert">Tabelas <b>GRUPO e PROBLEMA</b> foram criadas e populadas!</div>
					<div style="display: none" class="alert alert-success" id="alertSegmento" role="alert">Tabela <b>SEGMENTO</b> foi criada e populada!</div>
					<div style="display: none" class="alert alert-success" id="alertEmpresa" role="alert">Tabela <b>EMPRESA</b> foi criada e populada!</div>
					<div style="display: none" class="alert alert-success" id="alertReclamacao" role="alert">Tabela <b>RECLAMACAO</b> foi criada e populada!</div>
				</article>
			</div>
		</div>
	</div>
</body>
</html>
