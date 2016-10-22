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

	$desnormalizada->id = 1311;
	$desnormalizada->idDigs = 1001;
	$desnormalizada->titulo = "Adequação Linha Férrea de Barra Mansa/RJ e construção de pátio - RJ";
	$desnormalizada->investimento = 143996640.77;
	$desnormalizada->uf = "RJ";
	$desnormalizada->cidade = "BARRA MANSA, VOLTA REDONDA";
	$desnormalizada->executor = "DNIT";
	$desnormalizada->orgao = "Ministério dos Transportes";
	$desnormalizada->estagio = 70;
	$desnormalizada->ciclo = "30.06.2016";
	$desnormalizada->selecao = NULL;
	$desnormalizada->conclusao = NULL;
	$desnormalizada->latitude = "22°32'24.000000''''S";
	$desnormalizada->longitude = "44°10'38.280000''O";
	$desnormalizada->emblematica = "";
	$desnormalizada->observacao = "";

	$DAODesnormalizada = new DAODesnormalizada();
	$DAODesnormalizada->insertDesnormalizada($desnormalizada);

 ?>
