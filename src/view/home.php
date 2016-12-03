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
	<title>Importação da Base de Dados</title>
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
	<script src="../controller/ImportCsvAjax.js"> </script>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php include_once "menu.php" ?>
			</div>
			<div class="col-md-9">
				<header class="cabecalho">
					<h1><img rel="icon" src="../utilities/img/icon.svg" type="image/png" width="100px" />
					Reclamações do consumidor.gov.br</h1>
				</header>
				<article class="home">
					<br><br>
					<div class="container-fluid">
						<p>Projeto e Gerência de Banco de Dados | 5° semestre do curso de Sistemas de Informação Universidade Federal de Santa Maria (UFSM)</p>
						<p><b>Desenvolvedores:</b> Anthony Tailer Ribas de Almeida <a href="http://github.com/anthonytailer" target="_blank"> <i class="glyphicon glyphicon-new-window"></i></a>, Lucas Lima de Oliveira<a href="http://github.com/limalucas" target="_blank"> <i class="glyphicon glyphicon-new-window"></i></a><br></p>
						<h3><b>Informações gerais sobre o trabalho</b></h3>
						<hr>
						<h4><b>O trabalho é dividido em 4 etapas:</b></h4>
						<h5><b>Criação do Banco de Dados</b></h5>
						<ul>
							<li>Escolher uma planilha com <b>dados abertos</b> disponibilizados na Web
								<ul>
									<li><b>Planilha escolhida:</b> Reclamações do consumidor.gov.br</li>
									<li><b>Disponível em:</b> <a href="https://goo.gl/ai0KCR" target="_blank">https://goo.gl/ai0KCR</a></li>
								</ul>
							</li>
							<br>
							<li>Criar um banco de dados normalizado que suporte os dados da planilha
								<ul>
									<li><b>Tabela Original:</b>
										<ul>
											<li><b>RECLAMACAO_DES</b>(Região,UF,Cidade,Sexo,Faixa Etária,Ano Abertura,Mês Abertura,
        										Data Abertura,Data Resposta,Data Finalização,Tempo Resposta,Nome Fantasia,
        										Segmento de Mercado,Área,Assunto,Grupo Problema,Problema,Como Comprou Contratou,
        										Procurou Empresa,Respondida,Situação,Avaliação Reclamação,Nota do Consumidor)</li>
										</ul>
									</li>
									<br>
									<li><b>Tabelas Normalizadas:</b>
										<ul>
											<li><b>REGIAO</b>(IDREGIAO*, NOME);</li>
											<li><b>ESTADO</b>(IDESTADO*, NOME, IDREGIAO),
    											<br>IDREGIAO references REGIAO(IDREGIAO);</li>
											<li><b>ESTADO</b>(IDESTADO*, NOME, IDREGIAO),
        										<br>IDREGIAO references REGIAO(IDREGIAO);</li>
											<li><b>CIDADE</b>(IDCIDADE*, NOME, IDESTADO),
        										<br>IDESTADO references ESTADO(IDESTADO);</li>
											<li><b>CONSUMIDOR</b>(IDCONSUMIDOR*, SEXO, FAIXAETARIA, IDCIDADE),
        										<br>IDCIDADE references CIDADE(IDCIDADE);</li>
											<li><b>SEGMENTO</b>(IDSEGMENTO*, DESCRICAO);</li>
											<li><b>AREA</b>(IDAREA*, DESCRICAO, IDSEGMENTO),
        										<br>IDSEGMENTO references SEGMENTO(IDSEGMENTO);</li>
											<li><b>EMPRESA</b>(IDEMPRESA*, NOMEFANTASIA);</li>
											<li><b>GRUPO</b>(IDGRUPO*, DESCRICAO);</li>
											<li><b>PROBLEMA</b>(IDPROBLEMA*, DESCRICAO, IDGRUPO),
        										<br>IDGRUPO references GRUPO(IDGRUPO);</li>
											<li><b>RECLAMACAO</b>(IDRECLAMACAO*, IDCONSUMIDOR, ANO, MES, DATAABERTURA, DATARESPOSTA, TEMPORESPOSTA, IDEMPRESA, IDAREA, ASSUNTO, IDPROBLEMA, COMOCOMPROU, PROCUROUEMPRESA, RESPONDIDA, SITUACAO, AVALIACAO, NOTACONSUMIDOR),
									        	<br>IDCONSUMIDOR references CONSUMIDOR(IDCONSUMIDOR),
									        	<br>IDEMPRESA references EMPRESA(IDEMPRESA),
									        	<br>IDAREA references AREA(IDAREA);
									        	<br>IDPROBLEMA references PROBLEMA(IDPROBLEMA);</li>
										</ul>
									</li>
									<li>Disponível no menu: <a href="normalizacao.php"><i class="glyphicon glyphicon-thumbs-up"></i> Normalização do DB</a></li>
								</ul>
							</li>
							<br>
							<li>Criação de uma ferramenta de visualização de dados
								<ul>
									<li>Podendo ser desenvolvida usando:
										<ul>
											<li>Qualquer linguagem de programação :<b>PHP</b></li>
											<li>Qualquer framework de desenvolvimento: <b>jQuery, DataTable, Google API, Highcharts</b></li>
											<li>Qualquer tipo de arquitetura/padrão de desenvolvimento: <b>MVC (tentativa)</b></li>
											<li>Qualquer plataforma de acesso (web, Desktop, Mobile..): <b>Browser (web)</b></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<br>
						<h5><b>Importação dos dados a partir de uma fonte de dados</b></h5>
						<ul>
							<li>A aplicação deve ter um recurso que permita a <b>importação de dados</b> a partir de uma fonte de dados.
								<ul>
									<li>Podendo ser uma planilha ou arquivo texto gerado a partir da planilha.</li>
										<ul>
											<li>Disponível no menu: <a href="importacao.php"><i class="glyphicon glyphicon-import"></i> Importação do CSV</a></li>
										</ul>
									<li>Os dados devem ser importados no banco de dados da aplicação.</li>
								</ul>
							</li>
						</ul>
						<br>
						<h5><b>Acesso aos dados a partir de formulários de consulta</b></h5>
						<ul>
							<li>A aplicação deve ter formulários que permitam navegar pelos registros de cada uma das tabelas existentes.
								<ul>
									<li>Disponível no menu: <a href="tabelas.php"><i class="glyphicon glyphicon-th-list"></i> Tabelas Normalizadas</a></li>
								</ul>
							</li>
							<li>Para tabelas que possuem chaves estrangeiras, deve-se exibir:
								<ul>
									<li>As colunas da respectiva chave primária, <b>NÃO</b> o valor da chave estrangeira</li>
								</ul>
							</li>
						</ul>
						<br>
						<h5><b>Acesso aos dados a partir de relatórios gráficos</b></h5>
						<ul>
							<li>A aplicação deve gerar relatórios gráficos acessando estatísticas a partir das tabelas existentes.</li>
							<li>Pelo menos 3 relatórios devem ser gerados
								<ul>
									<li>Pelo menos um dos relatórios deve ser de distribuição espacial</li>
									<li>Para isso, é importante que os dados possuam algum tipo de referência geográfica</li>
									<li>Disponível no menu: <a href="graficos.php"><i class="glyphicon glyphicon-stats"></i> Tabelas Normalizadas</a></li>
								</ul>
							</li>
						</ul>
						<br>
					</div>
				</article>
			</div>
		</div>
	</div>
</body>
</html>

