<?php
/**
  * Classe responsável por manter métodos get() e set() da tabela desnormalizada
  * @author Anthony Tailer
  * @author Lucas Lima
  **/

  class MagicDesnormalizada{
    private $id;
    private $data;
    private $municipio;
    private $endereco;
    private $CRVL_recolhida;
    private $CNH_recolhida;
    private $veiculo_recolhido;
    private $veiculo_autuado;
    private $recusou_teste_etiometro;
    private $autuado_teste_etiometro;
    private $qtd_autuacoes;
    private $tipo_veiculo;
    private $marca_modelo_veiculo;


    function __set($name, $value){
      $this->$name = $value;
    }

    function __get($name){
      return $this->$name;
    }
  }

?>
