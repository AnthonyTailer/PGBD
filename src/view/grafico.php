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
	<title>Tabelas Normalizadas</title>
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<h1 align="center">Gráficos e Consultas</h1>
				<h3 align="center">Reclamações do consumidor.gov.br</h3>
				<br><br>
				<div id="accordion" role="tablist" aria-multiselectable="true">
				  <div class="card">
				    <div class="card-header" role="tab" id="headingOne">
				      <h3 class="mb-0">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">#1 Relação da Quantidade de Reclamações por Estado</a>
				      </h3>
				    </div>

				    <div id="collapseOne" class="collapse in" role="tabpanel" aria-labelledby="headingOne">
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
				    <div class="card-header" role="tab" id="headingTwo">
				      <h3 class="mb-0">
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
				      <h3 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">#3 Relação da Quantidade de Reclamações por Estado</a>
				      </h3>
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
			</div>
		</div>
	</div>
</body>
</html>