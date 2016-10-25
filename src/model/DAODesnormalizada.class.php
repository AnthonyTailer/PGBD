<?php
/**
  * Classe responsável por manter métodos CRUD da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

	require_once 'PDOConsumidor.class.php';

	class DAODesnormalizada extends PDOConsumidor {

		public $conex = null;
		const insertSql = "INSERT INTO consumidor_des
			(regiao, uf, cidade, sexo,faixaEtaria, anoAbertura, mesAbertura,
			dataAbertura, dataResposta, dataFinalizacao, tempoResposta, nomeFantasia,
			segmentoMercado, area, assunto, grupoProblema, problema, comoComprou,
			procurouEmpresa, respondida, situacao, avaliacao, notaConsumidor)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		public function __construct(){
			$this->conex = PDOConsumidor::getConnection();
		}

		// Inserção de novos dados na tabelas desnormalizada

		public function insertDesnormalizada($desnormalizada){
			try {
				$stmt = $this->conex->prepare(self::insertSql);

				$stmt->bindValue(1, $desnormalizada->regiao);
				$stmt->bindValue(2, $desnormalizada->uf);
				$stmt->bindValue(3, $desnormalizada->cidade);
				$stmt->bindValue(4, $desnormalizada->sexo);
				$stmt->bindValue(5, $desnormalizada->faixaEtaria);
				$stmt->bindValue(6, $desnormalizada->anoAbertura, PDO::PARAM_INT);
				$stmt->bindValue(7, $desnormalizada->mesAbertura, PDO::PARAM_INT);
				$stmt->bindValue(8, $desnormalizada->dataAbertura);
				$stmt->bindValue(9, $desnormalizada->dataResposta);
				$stmt->bindValue(10, $desnormalizada->dataFinalizacao);
				$stmt->bindValue(11, $desnormalizada->tempoResposta);
				$stmt->bindValue(12, $desnormalizada->nomeFantasia);
				$stmt->bindValue(13, $desnormalizada->segmentoMercado);
				$stmt->bindValue(14, $desnormalizada->area);
				$stmt->bindValue(15, $desnormalizada->assunto);
				$stmt->bindValue(16, $desnormalizada->grupoProblema);
				$stmt->bindValue(17, $desnormalizada->problema);
				$stmt->bindValue(18, $desnormalizada->comoComprou);
				$stmt->bindValue(19, $desnormalizada->procurouEmpresa);
				$stmt->bindValue(20, $desnormalizada->respondida);
				$stmt->bindValue(21, $desnormalizada->situacao);
				$stmt->bindValue(22, $desnormalizada->avaliacao);
				$stmt->bindValue(23, $desnormalizada->notaConsumidor);

				$stmt->execute();
				$this->conex = null;

				echo "Inserido com Sucesso"."</br>";

			} catch (Exception $e) {
				echo "Erro ao Inserir Desnormalizada: </br>". $e->getMessage();
			}

		}

		public function selectDesnormalizada($query=null){
			try {
				if ($query == null) {
					$stmt = $this->conex->query("SELECT * FROM consumidor_des");
				}else {
					$stmt = $this->conex->query($query);
				}
			} catch (Exception $e) {
				echo "Erro ao consultar Desnormalizada: </br>". $e->getMessage();
			}
			$this->conex = null;
			return $stmt;
		}
	}

?>
