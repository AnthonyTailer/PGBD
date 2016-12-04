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
	<link rel="stylesheet" href="../utilities/css/bootstrap-flex.min.css">
	<style media="screen">
		td.details-control {
			background: url('../utilities/img/details_open.png') no-repeat center center;
			cursor: pointer;
		}
		tr.details td.details-control {
			background: url('../utilities/img/details_close.png') no-repeat center center;
		}
	</style>
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
				<header class="cabecalho">
					<h1>Tabelas Normalizadas</h1>
					<h3>Reclamações do consumidor.gov.br</h3>
				</header>
				<article>
					<br><br>
					<div class="alert alert-info" id="mensagem" style="display: none;" role="alert"><strong>NENHUM REGISTRO NORMALIZADO NA BASE!</strong></div>
					<!-- .................. TABELAS .................. -->
					<div id="accordion" role="tablist" aria-multiselectable="true">
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen" role="tab" id="headingTen">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Reclamação
								</h4>
							</div>
							<div id="collapseTen" class="collapse" role="tabpanel" aria-labelledby="headingTen">
								<div class="card-block" id="reclamacao_dion">
									<div class="table-responsive" id="reclamacao" style="display: none;">
										<table class="table table-striped display" id="reclamacao_table" width="100%" cellspacing="0" title="">
											<thead>
												<tr>
													<th></th>
													<th>ID</th>
													<th>CIDADE</th>
													<th>ESTADO</th>
													<th>REGIÃO</th>
													<th>SEXO</th>
													<th>FAIXA ETÁRIA</th>
													<th>ANO ABERT.</th>
													<th>MÊS ABERT.</th>
													<th>DATA ABERT.</th>
													<th>DATA RESP.</th>
													<th>DATA FINAL.</th>
													<th>TEMPO RESP.</th>
													<th>EMPRESA</th>
													<th>SEGMENTO</th>
													<th>ÁREA</th>
													<th>ASSUNTO</th>
													<th>PROBLEMA</th>
													<th>COMO COMPROU</th>
													<th>PROCUR. EMP.</th>
													<th>RESPONDIDA</th>
													<th>SITUAÇÃO</th>
													<th>AVALIAÇÃO</th>
													<th>NOTA CONS.</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th></th>
													<th>ID</th>
													<th>CIDADE</th>
													<th>ESTADO</th>
													<th>REGIÃO</th>
													<th>SEXO</th>
													<th>FAIXA ETÁRIA</th>
													<th>ANO ABERT.</th>
													<th>MÊS ABERT.</th>
													<th>DATA ABERT.</th>
													<th>DATA RESP.</th>
													<th>DATA FINAL.</th>
													<th>TEMPO RESP.</th>
													<th>EMPRESA</th>
													<th>SEGMENTO</th>
													<th>ÁREA</th>
													<th>ASSUNTO</th>
													<th>PROBLEMA</th>
													<th>COMO COMPROU</th>
													<th>PROCUR. EMP.</th>
													<th>RESPONDIDA</th>
													<th>SITUAÇÃO</th>
													<th>AVALIAÇÃO</th>
													<th>NOTA CONS.</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine" role="tab" id="headingNine">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Problema
								</h4>
							</div>
							<div id="collapseNine" class="collapse" role="tabpanel" aria-labelledby="headingNine">
								<div class="card-block" id="problema_dion">
									<div class="table-responsive" id="problema" style="display: none;">
										<table class="table table-striped display" id="problema_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>DESCRIÇÃO</th>
													<th>GRUPO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" role="tab" id="headingEight">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Grupo
								</h4>
							</div>
							<div id="collapseEight" class="collapse" role="tabpanel" aria-labelledby="headingEight">
								<div class="card-block" id="grupo_dion">
									<div class="table-responsive" id="grupo" style="display: none;">
										<table class="table table-striped display" id="grupo_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>DESCRIÇÃO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" role="tab" id="headingSeven">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Área
								</h4>
							</div>
							<div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven">
								<div class="card-block" id="area_dion">
									<div class="table-responsive" id="area" style="display: none;">
										<table class="table table-striped display" id="area_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>DESCRIÇÃO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" role="tab" id="headingSix">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Empresa
								</h4>
							</div>
							<div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix">
								<div class="card-block" id="empresa_dion">
									<div class="table-responsive" id="empresa" style="display: none;">
										<table class="table table-striped display" id="empresa_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>NOME FANTASIA</th>
													<th>SEGMENTO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" role="tab" id="headingFive">
								<h4 class="mb-0">
									<i class="glyphicon glyphicon-plus"></i> Segmento
								</h4>
							</div>
							<div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
								<div class="card-block" id="segmento_dion">
									<div class="table-responsive" id="segmento" style="display: none;">
										<table class="table table-striped display" id="segmento_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>DESCRIÇÃO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" role="tab" id="headingFour">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Consumidor
								</h4>
							</div>
							<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
								<div class="card-block" id="consumidor_dion">
									<div class="table-responsive" style="display:none" id="consumidor">
										<table class="table table-striped display" id="consumidor_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>SEXO</th>
													<th>FAIXA ETÁRIA</th>
													<th>CIDADE</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="tab" id="headingThree">
								<h4 class="mb-0">
									<i class="glyphicon glyphicon-plus"></i> Cidade
								</h4>
							</div>
							<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
								<div class="card-block" id="cidade_dion">
									<div class="table-responsive"  id="cidade" style="display:none">
										<table class="table table-striped display" id="cidade_table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>ID</th>
													<th>NOME</th>
													<th>ESTADO</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="tab" id="headingTwo">
								<h4 class="mb-0">
									<i class="glyphicon glyphicon-plus"></i> Estado
								</h5>
							</div>
							<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
								<div class="card-block" id="estado_dion"></div>
								<div class="table-responsive" style="display:none" id="estado">
									<table class="table table-striped display" id="estado_table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>ID</th>
												<th>NOME</th>
												<th>REGIÃO</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" role="tab" id="headingOne">
								<h4>
									<i class="glyphicon glyphicon-plus"></i> Região
								</h4>
							</div>
							<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
								<div class="card-block" id="regiao_dion"></div>
								<div class="table-responsive" style="display:none"id="regiao">
									<table class="table table-striped display" id="regiao_table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>ID</th>
												<th>NOME</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
	<script src="../controller/TabelasAjax.js"> </script>
</body>
</html>
