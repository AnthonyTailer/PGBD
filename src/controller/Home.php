<?php

 //Link to download file...
 $url = "https://raw.githubusercontent.com/AnthonyTailer/consumidor.gov.br/master/README.md";

 //Code to get the file...
 $data = file_get_contents($url);

 //display link to the file you just saved...
 echo "$data";

?>