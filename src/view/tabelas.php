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
				<header class="cabecalho">
					<h1>Tabelas Normalizadas</h1>
					<h3>Reclamações do consumidor.gov.br</h3>
				</header>
				<article>
					<br><br>
			        <div class="row" style="display:none"id="regiao">
			          	<h3 align="left">Região</h3>
			          	<hr>
			          	<div class="table-responsive" id="regiao_div">
							<table class="display" id="regiao_table" width="100%" cellspacing="0">
			  					<thead>
			  						<tr>
			                  			<th>ID</th>
			  							<th>NOME</th>
			  						</tr>
			  					</thead>
			  					<tfoot>
			  						<tr>
			                  			<th>ID</th>
			  							<th>NOME</th>
			  						</tr>
			  					</tfoot>
			  				</table>
						</div>
			        </div>
			        <div class="row" style="display:none" id="estado">
			          	<h3 align="left">Estado</h3>
			          	<hr>
			          	<div class="table-responsive"  id="estado_div">
							<table class="display" id="estado_table" width="100%" cellspacing="0">
								<thead>
									<tr>
			                  			<th>ID</th>
			  							<th>NOME</th>
			                  			<th>REGIÃO</th>
									</tr>
								</thead>
								<!-- <tfoot>
									<tr>
			                  			<th>ID</th>
			  							<th>NOME</th>
			              				<th>REGIÃO</th>
			  						</tr>
			  						</tfoot> -->
			  					</table>
			  				</div>
			        </div>
			        <div class="row" id="cidade" style="display:none">
						<h3 align="left">Cidade</h3>
						<hr>
						<div class="table-responsive"  id="cidade_div">
							<table class="display" id="cidade_table" width="100%" cellspacing="0">
								<thead>
									<tr>
			                  			<th>ID</th>
										<th>NOME</th>
			                  			<th>ESTADO</th>
									</tr>
								</thead>
								<!-- <tfoot>
									<tr>
			                  			<th>ID</th>
										<th>NOME</th>
			              				<th>ESTADO</th>
									</tr>
								</tfoot> -->
							</table>
						</div>
			        </div>
			        <div class="row" style="display:none" id="consumidor">
			          	<h3 align="left">Consumidor</h3>
			          	<hr>
			          	<div class="table-responsive" id="consumidor_div">
							<table class="display" id="consumidor_table" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>ID</th>
			                  			<th>SEXO</th>
			                  			<th>FAIXA ETÁRIA</th>
			                  			<th>CIDADE</th>
									</tr>
								</thead>
								<!-- <tfoot>
									<tr>
					                  	<th>ID</th>
					                  	<th>SEXO</th>
					                  	<th>FAIXA ETÁRIA</th>
					                	<th>CIDADE</th>
			  						</tr>
			  					</tfoot> -->
			  				</table>
			  			</div>
			        </div>
			        <div class="row"  style="display:none" id="segmento">
			         	 <h3 align="left">Segmento</h3>
			         	 <hr>
			         	 <div class="table-responsive" id="segmento_div">
							<table class="display" id="segmento_table" width="100%" cellspacing="0">
								<thead>
									<tr>
			                  			<th>ID</th>
										<th>DESCRIÇÃO</th>
									</tr>
								</thead>
								<!-- <tfoot>
									<tr>
			                  			<th>ID</th>
			                 		 	<th>DESCRIÇÃO</th>
									</tr>
			  					</tfoot> -->
			  				</table>
			  			</div>
			        </div>
			        <div class="row" style="display:none" id="area">
			         	 <h3 align="left">Area</h3>
			         	 <hr>
			         	 <div class="table-responsive" id="area_div">
			  				<table class="display" id="area_table" width="100%" cellspacing="0">
			  					<thead>
			  						<tr>
			  							<th>ID</th>
			                  			<th>DESCRIÇÃO</th>
			  						</tr>
			  					</thead>
			  					<!-- <tfoot>
			  						<tr>
					                  	<th>ID</th>
			                  			<th>DESCRIÇÃO</th>
			  						</tr>
			  					</tfoot> -->
			  				</table>
			  			</div>
			        </div>
			        <div class="row"  style="display:none" id="empresa">
			          	<h3 align="left">Empresa</h3>
			          	<hr>
			          	<div class="table-responsive" id="empresa_div">
			  				<table class="display" id="empresa_table" width="100%" cellspacing="0">
			  					<thead>
			  						<tr>
			        		          	<th>ID</th>
			  							<th>NOME FANTASIA</th>
			                  			<th>SEGMENTO</th>
			  						</tr>
			  					</thead>
			  					<!-- <tfoot>
			  						<tr>
			                  			<th>ID</th>
			                  			<th>NOME FANTASIA</th>
			                  			<th>SEGMENTO</th>
									</tr>
								</tfoot> -->
			  				</table>
			  			</div>
			        </div>
			        <div class="row"  style="display:none" id="grupo">
			          	<h3 align="left">Grupo</h3>
			          	<hr>
			          	<div class="table-responsive" id="grupo_div">
			  				<table class="display" id="grupo_table" width="100%" cellspacing="0">
			  					<thead>
			  						<tr>
			                  			<th>ID</th>
			  							<th>DESCRIÇÃO</th>
			  						</tr>
			  					</thead>
			  					<!-- <tfoot>
			  						<tr>
			                  			<th>ID</th>
			                  			<th>DESCRIÇÃO</th>
			  						</tr>
			  					</tfoot> -->
			  				</table>
			  			</div>
			        </div>
			        <div class="row"  style="display:none" id="problema">
			          	<h3 align="left">Problema</h3>
			          	<hr>
			          	<div class="table-responsive" id="problema_div">
				            <table class="display" id="problema_table" width="100%" cellspacing="0">
				              	<thead>
				                	<tr>
				                  		<th>ID</th>
				                  		<th>DESCRIÇÃO</th>
				                  		<th>GRUPO</th>
				                	</tr>
				              	</thead>
				              	<!-- <tfoot>
					                <tr>
				    	              	<th>ID</th>
				                  		<th>DESCRIÇÃO</th>
				                  		<th>GRUPO</th>
				                	</tr>
				              	</tfoot> -->
				            </table>
			          	</div>
			        </div>
			        <div class="row" style="display:none" id="reclamacao">
			          	<h3 align="left">Reclamações</h3>
			          	<hr>
			          	<div class="table-responsive" id="reclamacao_div">
			            	<table class="display" id="reclamacao_table" width="100%" cellspacing="0" title="">
			              		<thead>
				                	<tr>
					                    <th>ID</th>
										<th>SEXO</th>
										<th>FAIXA ETÁRIA</th>
										<th>ANO ABERT.</th>
										<th>MÊS ABERT.</th>
										<th>DATA ABERT.</th>
										<th>DATA RESP.</th>
										<th>DATA FINAL.</th>
										<th>TEMPO RESP.</th>
										<th>EMPRESA</th>
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
				              	<!-- <tfoot>
				                	<tr>
					                  	<th>ID</th>
										<th>SEXO</th>
										<th>FAIXA ETÁRIA</th>
										<th>ANO ABERT.</th>
										<th>MÊS ABERT.</th>
										<th>DATA ABERT.</th>
										<th>DATA RESP.</th>
										<th>DATA FINAL.</th>
										<th>TEMPO RESP.</th>
										<th>EMPRESA</th>
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
				              	</tfoot> -->
				            </table>
			          	</div>
			        </div>
			    </article>
      		</div>
    	</div>
  	</div>
	<script src="../controller/TabelasAjax.js"> </script>
</body>
</html>
