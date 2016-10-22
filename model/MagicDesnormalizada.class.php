<?php
/**
  * Classe responsável por manter métodos get() e set() da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

  class MagicDesnormalizada{
    private $id;
    private $idDigs;
    private $titulo;
    private $investimento;
    private $uf;
    private $cidade;
    private $executor;
    private $orgao;
    private $estagio;
    private $ciclo;
    private $selecao;
    private $conclusao;
    private $latitude;
    private $longitude;
    private $emblematica;
    private $observacao;


    function __set($name, $value){
      $this->$name = $value;
    }

    function __get($name){
      return $this->$name;
    }
  }

?>
