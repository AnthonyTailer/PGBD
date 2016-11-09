<?php
/**
* Classe responsável por importar a base de dados
* @author Anthony Tailer
* @author Lucas Lima
**/

if(!empty($_FILES["consumidor_csv"]["name"])){

  $output = array();
  $allowed_ext = array("csv");
  $tmp = explode(".", $_FILES["consumidor_csv"]["name"]);
  $extension = end($tmp);
  if(in_array($extension, $allowed_ext)){
    $file_data = fopen($_FILES["consumidor_csv"]["tmp_name"], 'r');
    fgetcsv($file_data);
    $i = 0;

    while($row = fgetcsv($file_data, 0,';')){
      $i++;
    }

    echo $i;
  }
  else{
    echo 'Error1';
  }
}
else{
  echo "Error2";
}


?>
