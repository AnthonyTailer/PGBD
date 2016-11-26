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
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
	<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 500px;
				padding: 0px;
      }

			#legend{
			font-family: Arial, sans-serif;
			 background: #fff;
			  padding: 10px;
				 margin: 10px;
				  border: 3px solid #000;
			}

			#legend h3 {
				margin-top: 0;
			}

			#legend img {
				vertical-align: middle;
			}
    </style>

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
					  <div class="card">
					    <div class="card-header" role="tab" id="headingTwo">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">#2 Relação da Quantidade de Reclamações por Estado</a>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
					      <div class="card-block">
					        SELECT E.NOME AS UF, COUNT(*) <br>
					    	FROM RECLAMACOES R <br>
					    	JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR <br>
					    	JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE <br>
					    	JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO <br>
					    	GROUP BY UF;
					      </div>
					    </div>
					  </div>
					  <div class="card">
					    <div class="card-header" role="tab" id="headingThree">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">#3 Relação da Quantidade de Reclamações por Estado</a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
					      <div class="card-block">
					        SELECT E.NOME AS UF, COUNT(*) <br>
					    	FROM RECLAMACOES R <br>
					    	JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR <br>
					    	JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE <br>
					    	JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO <br>
					    	GROUP BY UF;
					      </div>
					    </div>
					  </div>
					</div>
				</article>
			</div>
		</div>
	</div>

	<script src="../controller/GraficosAjax.js"></script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADS0fKiiywkMiPxF6nbfpfpHosf8SEAdI&signed_in=true&callback=initMap"></script>
</body>
</html>
