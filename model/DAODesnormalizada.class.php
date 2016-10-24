<?php
/**
  * Classe responsável por manter métodos CRUD da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

	require_once 'PDOObrasPAC.class.php';

	class DAODesnormalizada extends PDOObrasPAC {

		public $conex = null;
		const insertSql = 'INSERT INTO obras_pac_des(id, idDigs, titulo, investimento, uf, cidade, executor, orgao, estagio, ciclo, selecao, conclusao, latitude, longitude, emblematica, observacao) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

		public function __construct(){
					$this->conex = PDOObrasPAC::getConnection();
		}

		// Inserção de novos dados na tabelas desnormalizada

		public function insertDesnormalizada($desnormalizada){
			try {
				$stmt = $this->conex->prepare(self::insertSql);

				$stmt->bindValue(1, $desnormalizada->id, PDO::PARAM_INT);
				$stmt->bindValue(2, $desnormalizada->idDigs, PDO::PARAM_INT);
				$stmt->bindValue(3, $desnormalizada->titulo, PDO::PARAM_STR);
				$stmt->bindValue(4, $desnormalizada->investimento);
				$stmt->bindValue(5, $desnormalizada->uf, PDO::PARAM_STR);
				$stmt->bindValue(6, $desnormalizada->cidade);
				$stmt->bindValue(7, $desnormalizada->executor, PDO::PARAM_STR);
				$stmt->bindValue(8, $desnormalizada->orgao, PDO::PARAM_STR);
				$stmt->bindValue(9, $desnormalizada->estagio, PDO::PARAM_INT);
				$stmt->bindValue(10, $desnormalizada->ciclo);
				$stmt->bindValue(11, $desnormalizada->selecao);
				$stmt->bindValue(12, $desnormalizada->conclusao);
				$stmt->bindValue(13, $desnormalizada->latitude);
				$stmt->bindValue(14, $desnormalizada->longitude);
				$stmt->bindValue(15, $desnormalizada->emblematica, PDO::PARAM_STR);
				$stmt->bindValue(16, $desnormalizada->observacao, PDO::PARAM_STR);

				$stmt->execute();
				$this->conex = null;

				echo "Insert successfully"."</br>";

			} catch (Exception $e) {
				echo "Erro ao Inserir Desnormalizada: ". $e->getMessage();
			}

		}
	}

?>
