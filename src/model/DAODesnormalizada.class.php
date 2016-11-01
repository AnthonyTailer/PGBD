<?php
/**
  * Classe responsável por manter métodos CRUD da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

	require_once 'MySQLiConsumidor.class.php';

	class DAODesnormalizada extends MySQLiConsumidor {

		public $conex;
		public $mysqli;
		const insertSql = "INSERT INTO RECLAMACAO_DES
			(REGIAO, UF, CIDADE, SEXO,FAIXAETARIA, ANOABERTURA, MESABERTURA,
			DATAABERTURA, DATARESPOSTA, DATAFINALIZACAO, TEMPORESPOSTA, NOMEFANTASIA,
			SEGMENTOMERCADO, AREA, ASSUNTO, GRUPOPROBLEMA, PROBLEMA, COMOCOMPROU,
			PROCUROUEMPRESA, RESPONDIDA, SITUACAO, AVALIACAO, NOTACONSUMIDOR)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		public function __construct(){
			$this->conex = new MySQLiConsumidor();
			$this->mysqli = $this->conex->getConnection();

		}

		// Inserção de novos dados na tabelas desnormalizada

		public function insertDesnormalizada($desnormalizada){
			try {
				$stmt = $this->mysqli->prepare(self::insertSql);

				 $stmt->bind_param(
				 'sssssiisssssssssssssssi',
				 $desnormalizada->regiao, $desnormalizada->uf,
				 $desnormalizada->cidade, $desnormalizada->sexo,
				 $desnormalizada->faixaEtaria, $desnormalizada->anoAbertura,
				 $desnormalizada->mesAbertura, $desnormalizada->dataAbertura,
				 $desnormalizada->dataResposta, $desnormalizada->dataFinalizacao,
				 $desnormalizada->tempoResposta, $desnormalizada->nomeFantasia,
				 $desnormalizada->segmentoMercado, $desnormalizada->area,
				 $desnormalizada->assunto, $desnormalizada->grupoProblema,
				 $desnormalizada->problema, $desnormalizada->comoComprou,
				 $desnormalizada->procurouEmpresa, $desnormalizada->respondida,
				 $desnormalizada->situacao, $desnormalizada->avaliacao,
				 $desnormalizada->notaConsumidor);

				 $stmt->execute();
				 $stmt->close();
         //$this->mysqli->close();
			} catch (Exception $e) {
				echo "Erro ao Inserir Desnormalizada: </br>". $e->getMessage();
			}

		}

		public function selectDesnormalizada($query){
			try {
					$stmt = $this->mysqli->query($query);
					return $stmt;

			} catch (Exception $e) {
				echo "Erro ao consultar Desnormalizada: </br>". $e->getMessage();
			}

		}
	}

?>
