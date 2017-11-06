<?php
set_time_limit(1000);
function getdb() {
	$server = "localhost";
	$username = "root";
	$password = "verano.2014";
	$db = "lubrycode";

	try {

		$conn = mysqli_connect($server, $username, $password, $db);
	} catch (exception $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	return $conn;
}

$con = getdb();
$sql = 'truncate sector';
$exe = mysqli_query($con, $sql);

$gestor = fopen("/var/www/html/lubrycenter/ftp/SECTOR.CSV", 'r');
while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {
	$sql = "INSERT into sector (codigo , nombre) values ('" . $datos[0] . "','" . $datos[1] . "')";
	$result = mysqli_query($con, $sql);
}
fclose($gestor);
?>
