<?php
/**
  * Classe responsável por manter métodos get() e set() da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

  class MagicDesnormalizada{
    private $regiao;
    private $uf;
    private $cidade;
    private $sexo;
    private $faixaEtaria;
    private $anoAbertura;
    private $mesAbertura;
    private $dataAbertura;
    private $dataResposta;
    private $dataFinalizacao;
    private $tempoResposta;
    private $nomeFantasia;
    private $segmentoMercado;
    private $area;
    private $assunto;
    private $grupoProblema;
    private $problema;
    private $comoComprou;
    private $procurouEmpresa;
    private $respondida;
    private $situacao;
    private $avaliacao;
    private $notaConsumidor;

    function __set($name, $value){
      $this->$name = $value;
    }

    function &__get($name){
      return $this->$name;
    }
  }

?>
