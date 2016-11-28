<?php

/**
* View responsável por exibir as tabelas do BD
* @author Anthony Tailer
* @author Lucas Lima
**/

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv=”content-language” content=”pt-br” charset="utf-8">
	<title>Gráficos e Consultas</title>
	<link rel="stylesheet" href="../utilities/css/bootstrap-flex.min.css">
	<!-- Scripts Gerais -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
	<!-- Scripts Para os gráficos 3 e 4 -->
	<script src="../utilities/js/highcharts.js"></script>
	<script src="../utilities/js/exporting.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<header class="cabecalho">
					<h1>Gráficos e Consultas</h1>
					<h4>Reclamações do consumidor.gov.br</h4>
				</header>
				<article>
					<br><br>
					<div id="accordion" role="tablist" aria-multiselectable="true">
					  <!-- .................. GRAFICO 1 .................. -->
					  <div class="card">
					    <div class="card-header" role="tab" id="headingOne">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">#1 Relação da Quantidade de Reclamações por Estado</a>
					      </h4>
					    </div>
					    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
					      	<div class="card-block" id="map"></div>
							<div id="legend"><h3>Legenda</h3></div>
					    </div>
					  </div>
					  <!-- .................. GRAFICO 2 .................. -->
					  <div class="card">
					    <div class="card-header" role="tab" id="headingTwo">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">#2 Relação da Quantidade de Reclamações no RS</a>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
					      	<div class="card-block" id="map2"></div>
							<div id="legend2"><h3>Legenda</h3></div>
					    </div>
					  </div>
					  <!-- .................. GRAFICO 3 .................. -->
					  <div class="card">
					    <div class="card-header" role="tab" id="headingThree">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">#3 Quantidade de reclamacoes por empresa</a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
					      <div class="card-block">
					        	<div  id="map3" style="width: 900px; margin: 0 auto">
				        			<img src="../utilities/img/loading.gif" class="img-responsive center-block" width=100 style="padding-top: 150px">
					        	</div>
					      </div>
					    </div>
					  </div>
					  <!-- .................. GRAFICO 4 .................. -->
					  <div class="card">
					    <div class="card-header" role="tab" id="headingFour">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">#4 Percentual de reclamações por Perfil de Consumidor</a>
					      </h4>
					    </div>
					    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
					      <div class="card-block">
					      		<div id="map4" style="width: 900px; margin: 0 auto">
					      			<img src="../utilities/img/loading.gif" class="img-responsive center-block" width=100 style="padding-top: 150px">
					      		</div>
					      </div>
					    </div>
					  </div>
					</div>
				</article>
			</div>
		</div>
	</div>
	<!-- Scripts Para os gráficos 1 e 2 -->
	<script src="../controller/GraficosAjax.js"></script>
	<script src="../utilities/js/markerclusterer.js"></script>
	<script async defer src="../utilities/js/googleapi.js"></script>
	<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADS0fKiiywkMiPxF6nbfpfpHosf8SEAdI"></script> -->
</body>
</html>
