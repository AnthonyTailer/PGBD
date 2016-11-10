<?php

function __autoload($classe){
    include_once "../model/{$classe}.class.php";
}

$conex = new MySQLiConsumidor();
$mysqli = $conex->getConnection();
$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();

$request = $_GET['tabela'];

$queryRegiao;

if ($request == "regiao") {


  $result = $conex->executeQuery($queryRegiao);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){

  }


}else if ($request == "estado"){

}else if ($request == "cidade"){

}else if ($request == "consumidor"){

}else if ($request == "segmento"){

}else if ($request == "area"){

}else if ($request == "empresa"){

}else if ($request == "grupo"){

}else if ($request == "problema"){

}else if ($request == "reclamacao"){

}else{
  echo "Error";
}
?>
