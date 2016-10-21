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

	$desnormalizada->data = '20/10/2016';
	$desnormalizada->municipio = 'MATA';
	$desnormalizada->endereco = 'Rua General osorio';
	$desnormalizada->CRVL_recolhida = 'S';
	$desnormalizada->CNH_recolhida = 'S';
	$desnormalizada->veiculo_recolhido = 'S';
	$desnormalizada->veiculo_autuado = 'S';
	$desnormalizada->recusou_teste_etiometro = 'S';
	$desnormalizada->autuado_teste_etiometro = 'N';
	$desnormalizada->qtd_autuacoes = 5;
	$desnormalizada->tipo_veiculo = 'Carro';
	$desnormalizada->marca_modelo_veiculo = 'Chevrolet/Opala SS 1979';

	$DAODesnormalizada = new DAODesnormalizada();
	$DAODesnormalizada->insertDesnormalizada($desnormalizada);

 ?>
