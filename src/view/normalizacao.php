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
	<title>Normalização da Base de Dados</title>
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js">	</script>
	<script src="../utilities/js/bootstrap.min.js">	</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3"> 
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<h2 align="center">Normalização da Base de Dados</h2>
				<h3 align="center">Reclamações do consumidor.gov.br</h3>
				<br><br>
				<form id="normaliza" enctype="multipart/form-data" method="post">
					<div class="row">
						<input class=" btn btn-success btn-lg center-block" id="NormalizaBtn" name="NormalizaBtn" type="submit" value="Normalizar Tabela">
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
				</form>
				<br>
				<div style="display: none" class="alert alert-success" id="alertRegiao" role="alert">Tabela <b>REGIAO</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertEstado" role="alert">Tabela <b>ESTADO</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertCidade" role="alert">Tabela <b>CIDADE</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertConsumidor" role="alert">Tabela <b>CONSUMIDOR</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertSegmento" role="alert">Tabela <b>SEGMENTO</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertArea" role="alert">Tabela <b>AREA</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertEmpresa" role="alert">Tabela <b>EMPRESA</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertGrupo" role="alert">Tabela <b>GRUPO</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertProblema" role="alert">Tabela <b>PROBLEMA</b> criada e populada!</div>
				<div style="display: none" class="alert alert-success" id="alertReclamacao" role="alert">Tabela <b>RECLAMACAO</b> criada e populada!</div>
			</div>
		</div>
	</div>
</body>
</html>
