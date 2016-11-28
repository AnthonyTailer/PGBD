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
	<!-- Ini do Script Para o gráfico 3 -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Galaxy', 'Distance', 'Brightness'],
          ['Canis Major Dwarf', 8000, 23.3],
          ['Sagittarius Dwarf', 24000, 4.5],
          ['Ursa Major II Dwarf', 30000, 14.3],
          ['Lg. Magellanic Cloud', 50000, 0.9],
          ['Bootes I', 60000, 13.1]
        ]);

        var options = {
          width: 800,
          chart: {
            title: 'Nearby galaxies',
            subtitle: 'distance on the left, brightness on the right'
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            x: {
              distance: {label: 'parsecs'}, // Bottom x-axis.
              brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('map3'));
      chart.draw(data, options);
    };
    </script>
	<!-- Fim do Script para o grafico 3 -->
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

		#map2 {
			height: 500px;
			padding: 0px;
		}

		#map3 {
			height: 500px;
			padding: 0px;
		}

		#legend{
			font-family: Arial, sans-serif;
			font-size: 14px;
		 	background: #fff;
		 	padding: 10px;
			margin: 10px;
			border: 3px solid #000;
		}

		#legend2 {
			font-family: Arial, sans-serif;
			font-size: 14px;
			background: #fff;
			padding: 10px;
			margin: 10px;
			border: 3px solid #000;
		}

		#legend h3 {
			margin-top: 0;
		}

		#legend2 h3 {
			margin-top: 0;
		}

		#legend2 h4 {
			font-size: 14px;
			font-weight: bold;
		}

		#legend img {
			vertical-align: bottom;
		}

		#legend2 img {
			vertical-align: bottom;
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
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">#2 Relação da Quantidade de Reclamações no RS</a>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
					      	<div class="card-block" id="map2"></div>
							<div id="legend2"><h3>Legenda</h3></div>
					    </div>
					  </div>
					  
					  <div class="card">
					    <div class="card-header" role="tab" id="headingThree">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">#3 Empresas com maior número de reclamações nota 0</a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
					      <div class="card-block">
					        	<!-- <div  id="map3" style="width: 900px;"></div> -->
					      </div>
					    </div>
					  </div>

					  <div class="card">
					    <div class="card-header" role="tab" id="headingFour">
					      <h4 class="mb-0">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">#4 Perfil de consumidor que mais reclama</a>
					      </h4>
					    </div>
					    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
					      <div class="card-block">
					        SELECT C.SEXO, C.FAIXAETARIA, COUNT(*) AS QTDE <br>
							FROM RECLAMACAO R <br>
							JOIN CONSUMIDOR C ON R.IDCONSUMIDOR = C.IDCONSUMIDOR <br>
							GROUP BY 1, 2 <br>
							ORDER BY 3 DESC <br>
							LIMIT 10 #OFFSET 10; <br>
					      </div>
					    </div>
					  </div>

					</div>
					<!-- <div  id="map3" style="width: 900px;"></div> -->
				</article>
			</div>
		</div>
	</div>

	<script src="../controller/GraficosAjax.js"></script>
	<script src="../utilities/js/markerclusterer.js"></script>
	<script async defer src="../utilities/js/googleapi.js"></script>
	<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADS0fKiiywkMiPxF6nbfpfpHosf8SEAdI"></script> -->
</body>
</html>
