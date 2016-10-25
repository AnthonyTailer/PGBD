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
	$DAODesnormalizada = new DAODesnormalizada();
	//$DAODesnormalizada->insertDesnormalizada($desnormalizada);
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Importação da Base de Dados</title>

		<link rel="shortcut icon" href="../../utilities/img/favicon.png" type="image/png"/>
		<!-- REVER PARA BAIXAR OS ARQUIVOS, MELHORA O DESEMPENHO, NA APRESENTAÇÃO NÃO TEREMOS INTERNET -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">	</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">	</script>
		<script src="../control/importAjax.js"></script>
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
			<div class="table-responsive" id="consumidor_table">
				<table class="table table-bordered">
					<tr>
						<th width="5%">REGIÃO</th>
						<th width="6%">UF</th>
						<th width="15%">CIDADE</th>
						<th width="8%">SEXO</th>
						<th width="5%">FAIXA ETÁRIA</th>
						<th width="10%">ANO ABERTURA</th>
						<th width="10%">MÊS ABERTURA</th>
						<th width="10%">DATA ABERTURA</th>
						<th width="15%">DATA RESPOSTA</th>
						<th width="15%">DATA FINALIZAÇÃO</th>
						<th width="10%">TEMPO RESPOSTA</th>
						<th width="5%">NOME FANTASIA</th>
						<th width="5%">SEGMENTO MERCADO</th>
						<th width="5%">ÁREA</th>
						<th width="5%">ASSUNTO</th>
						<th width="15%">GRUPO PROBLEMA</th>
						<th width="15%">PROBLEMA</th>
						<th width="15%">COMO COMPROU</th>
						<th width="15%">PROCUROU EMPRESA</th>
						<th width="15%">RESPONDIDA</th>
						<th width="15%">SITUAÇÃO</th>
						<th width="15%">AVALIAÇÃO</th>
						<th width="15%">NOTA CONSUMIDOR</th>
					</tr>
					<?php
					while($row = $DAODesnormalizada->selectDesnormalizada()->fetch(PDO::FETCH_ASSOC)){
          ?>
          <tr>
           	<td><?php echo $row["regiao"]; ?></td>
           	<td><?php echo $row["uf"]; ?></td>
           	<td><?php echo $row["cidade"]; ?></td>
           	<td><?php echo $row["sexo"]; ?></td>
           	<td><?php echo $row["faixaEtaria"]; ?></td>
           	<td><?php echo $row["anoAbertura"]; ?></td>
           	<td><?php echo $row["mesAbertura"]; ?></td>
           	<td><?php echo $row["dataAbertura"]; ?></td>
           	<td><?php echo $row["dataFinalizacao"]; ?></td>
           	<td><?php echo $row["tempoResposta"]; ?></td>
           	<td><?php echo $row["nomeFantasia"]; ?></td>
           	<td><?php echo $row["segmentoMercado"]; ?></td>
           	<td><?php echo $row["area"]; ?></td>
           	<td><?php echo $row["assunto"]; ?></td>
           	<td><?php echo $row["grupoProblema"]; ?></td>
           	<td><?php echo $row["problema"]; ?></td>
           	<td><?php echo $row["comoComprou"]; ?></td>
           	<td><?php echo $row["procurouEmpresa"]; ?></td>
           	<td><?php echo $row["respondida"]; ?></td>
           	<td><?php echo $row["situacao"]; ?></td>
           	<td><?php echo $row["avaliacao"]; ?></td>
           	<td><?php echo $row["notaConsumidor"]; ?></td>
          </tr>
          <?php
          }
          ?>
				</table>

			</div>
		</div>

	</body>
</html>
