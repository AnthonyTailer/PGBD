<?
function __autoload($classe){
  include_once "../model/{$classe}.class.php";
}

$con = new MySQLiConsumidor();
$con->getConnection();

$result = $con->executeQuery("SELECT count(*) as valor from CONSUMIDOR_DES");

echo $result->fetch_array(MYSQLI_ASSOC)["valor"];

?>
